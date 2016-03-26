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
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \dmzx\mchat\core\settings */
	protected $settings;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\user						$user
	 * @param \phpbb\auth\auth					$auth
	 * @param \phpbb\db\driver\driver_interface	$db
	 * @param \phpbb\request\request			$request
	 * @param \dmzx\mchat\core\settings			$settings
	 * @param string							$root_path
	 * @param string							$php_ext
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \dmzx\mchat\core\settings $settings, $root_path, $php_ext)
	{
		$this->template		= $template;
		$this->user			= $user;
		$this->auth			= $auth;
		$this->db			= $db;
		$this->request		= $request;
		$this->settings		= $settings;
		$this->root_path	= $root_path;
		$this->php_ext		= $php_ext;
	}

	/**
	 * Display the options a user can configure for this extension
	 *
	 * @param $u_action
	 */
	public function configuration($u_action)
	{
		add_form_key('ucp_mchat');

		$error = array();

		if ($this->request->is_set_post('submit'))
		{
			$mchat_new_config = array();
			$validation = array();
			foreach ($this->settings->ucp as $config_name => $config_data)
			{
				if ($this->auth->acl_get('u_' . $config_name))
				{
					$default = $this->user->data['user_' . $config_name];
					settype($default, gettype($config_data['default']));
					$mchat_new_config['user_' . $config_name] = $this->request->variable('user_' . $config_name, $default, is_string($default));

					if (isset($config_data['validation']))
					{
						$validation['user_' . $config_name] = $config_data['validation'];
					}
				}
			}

			if (!function_exists('validate_data'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			$error = array_merge($error, validate_data($mchat_new_config, $validation));

			if (!check_form_key('ucp_mchat'))
			{
				$error[] = 'FORM_INVALID';
			}

			if (!$error)
			{
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $mchat_new_config) . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);

				meta_refresh(3, $u_action);
				$message = $this->user->lang('PROFILE_UPDATED') . '<br /><br />' . $this->user->lang('RETURN_UCP', '<a href="' . $u_action . '">', '</a>');
				trigger_error($message);
			}

			// Replace "error" strings with their real, localised form
			$error = array_map(array($this->user, 'lang'), $error);
		}

		$auth_count = 0;

		foreach (array_keys($this->settings->ucp) as $config_name)
		{
			$upper = strtoupper($config_name);
			$auth = $this->auth->acl_get('u_' . $config_name);

			$this->template->assign_vars(array(
				$upper				=> $this->settings->cfg($config_name),
				$upper . '_AUTH'	=> $auth,
			));

			if ($auth)
			{
				$auth_count++;
			}
		}

		$selected = $this->settings->cfg('mchat_date');
		$date_template_data = $this->settings->get_date_template_data($selected);
		$this->template->assign_vars($date_template_data);

		$notifications_template_data = $this->settings->get_enabled_post_notifications_lang();
		$this->template->assign_var('MCHAT_POSTS_ENABLED_LANG', $notifications_template_data);

		$this->template->assign_vars(array(
			'ERROR'							=> sizeof($error) ? implode('<br />', $error) : '',
			'MCHAT_AUTH_COUNT'				=> $auth_count,
			'S_UCP_ACTION'					=> $u_action,
		));
	}
}
