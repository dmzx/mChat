<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\controller;

class admin_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	public $u_action;

	/**
	* Constructor
	*
	* @param \phpbb\config\config				$config
	* @param \phpbb\template\template			$template
	* @param \phpbb\log\log_interface			$log
	* @param \phpbb\user						$user
	* @param \phpbb\cache\service				$cache
	* @param \phpbb\request\request				$request
	* @param \phpbb\extension\manager			$phpbb_extension_manager
	* @param string								$phpbb_root_path
	* @param string								$php_ext
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\cache\service $cache, \phpbb\request\request $request, \phpbb\extension\manager $phpbb_extension_manager, $phpbb_root_path, $php_ext)
	{
		$this->config					= $config;
		$this->template					= $template;
		$this->log						= $log;
		$this->user						= $user;
		$this->cache					= $cache;
		$this->request					= $request;
		$this->phpbb_extension_manager	= $phpbb_extension_manager;
		$this->phpbb_root_path			= $phpbb_root_path;
		$this->php_ext					= $php_ext;
	}

	/**
	* Display the options a user can configure for this extension
	*
	* @return null
	* @access public
	*/
	public function display_options()
	{
		add_form_key('acp_mchat');

		$mchat_config = array(
			'mchat_archive_limit'			=> array('default' => 25,				'validation' => array('num', false, 25, 50)),
			'mchat_avatars'					=> array('default' => 1,				'validation' => array()),
			'mchat_bbcode_disallowed'		=> array('default' => '',				'validation' => array('string', false, 0, 255)),
			'mchat_custom_height'			=> array('default' => 350,				'validation' => array('num', false, 50, 1000)),
			'mchat_custom_page'				=> array('default' => 1,				'validation' => array()),
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
			'mchat_new_posts'				=> array('default' => 0,				'validation' => array()),
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

		if ($this->request->is_set_post('submit'))
		{
			if (!function_exists('validate_data'))
			{
				include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
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

			// Replace "error" strings with their real, localised form
			$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$this->user->lang('\\1'))) ? \$this->user->lang('\\1') : '\\1'", $error);

			if (empty($error))
			{
				// Set the options the user configured
				foreach ($mchat_new_config as $config_name => $config_value)
				{
					$this->config->set($config_name, $config_value);
				}

				// Add an entry into the log table
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_CONFIG_UPDATE');

				trigger_error($this->user->lang('MCHAT_CONFIG_SAVED') . adm_back_link($this->u_action));
			}
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

		$template_variables = array();
		foreach ($mchat_config as $key => $value)
		{
			$template_variables[strtoupper($key)] = $this->config[$key];
		}

		$this->template->assign_vars(array_merge($template_variables, array(
			'MCHAT_ERROR'							=> !empty($error) ? implode('<br />', $error) : '',
			'MCHAT_VERSION'							=> $this->config['mchat_version'],
			'L_MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> sprintf($this->user->lang('MCHAT_BBCODES_DISALLOWED_EXPLAIN'), '<a href="' . append_sid("{$this->phpbb_root_path}adm/index.$this->php_ext", 'i=bbcodes', true, $this->user->session_id) . '">', '</a>'),
			'L_MCHAT_TIMEOUT_EXPLAIN'				=> sprintf($this->user->lang('MCHAT_USER_TIMEOUT_EXPLAIN'),'<a href="' . append_sid("{$this->phpbb_root_path}adm/index.$this->php_ext", 'i=board&amp;mode=load', true, $this->user->session_id) . '">', '</a>', $this->config['session_length']),
			'S_MCHAT_DATEFORMAT_OPTIONS'			=> $dateformat_options,
			'S_CUSTOM_DATEFORMAT'					=> $s_custom,
			'U_ACTION'								=> $this->u_action,
		)));

		// Version check
		$this->user->add_lang(array('install', 'acp/extensions', 'migrator'));
		$ext_name = 'dmzx/mchat';
		$md_manager = new \phpbb\extension\metadata_manager($ext_name, $this->config, $this->phpbb_extension_manager, $this->template, $this->user, $this->phpbb_root_path);
		try
		{
			$this->metadata = $md_manager->get_metadata('all');
		}
		catch(\phpbb\extension\exception $e)
		{
			trigger_error($e, E_USER_WARNING);
		}
		$md_manager->output_template_data();
		try
		{
			$updates_available = $this->version_check($md_manager, $this->request->variable('versioncheck_force', false));
			$this->template->assign_vars(array(
				'S_UP_TO_DATE'		=> empty($updates_available),
				'S_VERSIONCHECK'	=> true,
				'UP_TO_DATE_MSG'	=> $this->user->lang(empty($updates_available) ? 'UP_TO_DATE' : 'NOT_UP_TO_DATE', $md_manager->get_metadata('display-name')),
			));
			foreach ($updates_available as $branch => $version_data)
			{
				$this->template->assign_block_vars('updates_available', $version_data);
			}
		}
		catch (\RuntimeException $e)
		{
			$this->template->assign_vars(array(
				'S_VERSIONCHECK_STATUS'			=> $e->getCode(),
				'VERSIONCHECK_FAIL_REASON'		=> $e->getMessage() !== $this->user->lang('VERSIONCHECK_FAIL') ? $e->getMessage() : '',
			));
		}
	}

	protected function version_check(\phpbb\extension\metadata_manager $md_manager, $force_update = false, $force_cache = false)
	{
		$meta = $md_manager->get_metadata('all');
		if (!isset($meta['extra']['version-check']))
		{
			throw new \RuntimeException($this->user->lang('NO_VERSIONCHECK'), 1);
		}
		$version_check = $meta['extra']['version-check'];
		$version_helper = new \phpbb\version_helper($this->cache, $this->config, new \phpbb\file_downloader(), $this->user);
		$version_helper->set_current_version($meta['version']);
		$version_helper->set_file_location($version_check['host'], $version_check['directory'], $version_check['filename']);
		$version_helper->force_stability($this->config['extension_force_unstable'] ? 'unstable' : null);
		return $updates = $version_helper->get_suggested_updates($force_update, $force_cache);
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
