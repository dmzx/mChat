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
	/** @var \dmzx\mchat\core\functions_mchat */
	protected $functions_mchat;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $table_prefix;

	/** @var string */
	public $u_action;

	protected $mchat_config_table;

	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, $container, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, \phpbb\request\request $request, $phpbb_root_path, $phpEx, $table_prefix, $mchat_config_table)
	{
		$this->functions_mchat = $container->get('dmzx.mchat.functions_mchat');
		$this->config = $config;
		$this->config_text = $container->get('config_text');
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->container = $container;
		$this->cache = $cache;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
		$this->table_prefix = $container->getParameter('core.table_prefix');
		$this->mchat_config_table = $mchat_config_table;
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

		$mchat_row = array(
			'location'			=> $this->request->variable('mchat_location', 0),
			'refresh' 			=> $this->request->variable('mchat_refresh', 0),
			'message_limit'		=> $this->request->variable('mchat_message_limit', 0),
			'message_num'		=> $this->request->variable('mchat_message_num', 0),
			'archive_limit'		=> $this->request->variable('mchat_archive_limit', 0),
			'flood_time'		=> $this->request->variable('mchat_flood_time', 0),
			'max_message_lngth'	=> $this->request->variable('mchat_max_message_lngth', 0),
			'custom_page'		=> $this->request->variable('mchat_custom_page', 0),
			'date'				=> $this->request->variable('mchat_date', '', true),
			'whois'				=> $this->request->variable('mchat_whois', 0),
			'whois_refresh'		=> $this->request->variable('mchat_whois_refresh', 0),
			'bbcode_disallowed'	=> utf8_normalize_nfc($this->request->variable('mchat_bbcode_disallowed', '', true)),
			'prune_enable'		=> $this->request->variable('mchat_prune_enable', 0),
			'prune_num'			=> $this->request->variable('mchat_prune_num', 0),
			'index_height'		=> $this->request->variable('mchat_index_height', 0),
			'custom_height'		=> $this->request->variable('mchat_custom_height', 0),
			'static_message'	=> utf8_normalize_nfc($this->request->variable('mchat_static_message', '', true)),
			'override_min_post_chars'	=> $this->request->variable('mchat_override_min_post_chars', 0),
			'override_smilie_limit'	=> $this->request->variable('mchat_override_smilie_limit', 0),
			'timeout'			=> $this->request->variable('mchat_timeout', 0),
			'pause_on_input'	=> $this->request->variable('mchat_pause_on_input', 0),
			'rules'				=> utf8_normalize_nfc($this->request->variable('mchat_rules', '', true)),
			'avatars'			=> $this->request->variable('mchat_avatars', 0),
		);

		if ($this->request->is_set_post('submit'))
		{
			if (!function_exists('validate_data'))
			{
				include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
			}

			// validate the entries...most of them anyway
			$mchat_array = array(
				'static_message'	=> array('string', false, 0, 255),
				'index_height'		=> array('num', false, 50, 1000),
				'custom_height'		=> array('num', false, 50, 1000),
				'whois_refresh'		=> array('num', false, 30, 300),
				'refresh'			=> array('num', false, 5, 60),
				'message_limit'		=> array('num', false, 10, 30),
				'message_num'		=> array('num', false, 10, 50),
				'archive_limit'		=> array('num', false, 25, 50),
				'flood_time'		=> array('num', false, 0, 30),
				'max_message_lngth'	=> array('num', false, 0, 500),
				'timeout'			=> array('num', false, 0, (int) $this->config['session_length']),
				'rules'				=> array('string', false, 0, 255),
			);

			$error = validate_data($mchat_row, $mchat_array);

			if (!check_form_key('acp_mchat'))
			{
				$error[] = 'FORM_INVALID';
			}

			// Replace "error" strings with their real, localised form
			$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$this->user->lang['\\1'])) ? \$this->user->lang['\\1'] : '\\1'", $error);

			if (!sizeof($error))
			{
				foreach ($mchat_row as $config_name => $config_value)
				{
					$sql = 'UPDATE ' . $this->mchat_config_table . "
						SET config_value = '" . $this->db->sql_escape($config_value) . "'
						WHERE config_name = '" . $this->db->sql_escape($config_name) . "'";
					$this->db->sql_query($sql);
				}

			// Set the options the user configured
			$this->set_options();

				// and an entry into the log table
				$log = $this->container->get('log');
				$log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_CONFIG_UPDATE');

				// purge the cache
				$this->cache->destroy('_mchat_config');

				// rebuild the cache
				$this->functions_mchat->mchat_cache();

				trigger_error($this->user->lang['MCHAT_CONFIG_SAVED'] . adm_back_link($this->u_action));
			}
		}

		// let's get it on
		$sql = 'SELECT * FROM ' . $this->mchat_config_table;
		$result = $this->db->sql_query($sql);
		$mchat_config = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$mchat_config[$row['config_name']] = $row['config_value'];
		}
		$this->db->sql_freeresult($result);

		$mchat_enable = isset($this->config['mchat_enable']) ? $this->config['mchat_enable'] : 0;
		$mchat_on_index = isset($this->config['mchat_on_index']) ? $this->config['mchat_on_index'] : 0;
		$mchat_version = isset($this->config['mchat_version']) ? $this->config['mchat_version'] : '';
		$mchat_new_posts = isset($this->config['mchat_new_posts']) ? $this->config['mchat_new_posts'] : 0;
		$mchat_new_posts_topic = isset($this->config['mchat_new_posts_topic']) ? $this->config['mchat_new_posts_topic'] : 0;
		$mchat_new_posts_reply = isset($this->config['mchat_new_posts_reply']) ? $this->config['mchat_new_posts_reply'] : 0;
		$mchat_new_posts_edit = isset($this->config['mchat_new_posts_edit']) ? $this->config['mchat_new_posts_edit'] : 0;
		$mchat_new_posts_quote = isset($this->config['mchat_new_posts_quote']) ? $this->config['mchat_new_posts_quote'] : 0;
		$mchat_stats_index = isset($this->config['mchat_stats_index']) ? $this->config['mchat_stats_index'] : 0;
		$mchat_message_top = isset($this->config['mchat_message_top']) ? $this->config['mchat_message_top'] : 0;

		$dateformat_options = '';
		foreach ($this->user->lang['dateformats'] as $format => $null)
		{
			$dateformat_options .= '<option value="' . $format . '"' . (($format == $mchat_config['date']) ? ' selected="selected"' : '') . '>';
			$dateformat_options .= $this->user->format_date(time(), $format, false) . ((strpos($format, '|') !== false) ? $this->user->lang['VARIANT_DATE_SEPARATOR'] . $this->user->format_date(time(), $format, true) : '');
			$dateformat_options .= '</option>';
		}

		$s_custom = false;
		$dateformat_options .= '<option value="custom"';
		if (!isset($this->user->lang['dateformats'][$mchat_config['date']]))
		{
			$dateformat_options .= ' selected="selected"';
			$s_custom = true;
		}
		$dateformat_options .= '>' . $this->user->lang['MCHAT_CUSTOM_DATEFORMAT'] . '</option>';

		$this->template->assign_vars(array(
			'MCHAT_ERROR'					=> isset($error) ? ((sizeof($error)) ? implode('<br />', $error) : '') : '',
			'MCHAT_VERSION'					=> $mchat_version,
			'MCHAT_PRUNE'					=> !empty($mchat_row['prune_enable']) ? $mchat_row['prune_enable'] : $mchat_config['prune_enable'],
			'MCHAT_PRUNE_NUM'				=> !empty($mchat_row['prune_num']) ? $mchat_row['prune_num'] : $mchat_config['prune_num'],
			'MCHAT_ENABLE'					=> ($mchat_enable) ? true : false,
			'MCHAT_ON_INDEX'				=> ($mchat_on_index) ? true : false,
			'MCHAT_MESSAGE_TOP'				=> ($mchat_message_top) ? true : false,
			'MCHAT_LOCATION'				=> !empty($mchat_row['location']) ? $mchat_row['location'] : $mchat_config['location'],
			'MCHAT_REFRESH'					=> !empty($mchat_row['refresh']) ? $mchat_row['refresh'] : $mchat_config['refresh'],
			'MCHAT_WHOIS_REFRESH'			=> !empty($mchat_row['whois_refresh']) ? $mchat_row['whois_refresh'] : $mchat_config['whois_refresh'],
			'MCHAT_MESSAGE_LIMIT'			=> !empty($mchat_row['message_limit']) ? $mchat_row['message_limit'] : $mchat_config['message_limit'],
			'MCHAT_MESSAGE_NUM'				=> !empty($mchat_row['message_num']) ? $mchat_row['message_num'] : $mchat_config['message_num'],
			'MCHAT_ARCHIVE_LIMIT'			=> !empty($mchat_row['archive_limit']) ? $mchat_row['archive_limit'] : $mchat_config['archive_limit'],
			'MCHAT_AVATARS'					=> !empty($mchat_row['avatars']) ? $mchat_row['avatars'] : $mchat_config['avatars'],
			'MCHAT_FLOOD_TIME'				=> !empty($mchat_row['flood_time']) ? $mchat_row['flood_time'] : $mchat_config['flood_time'],
			'MCHAT_MAX_MESSAGE_LNGTH'		=> !empty($mchat_row['max_message_lngth']) ? $mchat_row['max_message_lngth'] : $mchat_config['max_message_lngth'],
			'MCHAT_CUSTOM_PAGE'				=> !empty($mchat_row['custom_page']) ? $mchat_row['custom_page'] : $mchat_config['custom_page'],
			'MCHAT_DATE'					=> !empty($mchat_row['date']) ? $mchat_row['date'] : $mchat_config['date'],
			'MCHAT_DEFAULT_DATEFORMAT'		=> $this->config['default_dateformat'],
			'MCHAT_RULES'					=> !empty($mchat_row['rules']) ? $mchat_row['rules'] : $mchat_config['rules'],
			'MCHAT_WHOIS'					=> !empty($mchat_row['whois']) ? $mchat_row['whois'] : $mchat_config['whois'],
			'MCHAT_STATS_INDEX'				=> ($mchat_stats_index) ? true : false,
			'MCHAT_BBCODE_DISALLOWED'		=> !empty($mchat_row['bbcode_disallowed']) ? $mchat_row['bbcode_disallowed'] : $mchat_config['bbcode_disallowed'],
			'MCHAT_STATIC_MESSAGE'			=> !empty($mchat_row['static_message']) ? $mchat_row['static_message'] : $mchat_config['static_message'],
			'MCHAT_INDEX_HEIGHT'			=> !empty($mchat_row['index_height']) ? $mchat_row['index_height'] : $mchat_config['index_height'],
			'MCHAT_CUSTOM_HEIGHT'			=> !empty($mchat_row['custom_height']) ? $mchat_row['custom_height'] : $mchat_config['custom_height'],
			'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> !empty($mchat_row['override_smilie_limit']) ? $mchat_row['override_smilie_limit'] : $mchat_config['override_smilie_limit'],
			'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> !empty($mchat_row['override_min_post_chars']) ? $mchat_row['override_min_post_chars'] : $mchat_config['override_min_post_chars'],
			'MCHAT_TIMEOUT'					=> !empty($mchat_row['timeout']) ? $mchat_row['timeout'] : $mchat_config['timeout'],
			'MCHAT_NEW_POSTS'				=> ($mchat_new_posts) ? true : false,
			'MCHAT_NEW_POSTS_TOPIC'				=> ($mchat_new_posts_topic) ? true : false,
			'MCHAT_NEW_POSTS_REPLY'				=> ($mchat_new_posts_reply) ? true : false,
			'MCHAT_NEW_POSTS_EDIT'				=> ($mchat_new_posts_edit) ? true : false,
			'MCHAT_NEW_POSTS_QUOTE'				=> ($mchat_new_posts_quote) ? true : false,
			'MCHAT_PAUSE_ON_INPUT'			=> !empty($mchat_row['pause_on_input']) ? $mchat_row['pause_on_input'] : $mchat_config['pause_on_input'],
			'L_MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> sprintf($this->user->lang['MCHAT_BBCODES_DISALLOWED_EXPLAIN'], '<a href="' . append_sid("{$this->phpbb_root_path}index.$this->php_ext", 'i=bbcodes', true, $this->user->session_id) . '">', '</a>'),
			'L_MCHAT_TIMEOUT_EXPLAIN'		=> sprintf($this->user->lang['MCHAT_USER_TIMEOUT_EXPLAIN'],'<a href="' . append_sid("{$this->phpbb_root_path}index.$this->php_ext", 'i=board&amp;mode=load', true, $this->user->session_id) . '">', '</a>', $this->config['session_length']),
			'S_MCHAT_DATEFORMAT_OPTIONS'	=> $dateformat_options,
			'S_CUSTOM_DATEFORMAT'			=> $s_custom,

			'U_ACTION'						=> $this->u_action)
		);

	}
	/**
	* Set the options a user can configure
	*
	* @return null
	* @access protected
	*/
	protected function set_options()
	{

		//update setting in config table for mod enabled or not
		$this->config->set('mchat_enable', $this->request->variable('mchat_enable', 0));
		// update setting in config table for allowing on index or not
		$this->config->set('mchat_on_index', $this->request->variable('mchat_on_index', 0));
		// update setting in config table to enable posts to display or not
		$this->config->set('mchat_new_posts', $this->request->variable('mchat_new_posts', 0));
		// update setting in config table to allow topic to display or not
		$this->config->set('mchat_new_posts_topic', $this->request->variable('mchat_new_posts_topic', 0));
		// update setting in config table to allow replies to display or not
		$this->config->set('mchat_new_posts_reply', $this->request->variable('mchat_new_posts_reply', 0));
		// update setting in config table to allow edit posts to display or not
		$this->config->set('mchat_new_posts_edit', $this->request->variable('mchat_new_posts_edit', 0));
		// update setting in config table to allow quoted posts to display or not
		$this->config->set('mchat_new_posts_quote', $this->request->variable('mchat_new_posts_quote', 0));
		// update setting in config table for stats on index
		$this->config->set('mchat_stats_index', $this->request->variable('mchat_stats_index', 0));
		// update setting in config table for message on top
		$this->config->set('mchat_message_top', $this->request->variable('mchat_message_top', 0));

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