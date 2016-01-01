<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

class render_helper
{
	/** @var \dmzx\mchat\core\functions_mchat */
	protected $functions_mchat;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\event\dispatcher_interface */
	protected $dispatcher;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $phpEx;

	/** @var string */
	protected $mchat_table;

	/** @var boolean */
	public $is_mchat_rendered = false;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\functions_mchat	$functions_mchat
	* @param \phpbb\config\config				$config
	* @param \phpbb\controller\helper			$helper
	* @param \phpbb\template\template			$template
	* @param \phpbb\log\log_interface			$log
	* @param \phpbb\user						$user
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\pagination					$pagination
	* @param \phpbb\request\request				$request
	* @param \phpbb\event\dispatcher_interface	$dispatcher
	* @param string								$phpbb_root_path
	* @param string								$phpEx
	* @param string								$mchat_table
	*/
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\event\dispatcher_interface $dispatcher, $phpbb_root_path, $phpEx, $mchat_table)
	{
		$this->functions_mchat	= $functions_mchat;
		$this->config			= $config;
		$this->helper			= $helper;
		$this->template			= $template;
		$this->log				= $log;
		$this->user				= $user;
		$this->auth				= $auth;
		$this->db				= $db;
		$this->pagination		= $pagination;
		$this->request			= $request;
		$this->dispatcher		= $dispatcher;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->phpEx			= $phpEx;
		$this->mchat_table		= $mchat_table;
	}

	/**
	* Method to render the page data
	*
	* @var bool					Bool if the rendering is only for index
	* @return null|array|string	If we are rendering for the index, null is returned. For modes that are only
	*							called via AJAX, an array is returned, otherwise the rendered content is returned.
	*/
	public function render_data_for_page($on_index)
	{
		// If mChat is used on the index by a user without an avatar, a default avatar is used.
		// However, T_THEME_PATH points to ./../styles/... because the controller at /mchat is called, but we need it to be ./styles...
		// Setting this value to true solves this.
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}

		$this->template->assign_vars(array(
			'MCHAT_ENABLE'		=> $this->config['mchat_enable'],
			'MCHAT_DISABLE'		=> !$this->config['mchat_enable'],
		));

		if (!$this->config['mchat_enable'])
		{
			if ($this->request->is_ajax())
			{
				throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
			}
			else if (!$on_index)
			{
				return $this->helper->render('mchat_body.html', $this->user->lang('MCHAT_TITLE'));
			}
			return;
		}

		$mchat_view = $this->auth->acl_get('u_mchat_view');

		if ($on_index && (!$this->config['mchat_on_index'] || !$mchat_view))
		{
			return;
		}

		if (!$mchat_view)
		{
			// Forbidden
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		// Add lang file
		$this->user->add_lang('posting');

		$config_mchat = $this->functions_mchat->mchat_cache();

		// Access rights
		$mchat_allow_bbcode		= $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_smilies			= $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies');
		$mchat_urls				= $this->config['allow_post_links'] && $this->auth->acl_get('u_mchat_urls');
		$mchat_ip				= $this->auth->acl_get('u_mchat_ip');
		$mchat_pm				= $this->auth->acl_get('u_mchat_pm');
		$mchat_use				= $this->auth->acl_get('u_mchat_use');
		$mchat_no_flood			= $this->auth->acl_get('u_mchat_flood_ignore');
		$mchat_read_archive		= $this->auth->acl_get('u_mchat_archive');
		$mchat_founder			= $this->user->data['user_type'] == USER_FOUNDER;
		$mchat_session_time		= !empty($config_mchat['timeout']) ? $config_mchat['timeout'] : (!empty($this->config['load_online_time']) ? $this->config['load_online_time'] * 60 : $this->config['session_length']);
		$mchat_rules			= !empty($config_mchat['rules']) || isset($this->user->lang['MCHAT_RULES']);
		$mchat_avatars			= !empty($config_mchat['avatars']) && $this->user->optionget('viewavatars') && $this->user->data['user_mchat_avatars'];

		$mchat_mode	= $this->request->variable('mode', '');
		$in_archive = $mchat_mode == 'archive';

		// Return early for all regular HTTP requests that don't require message rendering. No AJAX here!
		switch ($mchat_mode)
		{
			case 'clean':
				if (!$this->user->data['is_registered'])
				{
					// Login box
					login_box('', $this->user->lang('LOGIN'));
				}

				if (!$mchat_founder)
				{
					throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
				}

				$mchat_redirect = $this->request->variable('redirect', '');
				$mchat_redirect = ($mchat_redirect == 'index' ? append_sid("{$this->phpbb_root_path}index.{$this->phpEx}") : $this->helper->route('dmzx_mchat_controller')) . '#mChat';

				if (confirm_box(true))
				{
					// Prune is confirmed
					$this->functions_mchat->mchat_truncate_messages();

					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang('MCHAT_CLEANED'). '<br /><br />' . sprintf($this->user->lang('RETURN_PAGE'), '<a href="' . $mchat_redirect . '">', '</a>'));
				}
				else
				{
					// Display confirm box
					confirm_box(false, $this->user->lang('MCHAT_DELALLMESS'));
				}

				return;

			case 'rules':
				if (!$mchat_rules)
				{
					throw new \phpbb\exception\http_exception(404, 'MCHAT_NO_RULES');
				}

				// If the rules are defined in the language file use them, else just use the entry in the database
				$mchat_rules = isset($this->user->lang['MCHAT_RULES']) ? $this->user->lang('MCHAT_RULES') : $config_mchat['rules'];
				$mchat_rules = explode("\n", $mchat_rules);
				$mchat_rules = array_map('utf8_htmlspecialchars', $mchat_rules);
				$mchat_rules = implode('<br />', $mchat_rules);

				$this->template->assign_var('MCHAT_RULES', $mchat_rules);

				return $this->helper->render('mchat_rules.html', $this->user->lang('MCHAT_HELP'));

			case 'ip':
				if (!$mchat_ip)
				{
					throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
				}

				if (!function_exists('user_ipwhois'))
				{
					include($this->phpbb_root_path . 'includes/functions_user.' . $this->phpEx);
				}

				$user_ip = $this->request->variable('ip', '');
				$this->template->assign_var('WHOIS', user_ipwhois($user_ip));

				return $this->helper->render('viewonline_whois.html', $this->user->lang('WHO_IS_ONLINE'));
		}

		$foes_array = $this->functions_mchat->mchat_foes();

		// If the static message is defined in the language file use it, else the entry in the database is used
		if (isset($this->user->lang['STATIC_MESSAGE']))
		{
			$config_mchat['static_message'] = $this->user->lang('STATIC_MESSAGE');
		}

		// If the static message is defined in the language file use it, else the entry in the database is used
		if (isset($this->user->lang['MCHAT_RULES']))
		{
			$config_mchat['rules'] = $this->user->lang('MCHAT_RULES');
		}

		$this->template->assign_vars(array(
			'MCHAT_FILE_NAME'				=> $this->helper->route('dmzx_mchat_controller'),
			'MCHAT_REFRESH_JS'				=> 1000 * $config_mchat['refresh'],
			'MCHAT_ARCHIVE_MODE'			=> $in_archive,
			'MCHAT_INPUT_TYPE'				=> $this->user->data['user_mchat_input_area'],
			'MCHAT_RULES'					=> $mchat_rules,
			'MCHAT_ALLOW_VIEW'				=> $mchat_view,
			'MCHAT_ALLOW_USE'				=> $mchat_use,
			'MCHAT_ALLOW_SMILES'			=> $mchat_smilies,
			'MCHAT_ALLOW_IP'				=> $mchat_ip,
			'MCHAT_ALLOW_PM'				=> $mchat_pm,
			'MCHAT_ALLOW_LIKE'				=> $mchat_use && $this->auth->acl_get('u_mchat_like'),
			'MCHAT_ALLOW_QUOTE'				=> $mchat_use && $this->auth->acl_get('u_mchat_quote'),
			'MCHAT_ALLOW_BBCODES'			=> $mchat_allow_bbcode,
			'MCHAT_MESSAGE_TOP'				=> $this->config['mchat_message_top'],
			'MCHAT_ARCHIVE_URL'				=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive')),
			'MCHAT_CUSTOM_PAGE'				=> !$on_index,
			'MCHAT_INDEX_HEIGHT'			=> $config_mchat['index_height'],
			'MCHAT_CUSTOM_HEIGHT'			=> $config_mchat['custom_height'],
			'MCHAT_READ_ARCHIVE_BUTTON'		=> $mchat_read_archive,
			'MCHAT_FOUNDER'					=> $mchat_founder,
			'MCHAT_CLEAN_URL'				=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'clean', 'redirect' => $on_index ? 'index' : 'mchat')),
			'MCHAT_STATIC_MESS'				=> !empty($config_mchat['static_message']) ? htmlspecialchars_decode($config_mchat['static_message']) : '',
			'L_MCHAT_COPYRIGHT'				=> base64_decode('PGEgaHJlZj0iaHR0cDovL3JtY2dpcnI4My5vcmciPlJNY0dpcnI4MzwvYT4gJmNvcHk7IDxhIGhyZWY9Imh0dHA6Ly93d3cuZG16eC13ZWIubmV0IiB0aXRsZT0id3d3LmRtengtd2ViLm5ldCI+ZG16eDwvYT4='),
			'MCHAT_MESSAGE_LNGTH'			=> $config_mchat['max_message_lngth'],
			//'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> $config_mchat['max_message_lngth']) ? sprintf($this->user->lang('MCHAT_MESSAGE_LNGTH_EXPLAIN'), $config_mchat['max_message_lngth']) : '', TODO not used
			'MCHAT_MESS_LONG'				=> sprintf($this->user->lang('MCHAT_MESS_LONG'), $config_mchat['max_message_lngth']),
			'MCHAT_USER_TIMEOUT'			=> 1000 * $config_mchat['timeout'],
			'MCHAT_WHOIS_REFRESH'			=> $config_mchat['whois'] ? 1000 * $config_mchat['whois_refresh'] : 0,
			'MCHAT_PAUSE_ON_INPUT'			=> $config_mchat['pause_on_input'],
			'MCHAT_REFRESH_YES'				=> sprintf($this->user->lang('MCHAT_REFRESH_YES'), $config_mchat['refresh']),
			'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> sprintf($this->user->lang('WHO_IS_REFRESH_EXPLAIN'), $config_mchat['whois_refresh']),
			'S_MCHAT_AVATARS'				=> $mchat_avatars,
			'S_MCHAT_LOCATION'				=> $config_mchat['location'],
			'S_MCHAT_SOUND_YES'				=> $this->user->data['user_mchat_sound'],
			'U_MORE_SMILIES'				=> append_sid("{$this->phpbb_root_path}posting.{$this->phpEx}", 'mode=smilies'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'rules')),
			'S_MCHAT_ON_INDEX'				=> $this->config['mchat_on_index'] && !empty($this->user->data['user_mchat_index']),
			'EXT_URL'						=> generate_board_url() . '/ext/dmzx/mchat/',
			'STYLE_PATH'					=> generate_board_url() . '/styles/' . $this->user->style['style_path'],
		));

		if (!$on_index)
		{
			$this->template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_TITLE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller'),
			));
		}

		// Request mode
		switch ($mchat_mode)
		{
			case 'archive':
				if (!$mchat_read_archive)
				{
					// Redirect to correct page
					$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");

					// Redirect to previous page
					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang('MCHAT_NOACCESS_ARCHIVE'). '<br /><br />' . sprintf($this->user->lang('RETURN_PAGE'), '<a href="' . $mchat_redirect . '">', '</a>'));
				}

				// Prune the chats
				if ($config_mchat['prune_enable'] && $config_mchat['prune_num'] > 0)
				{
					$this->functions_mchat->mchat_prune($config_mchat['prune_num']);
				}

				break;

			case 'refresh':
				// Request new messages
				$mchat_message_last_id = $this->request->variable('message_last_id', 0);
				$sql_where = 'm.message_id > ' . (int) $mchat_message_last_id . ($this->user->data['user_mchat_topics'] ? '' : ' AND m.forum_id = 0');
				$limit = (int) $config_mchat['message_limit'];
				$rows = $this->functions_mchat->mchat_messages($sql_where, $limit);

				// Reverse the array if messages appear at the bottom
				if (!$this->config['mchat_message_top'])
				{
					$rows = array_reverse($rows);
				}

				foreach ($rows as $i => $row)
				{
					// Auth checks
					if ($row['forum_id'] != 0 && !$this->auth->acl_get('f_read', $row['forum_id']))
					{
						continue;
					}

					if ($this->user->data['user_id'] == ANONYMOUS && $this->user->data['user_id'] == $row['user_id'])
					{
						$chat_auths = $this->user->data['session_ip'] == $row['user_ip'];
					}
					else
					{
						$chat_auths = $this->user->data['user_id'] == $row['user_id'];
					}

					$mchat_ban		= $this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id'];
					$mchat_edit		= $this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $chat_auths);
					$mchat_del		= $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $chat_auths);
					$message_edit	= $row['message'];

					decode_message($message_edit, $row['bbcode_uid']);
					$message_edit = str_replace('"', '&quot;', $message_edit);
					$message_edit = mb_ereg_replace("'", "&#146;", $message_edit);

					if (in_array($row['user_id'], $foes_array))
					{
						$row['message'] = sprintf($this->user->lang('MCHAT_FOE'), get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')));
					}

					$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);

					$this->template->assign_block_vars('mchatrow', array(
						'S_ROW_COUNT'			=> $i,
						'MCHAT_ALLOW_BAN'		=> $mchat_ban,
						'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
						'MCHAT_ALLOW_DEL'		=> $mchat_del,
						'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
						'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
						'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
						'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
						'MCHAT_MESSAGE_EDIT'	=> $message_edit,
						'MCHAT_MESSAGE_ID'		=> $row['message_id'],
						'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
						'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
						'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
						'MCHAT_USER_IP'			=> $row['user_ip'],
						'MCHAT_U_IP'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'ip', 'ip' => $row['user_ip'])),
						'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
						'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
						'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
					));
				}

				return array(
					'refresh' => $this->render('mchat_messages.html'),
				);

			case 'whois':
				if (!$config_mchat['whois'])
				{
					throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
				}

				$this->assign_whois();

				return array(
					'whois' => $this->render('mchat_whois.html'),
				);

			case 'add':
				if (!$mchat_use || !check_form_key('mchat_posting', -1))
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				$message = utf8_ucfirst($this->request->variable('message', '', true));

				// Must have something other than bbcode in the message
				$message_chars = trim(preg_replace('#\[/?[^\[\]]+\]#mi', '', $message));
				if (!$message || !utf8_strlen($message_chars))
				{
					// Not Implemented
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				// Flood control
				if (!$mchat_no_flood && $config_mchat['flood_time'])
				{
					$mchat_flood_current_time = time();

					$sql = 'SELECT message_time
						FROM ' . $this->mchat_table . '
						WHERE user_id = ' . (int) $this->user->data['user_id'] . '
						ORDER BY message_time DESC';
					$result = $this->db->sql_query_limit($sql, 1);
					$message_time = (int) $this->db->sql_fetchfield('message_time');
					$this->db->sql_freeresult($result);

					if ($message_time && time() - $message_time < $config_mchat['flood_time'])
					{
						// Locked
						throw new \phpbb\exception\http_exception(400, 'MCHAT_BAD_REQUEST');
					}
				}

				// Insert user into the mChat sessions table
				$this->functions_mchat->mchat_sessions($mchat_session_time);

				// We override the $this->config['min_post_chars'] entry?
				if ($config_mchat['override_min_post_chars'])
				{
					$old_cfg['min_post_chars'] = $this->config['min_post_chars'];
					$this->config['min_post_chars'] = 0;
				}

				// We do the same for the max number of smilies?
				if ($config_mchat['override_smilie_limit'])
				{
					$old_cfg['max_post_smilies'] = $this->config['max_post_smilies'];
					$this->config['max_post_smilies'] = 0;
				}

				// Add function part code from http://wiki.phpbb.com/Parsing_text
				$uid = $bitfield = $options = '';
				generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_allow_bbcode, $mchat_urls, $mchat_smilies);

				// Not allowed bbcodes
				if (!$mchat_allow_bbcode)
				{
					$bbcode_remove = '#\[/?[^\[\]]+\]#Usi';
					$message = preg_replace($bbcode_remove, '', $message);
				}

				// Disallowed bbcodes
				if ($config_mchat['bbcode_disallowed'])
				{
					$bbcode_replace = array(
						'#\[(' . $config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
						'#\[/(' . $config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
					);
					$message = preg_replace($bbcode_replace, '', $message);
				}

				/**
				* Event render_helper_add
				*
				* @event dmzx.mchat.core.render_helper_add
				* @since 0.1.2
				*/
				$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_add');

				$sql_ary = array(
					'forum_id'			=> 0,
					'post_id'			=> 0,
					'user_id'			=> $this->user->data['user_id'],
					'user_ip'			=> $this->user->data['session_ip'],
					'message'			=> str_replace('\'', '&#39;', $message),
					'bbcode_bitfield'	=> $bitfield,
					'bbcode_uid'		=> $uid,
					'bbcode_options'	=> $options,
					'message_time'		=> time(),
				);

				$sql = 'INSERT INTO ' . $this->mchat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->db->sql_query($sql);

				// Reset the config settings
				if (isset($old_cfg['min_post_chars']))
				{
					$this->config['min_post_chars'] = $old_cfg['min_post_chars'];
					unset($old_cfg['min_post_chars']);
				}

				if (isset($old_cfg['max_post_smilies']))
				{
					$this->config['max_post_smilies'] = $old_cfg['max_post_smilies'];
					unset($old_cfg['max_post_smilies']);
				}

				return array(
					'add' => true,
				);

			case 'edit':
				$message_id = $this->request->variable('message_id', 0);

				if (!$message_id)
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// Check for the correct user
				if ($this->auth->acl_get('m_'))
				{
					// Always allow users with 'm_' auth to edit and delete
					$user_id = $this->user->data['user_id'];
				}
				else
				{
					$sql = 'SELECT user_id
						FROM ' . $this->mchat_table . '
						WHERE message_id = ' . (int) $message_id;
					$result = $this->db->sql_query($sql);
					$user_id = (int) $this->db->sql_fetchfield('user_id');
					$this->db->sql_freeresult($result);
				}

				// Edit and delete auths
				$mchat_ban	= $this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $user_id;
				$mchat_edit	= $this->auth->acl_get('u_mchat_edit') && $this->user->data['user_id'] == $user_id;
				$mchat_del	= $this->auth->acl_get('u_mchat_delete') && $this->user->data['user_id'] == $user_id;

				if (!$mchat_edit)
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				$message = $this->request->variable('message', '', true);

				// Must have something other than bbcode in the message
				$message_chars = trim(preg_replace('#\[/?[^\[\]]+\]#mi', '', $message));
				if (!$message || !utf8_strlen($message_chars))
				{
					// Not Implemented (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				// Message limit
				$message = $config_mchat['max_message_lngth'] && utf8_strlen($message) >= $config_mchat['max_message_lngth'] + 3 ? utf8_substr($message, 0, $config_mchat['max_message_lngth']) . '...' : $message;

				// We override the $this->config['min_post_chars'] entry?
				if ($config_mchat['override_min_post_chars'])
				{
					$old_cfg['min_post_chars'] = $this->config['min_post_chars'];
					$this->config['min_post_chars'] = 0;
				}

				// We do the same for the max number of smilies?
				if ($config_mchat['override_smilie_limit'])
				{
					$old_cfg['max_post_smilies'] = $this->config['max_post_smilies'];
					$this->config['max_post_smilies'] = 0;
				}

				// Edit function part code from http://wiki.phpbb.com/Parsing_text
				$uid = $bitfield = $options = '';
				generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_allow_bbcode, $mchat_urls, $mchat_smilies);

				// Not allowed bbcodes
				if (!$mchat_allow_bbcode)
				{
					$bbcode_remove = '#\[/?[^\[\]]+\]#Usi';
					$message = preg_replace($bbcode_remove, '', $message);
				}

				// Disallowed bbcodes
				if ($config_mchat['bbcode_disallowed'])
				{
					$bbcode_replace = array(
						'#\[(' . $config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
						'#\[/(' . $config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
					);
					$message = preg_replace($bbcode_replace, '', $message);
				}

				$sql_ary = array(
					'message'			=> str_replace('\'', '&#39;', $message),
					'bbcode_bitfield'	=> $bitfield,
					'bbcode_uid'		=> $uid,
					'bbcode_options'	=> $options,
				);

				$sql = 'UPDATE ' . $this->mchat_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				// Message edited...now read it
				$sql_where = 'm.message_id = ' . (int) $message_id;
				$rows = $this->functions_mchat->mchat_messages($sql_where, 1);
				$row = $rows[0];

				$message_edit = $row['message'];

				decode_message($message_edit, $row['bbcode_uid']);
				$message_edit	= str_replace('"', '&quot;', $message_edit);
				$message_edit	= mb_ereg_replace("'", "&#146;", $message_edit);

				$this->template->assign_block_vars('mchatrow', array(
					'S_ROW_COUNT'			=> 0,
					'MCHAT_ALLOW_BAN'		=> $mchat_ban,
					'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
					'MCHAT_ALLOW_DEL'		=> $mchat_del,
					'MCHAT_MESSAGE_EDIT'	=> $message_edit,
					'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
					'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
					'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
					'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
					'MCHAT_MESSAGE_ID'		=> $row['message_id'],
					'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
					'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
					'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
					'MCHAT_USER_IP'			=> $row['user_ip'],
					'MCHAT_U_IP'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'ip', 'ip' => $row['user_ip'])),
					'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
					'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
					'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
				));

				// Reset the config settings
				if (isset($old_cfg['min_post_chars']))
				{
					$this->config['min_post_chars'] = $old_cfg['min_post_chars'];
					unset($old_cfg['min_post_chars']);
				}

				if (isset($old_cfg['max_post_smilies']))
				{
					$this->config['max_post_smilies'] = $old_cfg['max_post_smilies'];
					unset($old_cfg['max_post_smilies']);
				}

				// Add a log
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EDITED_MCHAT', false, array($row['username']));

				$this->functions_mchat->mchat_sessions($mchat_session_time);

				/**
				* Event render_helper_edit
				*
				* @event dmzx.mchat.core.render_helper_edit
				* @since 0.1.4
				*/
				$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_edit');

				return array(
					'edit' => $this->render('mchat_messages.html'),
				);

			case 'del':
				$message_id = $this->request->variable('message_id', 0);

				if (!$message_id)
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// Check for the correct user
				$sql = 'SELECT u.user_id, u.username
					FROM ' . $this->mchat_table . ' m
					LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
					WHERE m.message_id = ' . (int) $message_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				// Delete auths
				$mchat_del = $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']);

				if (!$mchat_del)
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				/**
				* Event render_helper_delete
				*
				* @event dmzx.mchat.core.render_helper_delete
				* @since 0.1.4
				*/
				$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_delete');

				// Run delete
				$sql = 'DELETE FROM ' . $this->mchat_table . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				// Add a log
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_DELETED_MCHAT', false, array($row['username']));

				$this->functions_mchat->mchat_sessions($mchat_session_time);

				return array(
					'del' => true,
				);
		}

		// If not include in index.php set mchat.php page true
		if (!$on_index)
		{
			if (!$in_archive)
			{
				// If custom page false mchat.php page redirect to index...
				if (!$config_mchat['custom_page'])
				{
					$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");
					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang('MCHAT_NO_CUSTOM_PAGE'). '<br /><br />' . sprintf($this->user->lang('RETURN_PAGE'), '<a href="' . $mchat_redirect . '">', '</a>'));
				}

				$this->functions_mchat->mchat_sessions($mchat_session_time);
			}

			if ($config_mchat['whois'])
			{
				$legend = $this->functions_mchat->mchat_legend();
				$this->template->assign_var('LEGEND', implode(', ', $legend));
			}
		}

		$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'm.forum_id = 0';
		$limit = $in_archive ? $config_mchat['archive_limit'] : $config_mchat[$on_index ? 'message_num' : 'message_limit'];
		$start = $in_archive ? $this->request->variable('start', 0) : 0;
		$rows = $this->functions_mchat->mchat_messages($sql_where, $limit, $start);

		// Reverse the array if messages appear at the bottom
		if (!$this->config['mchat_message_top'] && !$in_archive)
		{
			$rows = array_reverse($rows, true);
		}

		foreach ($rows as $i => $row)
		{
			// Auth checks
			if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			if ($this->user->data['user_id'] == ANONYMOUS && $this->user->data['user_id'] == $row['user_id'])
			{
				$chat_auths = $this->user->data['session_ip'] == $row['user_ip'];
			}
			else
			{
				$chat_auths = $this->user->data['user_id'] == $row['user_id'];
			}

			$mchat_ban		= $this->auth->acl_get('a_authusers');
			$mchat_edit		= $this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $chat_auths);
			$mchat_del		= $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $chat_auths);
			$message_edit	= $row['message'];

			decode_message($message_edit, $row['bbcode_uid']);
			$message_edit = str_replace('"', '&quot;', $message_edit);
			$message_edit = mb_ereg_replace("'", "&#146;", $message_edit);

			if (in_array($row['user_id'], $foes_array))
			{
				$row['message'] = sprintf($this->user->lang('MCHAT_FOE'), get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')));
			}

			$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
			$message = str_replace('\'', '&rsquo;', $row['message']);

			$this->template->assign_block_vars('mchatrow', array(
				'S_ROW_COUNT'			=> $i,
				'MCHAT_ALLOW_BAN'		=> $mchat_ban,
				'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
				'MCHAT_ALLOW_DEL'		=> $mchat_del,
				'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
				'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
				'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
				'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
				'MCHAT_MESSAGE_EDIT'	=> $message_edit,
				'MCHAT_MESSAGE_ID'		=> $row['message_id'],
				'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USER_IP'			=> $row['user_ip'],
				'MCHAT_U_IP'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'ip', 'ip' => $row['user_ip'])),
				'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
				'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($message, $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
				'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
			));
		}

		if ($in_archive)
		{
			// Run query again to get the total number of message for pagination
			$sql = 'SELECT COUNT(message_id) AS mess_id
				FROM ' . $this->mchat_table;
			$result = $this->db->sql_query($sql);
			$mchat_total_message = (int) $this->db->sql_fetchfield('mess_id');
			$this->db->sql_freeresult($result);

			$pagination_url = $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive'));
			$this->pagination->generate_template_pagination($pagination_url, 'pagination', 'start', $mchat_total_message, $limit, $start);

			$this->template->assign_var('MCHAT_TOTAL_MESSAGES', sprintf($this->user->lang('MCHAT_TOTALMESSAGES'), $mchat_total_message));

			// Add to navlinks
			$this->template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_ARCHIVE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive')),
			));
		}
		else
		{
			$this->assign_whois();

			// Display custom bbcodes
			if ($mchat_allow_bbcode)
			{
				if (!function_exists('display_custom_bbcodes'))
				{
					include($this->phpbb_root_path . 'includes/functions_display.' . $this->phpEx);
				}
				$this->functions_mchat->display_mchat_bbcodes();
			}

			// Smile row
			if ($mchat_smilies)
			{
				if (!function_exists('generate_smilies'))
				{
					include($this->phpbb_root_path . 'includes/functions_posting.' . $this->phpEx);
				}
				generate_smilies('inline', 0);
			}

			add_form_key('mchat_posting');
		}

		/**
		* Event render_helper_aft
		*
		* @event dmzx.mchat.core.render_helper_aft
		* @since 0.1.2
		*/
		$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_aft');

		// If we're on the index, we must not render anything
		// here, only for the custom page and the archive
		if (!$on_index)
		{
			return $this->helper->render('mchat_body.html', $this->user->lang($in_archive ? 'MCHAT_ARCHIVE_PAGE' : 'MCHAT_TITLE'));
		}
	}

	/**
	* Renders the statistics for whois and at the bottom of the index page
	*/
	public function assign_whois()
	{
		if ($this->config['mchat_enable'] && $this->auth->acl_get('u_mchat_view') && !$this->is_mchat_rendered)
		{
			$this->is_mchat_rendered = true;
			$config_mchat = $this->functions_mchat->mchat_cache();
			$mchat_session_time = !empty($config_mchat['timeout']) ? $config_mchat['timeout'] : (!empty($this->config['load_online_time']) ? $this->config['load_online_time'] * 60 : $this->config['session_length']);
			$mchat_stats = $this->functions_mchat->mchat_users($mchat_session_time);
			$this->template->assign_vars(array(
				'MCHAT_INDEX_STATS'		=> $this->config['mchat_stats_index'] && $this->user->data['user_mchat_stats_index'],
				'MCHAT_USERS_COUNT'		=> $mchat_stats['mchat_users_count'],
				'MCHAT_USERS_LIST'		=> !empty($mchat_stats['online_userlist']) ? $mchat_stats['online_userlist'] : '',
				'MCHAT_ONLINE_EXPLAIN'	=> $mchat_stats['refresh_message'],
			));
		}
	}

	/**
	* Renders a template file and returns it
	* @return string
	*/
	protected function render($template_file)
	{
		$this->template->set_filenames(array('body' => $template_file));
		$content = $this->template->assign_display('body', '', true);

		return trim(str_replace(array("\r", "\n"), '', $content));
	}
}
