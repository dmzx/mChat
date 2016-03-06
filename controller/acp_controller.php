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
	/** @var \phpbb\config\config */
	protected $config;

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
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\log\log_interface			$log
	 * @param \phpbb\user						$user
	 * @param \phpbb\db\driver\driver_interface	$db
	 * @param \phpbb\cache\service				$cache
	 * @param \phpbb\request\request			$request
	 * @param string							$mchat_table
	 * @param string							$mchat_deleted_messages_table
	 * @param string							$root_path
	 * @param string							$php_ext
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, \phpbb\request\request $request, $mchat_table, $mchat_deleted_messages_table, $root_path, $php_ext)
	{
		$this->config						= $config;
		$this->template						= $template;
		$this->log							= $log;
		$this->user							= $user;
		$this->db							= $db;
		$this->cache						= $cache;
		$this->request						= $request;
		$this->mchat_table					= $mchat_table;
		$this->mchat_deleted_messages_table	= $mchat_deleted_messages_table;
		$this->root_path					= $root_path;
		$this->php_ext						= $php_ext;
	}

	/**
	 * Display the options the admin can configure for this extension
	 *
	 * @param $u_action
	 */
	public function display_options($u_action)
	{
		add_form_key('acp_mchat');

		$mchat_config = array(
			'mchat_archive_limit'			=> array('default' => 25,				'validation' => array('num', false, 25, 50)),
			'mchat_avatars'					=> array('default' => 1,				'validation' => array()),
			'mchat_bbcode_disallowed'		=> array('default' => '',				'validation' => array('string', false, 0, 255)),
			'mchat_custom_height'			=> array('default' => 350,				'validation' => array('num', false, 50, 1000)),
			'mchat_custom_page'				=> array('default' => 1,				'validation' => array()),
			'mchat_relative_time'			=> array('default' => 1,				'validation' => array()),
			'mchat_date'					=> array('default' => 'D M d, Y g:i a',	'validation' => array('string', false, 0, 255)),
			'mchat_edit_delete_limit'		=> array('default' => 0,				'validation' => array()),
			'mchat_flood_time'				=> array('default' => 0,				'validation' => array('num', false, 0, 30)),
			'mchat_index_height'			=> array('default' => 250,				'validation' => array('num', false, 50, 1000)),
			'mchat_live_updates'			=> array('default' => 1,				'validation' => array()),
			'mchat_location'				=> array('default' => 0,				'validation' => array()),
			'mchat_max_message_lngth'		=> array('default' => 500,				'validation' => array('num', false, 0, 500)),
			'mchat_message_limit'			=> array('default' => 10,				'validation' => array('num', false, 10, 30)),
			'mchat_message_num'				=> array('default' => 10,				'validation' => array('num', false, 10, 50)),
			'mchat_message_top'				=> array('default' => 1,				'validation' => array()),
			'mchat_navbar_link'				=> array('default' => 1,				'validation' => array()),
			'mchat_new_posts_edit'			=> array('default' => 0,				'validation' => array()),
			'mchat_new_posts_quote'			=> array('default' => 0,				'validation' => array()),
			'mchat_new_posts_reply'			=> array('default' => 0,				'validation' => array()),
			'mchat_new_posts_topic'			=> array('default' => 0,				'validation' => array()),
			'mchat_on_index'				=> array('default' => 1,				'validation' => array()),
			'mchat_override_min_post_chars'	=> array('default' => 0,				'validation' => array()),
			'mchat_override_smilie_limit'	=> array('default' => 0,				'validation' => array()),
			'mchat_pause_on_input'			=> array('default' => 0,				'validation' => array()),
			'mchat_prune'					=> array('default' => 0,				'validation' => array()),
			'mchat_prune_num'				=> array('default' => 0,				'validation' => array()),
			'mchat_refresh'					=> array('default' => 10,				'validation' => array('num', false, 5, 60)),
			'mchat_rules'					=> array('default' => '',				'validation' => array('string', false, 0, 255)),
			'mchat_static_message'			=> array('default' => '',				'validation' => array('string', false, 0, 255)),
			'mchat_stats_index'				=> array('default' => 0,				'validation' => array()),
			'mchat_timeout'					=> array('default' => 0,				'validation' => array('num', false, 0, (int) $this->config['session_length'])),
			'mchat_whois'					=> array('default' => 1,				'validation' => array()),
			'mchat_whois_refresh'			=> array('default' => 60,				'validation' => array('num', false, 30, 300)),
		);

		if ($this->request->is_set_post('mchat_purge'))
		{
			$this->template->assign_var('MCHAT_PURGE', true);
		}
		else if ($this->request->is_set_post('mchat_purge_confirm'))
		{
			if (check_form_key('acp_mchat') && $this->user->data['user_type'] == USER_FOUNDER)
			{
				$this->db->sql_query('TRUNCATE TABLE ' . $this->mchat_table);
				$this->db->sql_query('TRUNCATE TABLE ' . $this->mchat_deleted_messages_table);
				$this->cache->destroy('sql', $this->mchat_deleted_messages_table);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PURGED', false, array($this->user->data['username']));
				trigger_error($this->user->lang('MCHAT_PURGED') . adm_back_link($u_action));
			}
		}
		else if ($this->request->is_set_post('submit'))
		{
			if (!function_exists('validate_data'))
			{
				include($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			$mchat_new_config = array();
			$validation = array();
			foreach ($mchat_config as $key => $value)
			{
				$mchat_new_config[$key] = $this->request->variable($key, $value['default'], is_string($value['default']));
				if (!empty($value['validation']))
				{
					$validation[$key] = $value['validation'];
				}
			}

			$error = validate_data($mchat_new_config, $validation);

			if (!check_form_key('acp_mchat'))
			{
				$error[] = 'FORM_INVALID';
			}

			if (empty($error))
			{
				// Set the options the user configured
				foreach ($mchat_new_config as $config_name => $config_value)
				{
					$this->config->set($config_name, $config_value);
				}

				// Add an entry into the log table
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_CONFIG_UPDATE', false, array($this->user->data['username']));

				trigger_error($this->user->lang('MCHAT_CONFIG_SAVED') . adm_back_link($u_action));
			}

			// Replace "error" strings with their real, localised form
			$error = array_map(array($this->user, 'lang'), $error);
		}

		$dateformat_options = '';
		foreach ($this->user->lang['dateformats'] as $format => $null)
		{
			$dateformat_options .= '<option value="' . $format . '"' . (($format == $this->config['mchat_date']) ? ' selected="selected"' : '') . '>';
			$dateformat_options .= $this->user->format_date(time(), $format, false) . ((strpos($format, '|') !== false) ? $this->user->lang('VARIANT_DATE_SEPARATOR') . $this->user->format_date(time(), $format, true) : '');
			$dateformat_options .= '</option>';
		}

		$s_custom = false;
		$dateformat_options .= '<option value="custom"';
		if (!isset($this->user->lang['dateformats'][$this->config['mchat_date']]))
		{
			$dateformat_options .= ' selected="selected"';
			$s_custom = true;
		}
		$dateformat_options .= '>' . $this->user->lang('MCHAT_CUSTOM_DATEFORMAT') . '</option>';

		foreach (array_keys($mchat_config) as $key)
		{
			$this->template->assign_var(strtoupper($key), $this->config[$key]);
		}

		$this->template->assign_vars(array(
			'MCHAT_ERROR'							=> !empty($error) ? implode('<br />', $error) : '',
			'MCHAT_VERSION'							=> $this->config['mchat_version'],
			'MCHAT_FOUNDER'							=> $this->user->data['user_type'] == USER_FOUNDER,
			'L_MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> $this->user->lang('MCHAT_BBCODES_DISALLOWED_EXPLAIN', '<a href="' . append_sid("{$this->root_path}adm/index.$this->php_ext", 'i=bbcodes', true, $this->user->session_id) . '">', '</a>'),
			'L_MCHAT_TIMEOUT_EXPLAIN'				=> $this->user->lang('MCHAT_USER_TIMEOUT_EXPLAIN','<a href="' . append_sid("{$this->root_path}adm/index.$this->php_ext", 'i=board&amp;mode=load', true, $this->user->session_id) . '">', '</a>', $this->config['session_length']),
			'S_MCHAT_DATEFORMAT_OPTIONS'			=> $dateformat_options,
			'S_CUSTOM_DATEFORMAT'					=> $s_custom,
			'U_ACTION'								=> $u_action,
		));
	}
}
