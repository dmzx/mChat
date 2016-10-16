<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\controller;

use dmzx\mchat\core\settings;
use phpbb\auth\auth;
use phpbb\db\driver\driver_interface as db_interface;
use phpbb\event\dispatcher_interface;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb\user;

class ucp_controller
{
	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var auth */
	protected $auth;

	/** @var db_interface */
	protected $db;

	/** @var request_interface */
	protected $request;

	/** @var settings */
	protected $settings;

	/** @var dispatcher_interface */
	protected $dispatcher;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param template				$template
	 * @param user					$user
	 * @param auth					$auth
	 * @param db_interface			$db
	 * @param request_interface		$request
	 * @param settings				$settings
	 * @param dispatcher_interface 	$dispatcher
	 * @param string				$root_path
	 * @param string				$php_ext
	 */
	public function __construct(
		template $template,
		user $user,
		auth $auth,
		db_interface $db,
		request_interface $request,
		settings $settings,
		dispatcher_interface $dispatcher,
		$root_path,
		$php_ext
	)
	{
		$this->template		= $template;
		$this->user			= $user;
		$this->auth			= $auth;
		$this->db			= $db;
		$this->request		= $request;
		$this->settings		= $settings;
		$this->dispatcher	= $dispatcher;
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
			foreach ($this->settings->ucp_settings() as $config_name => $config_data)
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

			/**
			 * Event to modify UCP settings data before they are updated
			 *
			 * @event dmzx.mchat.ucp_update_data
			 * @var array	mchat_new_config	Array containing the user settings data that are about to be sent to the database
			 * @var array	error				Array with error lang keys
			 * @since 2.0.0-RC7
			 */
			$vars = array(
				'mchat_new_config',
				'error',
			);
			extract($this->dispatcher->trigger_event('dmzx.mchat.ucp_update_data', compact($vars)));

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

		$selected_date = $this->settings->cfg('mchat_date');
		$template_data = $this->settings->get_date_template_data($selected_date);

		$auth_count = 0;

		foreach (array_keys($this->settings->ucp_settings()) as $config_name)
		{
			$upper = strtoupper($config_name);
			$auth = $this->auth->acl_get('u_' . $config_name);

			$template_data[$upper] = $this->settings->cfg($config_name);
			$template_data[$upper . '_AUTH'] = $auth;

			if ($auth)
			{
				$auth_count++;
			}
		}

		$template_data = array_merge($template_data, array(
			'MCHAT_POSTS_ENABLED_LANG'		=> $this->settings->get_enabled_post_notifications_lang(),
			'ERROR'							=> sizeof($error) ? implode('<br />', $error) : '',
			'MCHAT_AUTH_COUNT'				=> $auth_count,
			'S_UCP_ACTION'					=> $u_action,
		));

		/**
		 * Event to modify UCP settings template data
		 *
		 * @event dmzx.mchat.ucp_modify_template_data
		 * @var array	template_data	Array containing the template data for the UCP settings
		 * @var int		auth_count		Number of settings the user is authorized do see & adjust
		 * @var array	error			Array with error lang keys
		 * @since 2.0.0-RC7
		 */
		$vars = array(
			'template_data',
			'auth_count',
			'error',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.ucp_modify_template_data', compact($vars)));

		$this->template->assign_vars($template_data);
	}
}
