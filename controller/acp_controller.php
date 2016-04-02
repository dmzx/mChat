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

class acp_controller
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \dmzx\mchat\core\settings */
	protected $settings;

	/** @var string */
	protected $mchat_table;

	/** @var string */
	protected $mchat_deleted_messages_table;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\log\log_interface			$log
	 * @param \phpbb\user						$user
	 * @param \phpbb\db\driver\driver_interface	$db
	 * @param \phpbb\cache\service				$cache
	 * @param \phpbb\request\request			$request
	 * @param \dmzx\mchat\core\settings			$settings
	 * @param string							$mchat_table
	 * @param string							$mchat_deleted_messages_table
	 * @param string							$root_path
	 * @param string							$php_ext
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, \phpbb\request\request $request, \dmzx\mchat\core\settings $settings, $mchat_table, $mchat_deleted_messages_table, $root_path, $php_ext)
	{
		$this->template						= $template;
		$this->log							= $log;
		$this->user							= $user;
		$this->db							= $db;
		$this->cache						= $cache;
		$this->request						= $request;
		$this->settings						= $settings;
		$this->mchat_table					= $mchat_table;
		$this->mchat_deleted_messages_table	= $mchat_deleted_messages_table;
		$this->root_path					= $root_path;
		$this->php_ext						= $php_ext;
	}

	/**
	 * Display the options the admin can configure for this extension
	 *
	 * @param string $u_action
	 */
	public function globalsettings($u_action)
	{
		add_form_key('acp_mchat');

		$error = array();

		if ($this->request->is_set_post('mchat_purge') && $this->request->variable('mchat_purge_confirm', false) && check_form_key('acp_mchat') && $this->user->data['user_type'] == USER_FOUNDER)
		{
			$this->db->sql_query('TRUNCATE TABLE ' . $this->mchat_table);
			$this->db->sql_query('TRUNCATE TABLE ' . $this->mchat_deleted_messages_table);
			$this->cache->destroy('sql', $this->mchat_deleted_messages_table);
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PURGED', false, array($this->user->data['username']));
			trigger_error($this->user->lang('MCHAT_PURGED') . adm_back_link($u_action));
		}
		else if ($this->request->is_set_post('submit'))
		{
			$mchat_new_config = array();
			$validation = array();
			foreach ($this->settings->global as $config_name => $config_data)
			{
				$default = $this->settings->cfg($config_name);
				settype($default, gettype($config_data['default']));
				$mchat_new_config[$config_name] = $this->request->variable($config_name, $default, is_string($default));
				if (isset($config_data['validation']))
				{
					$validation[$config_name] = $config_data['validation'];
				}
			}

			if (!function_exists('validate_data'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			$error = array_merge($error, validate_data($mchat_new_config, $validation));

			if (!check_form_key('acp_mchat'))
			{
				$error[] = 'FORM_INVALID';
			}

			if (!$error)
			{
				// Set the options the user configured
				foreach ($mchat_new_config as $config_name => $config_value)
				{
					$this->settings->set_cfg($config_name, $config_value);
				}

				// Add an entry into the log table
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_CONFIG_UPDATE', false, array($this->user->data['username']));

				trigger_error($this->user->lang('MCHAT_CONFIG_SAVED') . adm_back_link($u_action));
			}

			// Replace "error" strings with their real, localised form
			$error = array_map(array($this->user, 'lang'), $error);
		}

		foreach (array_keys($this->settings->global) as $key)
		{
			$this->template->assign_var(strtoupper($key), $this->settings->cfg($key));
		}

		$this->template->assign_vars(array(
			'MCHAT_ERROR'							=> $error ? implode('<br />', $error) : '',
			'MCHAT_VERSION'							=> $this->settings->cfg('mchat_version'),
			'MCHAT_FOUNDER'							=> $this->user->data['user_type'] == USER_FOUNDER,
			'L_MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> $this->user->lang('MCHAT_BBCODES_DISALLOWED_EXPLAIN', '<a href="' . append_sid("{$this->root_path}adm/index.$this->php_ext", 'i=bbcodes', true, $this->user->session_id) . '">', '</a>'),
			'L_MCHAT_TIMEOUT_EXPLAIN'				=> $this->user->lang('MCHAT_USER_TIMEOUT_EXPLAIN','<a href="' . append_sid("{$this->root_path}adm/index.$this->php_ext", 'i=board&amp;mode=load', true, $this->user->session_id) . '">', '</a>', $this->settings->cfg('session_length')),
			'U_ACTION'								=> $u_action,
		));
	}

	/**
	 * @param string $u_action
	 */
	public function globalusersettings($u_action)
	{
		add_form_key('acp_mchat');

		$this->user->add_lang_ext('dmzx/mchat', 'mchat_ucp');

		$error = array();

		if ($this->request->is_set_post('submit'))
		{
			$mchat_new_config = array();
			$validation = array();
			foreach ($this->settings->ucp as $config_name => $config_data)
			{
				$default = $this->settings->cfg($config_name, true);
				settype($default, gettype($config_data['default']));
				$mchat_new_config[$config_name] = $this->request->variable('user_' . $config_name, $default, is_string($default));

				if (isset($config_data['validation']))
				{
					$validation[$config_name] = $config_data['validation'];
				}
			}

			if (!function_exists('validate_data'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			$error = array_merge($error, validate_data($mchat_new_config, $validation));

			if (!check_form_key('acp_mchat'))
			{
				$error[] = 'FORM_INVALID';
			}

			if (!$error)
			{
				if ($this->request->variable('mchat_overwrite', 0) && $this->request->variable('mchat_overwrite_confirm', 0))
				{
					$mchat_new_user_config = array();
					foreach ($mchat_new_config as $config_name => $config_value)
					{
						$mchat_new_user_config['user_' . $config_name] = $config_value;
					}

					$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $mchat_new_user_config);
					$this->db->sql_query($sql);
				}

				// Set the options the user configured
				foreach ($mchat_new_config as $config_name => $config_value)
				{
					$this->settings->set_cfg($config_name, $config_value);
				}

				// Add an entry into the log table
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_CONFIG_UPDATE', false, array($this->user->data['username']));

				trigger_error($this->user->lang('MCHAT_CONFIG_SAVED') . adm_back_link($u_action));
			}

			// Replace "error" strings with their real, localised form
			$error = array_map(array($this->user, 'lang'), $error);
		}

		foreach (array_keys($this->settings->ucp) as $key)
		{
			$this->template->assign_var(strtoupper($key), $this->settings->cfg($key, true));
		}

		// Force global date format for $selected value, not user-specific
		$selected = $this->settings->cfg('mchat_date', true);
		$date_template_data = $this->settings->get_date_template_data($selected);
		$this->template->assign_vars($date_template_data);

		$notifications_template_data = $this->settings->get_enabled_post_notifications_lang();
		$this->template->assign_var('MCHAT_POSTS_ENABLED_LANG', $notifications_template_data);

		$this->template->assign_vars(array(
			'MCHAT_ERROR'							=> $error ? implode('<br />', $error) : '',
			'MCHAT_VERSION'							=> $this->settings->cfg('mchat_version'),
			'U_ACTION'								=> $u_action,
		));
	}
}
