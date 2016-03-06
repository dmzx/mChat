<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\controller;

class ucp_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var array */
	protected $user_config_keys;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\user						$user
	 * @param \phpbb\db\driver\driver_interface	$db
	 * @param \phpbb\request\request			$request
	 * @param array								$user_config_keys
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, $user_config_keys)
	{
		$this->config			= $config;
		$this->template			= $template;
		$this->user				= $user;
		$this->db				= $db;
		$this->request			= $request;
		$this->user_config_keys	= $user_config_keys;
	}

	/**
	 * Display the options a user can configure for this extension
	 *
	 * @param $u_action
	 */
	public function display_options($u_action)
	{
		add_form_key('ucp_mchat');

		$error = array();

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('ucp_mchat'))
			{
				$error[] = 'FORM_INVALID';
			}

			if (empty($error))
			{
				$data = array();
				foreach ($this->user_config_keys as $config_key)
				{
					$data[$config_key] = $this->request->variable($config_key, (int) $this->user->data[$config_key]);
				}

				$sql = 'UPDATE ' . USERS_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $data) . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);

				meta_refresh(3, $u_action);
				$message = $this->user->lang('PROFILE_UPDATED') . '<br /><br />' . $this->user->lang('RETURN_UCP', '<a href="' . $u_action . '">', '</a>');
				trigger_error($message);
			}

			// Replace "error" strings with their real, localised form
			$error = array_map(array($this->user, 'lang'), $error);
		}

		foreach ($this->user_config_keys as $config_key)
		{
			$this->template->assign_var(strtoupper($config_key), $this->user->data[$config_key]);
		}

		$this->template->assign_vars(array(
			'ERROR'					=> sizeof($error) ? implode('<br />', $error) : '',
			'S_UCP_ACTION'			=> $u_action,

			'S_MCHAT_TOPICS'		=> $this->config['mchat_new_posts_edit'] || $this->config['mchat_new_posts_quote'] || $this->config['mchat_new_posts_reply'] || $this->config['mchat_new_posts_topic'],
			'S_MCHAT_INDEX'			=> $this->config['mchat_on_index'],
			'S_MCHAT_INDEX_STATS'	=> $this->config['mchat_stats_index'],
			'S_MCHAT_AVATARS'		=> $this->config['mchat_avatars'],
		));
	}
}
