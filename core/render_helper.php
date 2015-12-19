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

	public $initialized = false;

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
	* @param \phpbb\request\request				$request
	* @param \phpbb\event\dispatcher_interface 	$dispatcher
	* @param string								$phpbb_root_path
	* @param string								$phpEx
	* @param string								$mchat_table
	*/
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\event\dispatcher_interface $dispatcher, $phpbb_root_path, $phpEx, $mchat_table)
	{
		$this->functions_mchat 	= $functions_mchat;
		$this->config 			= $config;
		$this->helper 			= $helper;
		$this->template 		= $template;
		$this->phpbb_log 		= $log;
		$this->user 			= $user;
		$this->auth 			= $auth;
		$this->db 				= $db;
		$this->pagination 		= $pagination;
		$this->request 			= $request;
		$this->dispatcher 		= $dispatcher;
		$this->phpbb_root_path 	= $phpbb_root_path;
		$this->phpEx 			= $phpEx;
		$this->mchat_table 		= $mchat_table;
	}

	/**
	* Method to render the page data
	*
	* @var bool		Bool if the rendering is only for index
	* @return array	Data for page rendering
	*/
	public function render_data_for_page($include_on_index)
	{
		// Add lang file
		$this->user->add_lang('posting');

		$this->initialized = true;

		if (!$this->config['mchat_enable'])
		{
			$this->template->assign_vars(array(
				'S_MCHAT_DISABLED' => true,
			));
		}

		// Avatars & BBCodes
		if (!function_exists('display_custom_bbcodes'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->phpEx);
		}

		$config_mchat = $this->functions_mchat->mchat_cache();

		// Access rights
		$mchat_allow_bbcode		= $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_smilies			= $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies');
		$mchat_urls				= $this->config['allow_post_links'] && $this->auth->acl_get('u_mchat_urls');
		$mchat_ip				= $this->auth->acl_get('u_mchat_ip');
		$mchat_pm				= $this->auth->acl_get('u_mchat_pm');
		$mchat_like				= $this->auth->acl_get('u_mchat_like');
		$mchat_quote			= $this->auth->acl_get('u_mchat_quote');
		$mchat_add_mess			= $this->auth->acl_get('u_mchat_use');
		$mchat_view				= $this->auth->acl_get('u_mchat_view');
		$mchat_no_flood			= $this->auth->acl_get('u_mchat_flood_ignore');
		$mchat_read_archive		= $this->auth->acl_get('u_mchat_archive');
		$mchat_founder			= $this->user->data['user_type'] == USER_FOUNDER;
		$mchat_session_time		= !empty($config_mchat['timeout']) ? $config_mchat['timeout'] : (!empty($this->config['load_online_time']) ? $this->config['load_online_time'] * 60 : $this->config['session_length']);
		$mchat_rules			= !empty($config_mchat['rules']) || isset($this->user->lang[strtoupper('mchat_rules')]);
		$mchat_avatars			= !empty($config_mchat['avatars']) && $this->user->optionget('viewavatars') && $this->user->data['user_mchat_avatars'];

		// Request variables
		$mchat_mode	= $this->request->variable('mode', '');
		$mchat_read_mode = $mchat_archive_mode = $mchat_custom_page = $mchat_no_message = false;

		// Grab fools..uhmmm, foes the user has
		$sql = 'SELECT *
			FROM ' . ZEBRA_TABLE . '
			WHERE user_id = ' . $this->user->data['user_id'] . '
			AND foe = 1';
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$foes_array = array();
		foreach ($rows as $row)
		{
			$foes_array[] = $row['zebra_id'];
		}

		// Request mode
		switch ($mchat_mode)
		{
			case 'rules':
				// If the rules are defined in the language file use them, else just use the entry in the database
				if ($mchat_rules || isset($this->user->lang[strtoupper('mchat_rules')]))
				{
					if (isset($this->user->lang[strtoupper('mchat_rules')]))
					{
						$this->template->assign_var('MCHAT_RULES', $this->user->lang[strtoupper('mchat_rules')]);
					}
					else
					{
						$mchat_rules = explode("\n", $config_mchat['rules']);
						foreach ($mchat_rules as $mchat_rule)
						{
							$mchat_rule = utf8_htmlspecialchars($mchat_rule);
							$this->template->assign_block_vars('rule', array(
								'MCHAT_RULE' => $mchat_rule,
							));
						}
					}

					// Return for $this->helper->render(filename, lang_title);
					return array(
						'filename'		=> 'mchat_rules.html',
						'lang_title'	=> $this->user->lang['MCHAT_HELP'],
					);
				}

				// Show no rules
				trigger_error('MCHAT_NO_RULES', E_USER_NOTICE);

				break;

			case 'whois':
				if ($mchat_mode === 'whois' && $mchat_ip)
				{
					if (!function_exists('user_ipwhois'))
					{
						include($this->phpbb_root_path . 'includes/functions_user.' . $this->phpEx);
					}

					$user_ip = $this->request->variable('ip', '');
					$this->template->assign_var('WHOIS', user_ipwhois($user_ip));

					// Output the page
					// Return for $this->helper->render(filename, lang_title);
					return array(
						'filename'		=> 'viewonline_whois.html',
						'lang_title'	=> $this->user->lang['WHO_IS_ONLINE'],
					);
				}

				// Show not authorized
				trigger_error('NO_AUTH_OPERATION', E_USER_NOTICE);

				break;

			case 'clean':
				if (!$this->user->data['is_registered'])
				{
					// Login box
					login_box('', $this->user->lang['LOGIN']);
				}

				if (!$mchat_founder)
				{
					// Show not authorized
					trigger_error('NO_AUTH_OPERATION', E_USER_NOTICE);
				}

				$mchat_redirect = $this->request->variable('redirect', '');
				$mchat_redirect = ($mchat_redirect == 'index') ? append_sid("{$this->phpbb_root_path}index.{$this->phpEx}") : $this->helper->route('dmzx_mchat_controller', array('#mChat'));

				if (confirm_box(true))
				{
					// Run cleaner
					$sql = 'TRUNCATE TABLE ' . $this->mchat_table;
					$this->db->sql_query($sql);

					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang['MCHAT_CLEANED']. '<br /><br />' . sprintf($this->user->lang['RETURN_PAGE'], '<a href="' . $mchat_redirect . '">', '</a>'));
				}
				else
				{
					// Display confirm box
					confirm_box(false, $this->user->lang['MCHAT_DELALLMESS']);
				}

				$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED');
				redirect($mchat_redirect);

				break;

			case 'archive':
				if (!$mchat_read_archive || !$mchat_view)
				{
					// Redirect to correct page
					$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");

					// Redirect to previous page
					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang['MCHAT_NOACCESS_ARCHIVE']. '<br /><br />' . sprintf($this->user->lang['RETURN_PAGE'], '<a href="' . $mchat_redirect . '">', '</a>'));
				}

				if ($this->config['mchat_enable'] && $mchat_read_archive && $mchat_view)
				{
					// Prune the chats
					if ($config_mchat['prune_enable'] && $config_mchat['prune_num'] > 0)
					{
						$this->functions_mchat->mchat_prune($config_mchat['prune_num']);
					}

					$mchat_archive_start = $this->request->variable('start', 0);
					$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'WHERE m.forum_id = 0';

					// Fetch message rows
					$sql = 'SELECT m.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm
						FROM ' . $this->mchat_table . ' m
						LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
						' . $sql_where . '
						ORDER BY m.message_id DESC';
					$result = $this->db->sql_query_limit($sql, (int) $config_mchat['archive_limit'], $mchat_archive_start);
					$rows = $this->db->sql_fetchrowset($result);
					$this->db->sql_freeresult($result);

					foreach ($rows as $row)
					{
						if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
						{
							continue;
						}

						// Edit, delete and permission auths
						$mchat_ban		= $this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id'];
						$mchat_edit		= $this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']);
						$mchat_del		= $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']);
						$message_edit	= $row['message'];

						decode_message($message_edit, $row['bbcode_uid']);
						$message_edit = str_replace('"', '&quot;', $message_edit);

						if (!empty($foes_array) && in_array($row['user_id'], $foes_array))
						{
							$row['message'] = sprintf($this->user->lang['MCHAT_FOE'], get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']));
						}

						$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);

						$this->template->assign_block_vars('mchatrow', array(
							'MCHAT_ALLOW_BAN'		=> $mchat_ban,
							'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
							'MCHAT_ALLOW_DEL'		=> $mchat_del,
							'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
							'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
							'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
							'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
							'MCHAT_MESSAGE_EDIT'	=> $message_edit,
							'MCHAT_MESSAGE_ID'		=> $row['message_id'],
							'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USER_IP'			=> $row['user_ip'],
							'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
							'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
							'MCHAT_MESSAGE'			=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
							'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
							'MCHAT_CLASS'			=> $row['message_id'] % 2 ? 1 : 2,
						));
					}

					// Write no message
					if (empty($rows))
					{
						$mchat_no_message = true;
					}
				}

				// Run query again to get the total message rows
				$sql = 'SELECT COUNT(message_id) AS mess_id
					FROM ' . $this->mchat_table;
				$result = $this->db->sql_query($sql);
				$mchat_total_message = (int) $this->db->sql_fetchfield('mess_id');
				$this->db->sql_freeresult($result);

				// Page list function
				$pagination_url = $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive'));
				$start = $this->request->variable('start', 0);
				$this->pagination->generate_template_pagination($pagination_url, 'pagination', 'start', $mchat_total_message, (int) $config_mchat['archive_limit'], $mchat_archive_start);

				$this->template->assign_vars(array(
					'MCHAT_TOTAL_MESSAGES' => sprintf($this->user->lang['MCHAT_TOTALMESSAGES'], $mchat_total_message),
				));

				// Add to navlinks
				$this->template->assign_block_vars('navlinks', array(
					'FORUM_NAME'	=> $this->user->lang['MCHAT_ARCHIVE_PAGE'],
					'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive')),
				));

				$mchat_archive_mode = true;

				break;

			case 'read':
				if (!$this->config['mchat_enable'] || !$mchat_view)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// If we're reading on the custom page, then we are chatting
				if ($mchat_custom_page)
				{
					$this->functions_mchat->mchat_sessions($mchat_session_time, true);
				}

				// Request
				$mchat_message_last_id = $this->request->variable('message_last_id', 0);
				$sql_and = $this->user->data['user_mchat_topics'] ? '' : 'AND m.forum_id = 0';
				$sql = 'SELECT m.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm
					FROM ' . $this->mchat_table . ' m, ' . USERS_TABLE . ' u
					WHERE m.user_id = u.user_id
					AND m.message_id > ' . (int) $mchat_message_last_id . '
					' . $sql_and . '
					ORDER BY m.message_id DESC';
				$result = $this->db->sql_query_limit($sql, (int) $config_mchat['message_limit']);
				$rows = $this->db->sql_fetchrowset($result);
				$this->db->sql_freeresult($result);

				// Reverse the array if messages appear at the bottom
				if (!$this->config['mchat_message_top'])
				{
					$rows = array_reverse($rows);
				}

				foreach ($rows as $row)
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

					if (!empty($foes_array) && in_array($row['user_id'], $foes_array))
					{
						$row['message'] = sprintf($this->user->lang['MCHAT_FOE'], get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']));
					}

					$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);

					$this->template->assign_block_vars('mchatrow', array(
						'MCHAT_ALLOW_BAN'		=> $mchat_ban,
						'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
						'MCHAT_ALLOW_DEL'		=> $mchat_del,
						'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
						'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
						'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
						'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
						'MCHAT_MESSAGE_EDIT'	=> $message_edit,
						'MCHAT_MESSAGE_ID' 		=> $row['message_id'],
						'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
						'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
						'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
						'MCHAT_USER_IP'			=> $row['user_ip'],
						'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
						'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
						'MCHAT_MESSAGE'			=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
						'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
						'MCHAT_CLASS'			=> $row['message_id'] % 2 ? 1 : 2
					));
				}

				// Write no message
				if (empty($rows))
				{
					$mchat_no_message = true;
				}

				$mchat_read_mode = true;

				break;

			case 'stats':
				if (!$this->config['mchat_enable'] || !$mchat_view || !$config_mchat['whois'])
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				$mchat_stats = $this->functions_mchat->mchat_users($mchat_session_time, false);

				if (!empty($mchat_stats['online_userlist']))
				{
					$message = '<div class="mChatStats" id="mChatStats"><a href="#" onclick="mChat.toggle(\'UserList\'); return false;">' . $mchat_stats['mchat_users_count'] . '</a>&nbsp;' . $mchat_stats['refresh_message'] . '<br /><span id="mChatUserList" style="display: none; float: left;">' . $mchat_stats['online_userlist'] . '</span></div>';
				}
				else
				{
					$message = '<div class="mChatStats" id="mChatStats">' . $this->user->lang['MCHAT_NO_CHATTERS'] . '&nbsp;(' . $mchat_stats['refresh_message'] . ')</div>';
				}

				if ($this->request->is_ajax())
				{
					// Return for \Symfony\Component\HttpFoundation\JsonResponse
					return array(
						'json'			=> true,
						'message'		=> $message,
					);
				}

				throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');

				break;

			case 'add':
				if (!$this->config['mchat_enable'] || !$mchat_add_mess || !check_form_key('mchat_posting', -1))
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				$message = utf8_ucfirst($this->request->variable('message', '', true));

				// Must have something other than bbcode in the message
				$message_chars = trim(preg_replace('#\[/?[^\[\]]+\]#mi', '', $message));
				if (!$message || !utf8_strlen($message_chars))
				{
					// Not Implemented (for jQ AJAX request)
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
						// Locked (for jQ AJAX request)
						throw new \phpbb\exception\http_exception(400, 'MCHAT_BAD_REQUEST');
					}
				}

				// Insert user into the mChat sessions table
				$this->functions_mchat->mchat_sessions($mchat_session_time, true);

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

				$sql_ary = array(
					'forum_id' 			=> 0,
					'post_id'			=> 0,
					'user_id'			=> $this->user->data['user_id'],
					'user_ip'			=> $this->user->data['session_ip'],
					'message' 			=> str_replace('\'', '&rsquo;', $message),
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

				if ($this->request->is_ajax())
				{
					// Return for \Symfony\Component\HttpFoundation\JsonResponse
					return array(
						'json'			=> true,
						'success'		=> true,
					);
				}

				exit_handler();

				break;

			case 'edit':
				$message_id = $this->request->variable('message_id', 0);

				if (!$this->config['mchat_enable'] || !$message_id)
				{
					// Forbidden (for jQ AJAX request)
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
				$mchat_edit = $this->auth->acl_get('u_mchat_edit') && $this->user->data['user_id'] == $user_id;
				$mchat_del = $this->auth->acl_get('u_mchat_delete') && $this->user->data['user_id'] == $user_id;

				// If mChat disabled and not edit
				if (!$mchat_edit)
				{
					// Forbidden (for jQ AJAX request)
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
					'message'			=> str_replace('\'', '&rsquo;', $message),
					'bbcode_bitfield'	=> $bitfield,
					'bbcode_uid'		=> $uid,
					'bbcode_options'	=> $options,
				);

				$sql = 'UPDATE ' . $this->mchat_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				// Message edited...now read it
				$sql = 'SELECT m.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm
					FROM ' . $this->mchat_table . ' m, ' . USERS_TABLE . ' u
					WHERE m.user_id = u.user_id
						AND m.message_id = ' . (int) $message_id . '
					ORDER BY m.message_id DESC';
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				$message_edit = $row['message'];

				decode_message($message_edit, $row['bbcode_uid']);
				$message_edit	= str_replace('"', '&quot;', $message_edit);
				$message_edit	= mb_ereg_replace("'", "&#146;", $message_edit);
				$mchat_ban		= $this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id'];

				$this->template->assign_block_vars('mchatrow', array(
					'MCHAT_ALLOW_BAN'		=> $mchat_ban,
					'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
					'MCHAT_ALLOW_DEL'		=> $mchat_del,
					'MCHAT_MESSAGE_EDIT'	=> $message_edit,
					'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
					'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
					'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
					'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
					'MCHAT_MESSAGE_ID'		=> $row['message_id'],
					'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
					'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
					'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
					'MCHAT_USER_IP'			=> $row['user_ip'],
					'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
					'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
					'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
					'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
					'MCHAT_CLASS'			=> $row['message_id'] % 2 ? 1 : 2
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
				$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EDITED_MCHAT', false, array($row['username']));

				$this->functions_mchat->mchat_sessions($mchat_session_time, true);
				$mchat_read_mode = true;

				break;

			case 'delete':
				$message_id = $this->request->variable('message_id', 0);

				if (!$this->config['mchat_enable'] || !$message_id)
				{
					// Forbidden (for jQ AJAX request)
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

				// Edit and delete auths
				$mchat_edit = $this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']);
				$mchat_del = $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']);

				if (!$mchat_del)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// Run delete
				$sql = 'DELETE FROM ' . $this->mchat_table . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				// Add a log
				$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_DELETED_MCHAT', false, array($row['username']));

				$this->functions_mchat->mchat_sessions($mchat_session_time, true);

				if ($this->request->is_ajax())
				{
					// Return for \Symfony\Component\HttpFoundation\JsonResponse
					return array(
						'json'			=> true,
						'success'		=> true,
					);
				}

				exit_handler();

				break;

			default:

				// If not include in index.php set mchat.php page true
				if (!$include_on_index)
				{
					$mchat_custom_page = true;

					// If custom page false mchat.php page redirect to index...
					if (!$config_mchat['custom_page'])
					{
						$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");
						meta_refresh(3, $mchat_redirect);
						trigger_error($this->user->lang['MCHAT_NO_CUSTOM_PAGE']. '<br /><br />' . sprintf($this->user->lang['RETURN_PAGE'], '<a href="' . $mchat_redirect . '">', '</a>'));
					}

					// User has permissions to view the custom chat?
					if (!$mchat_view)
					{
						trigger_error('NOT_AUTHORISED', E_USER_NOTICE);
					}

					if ($config_mchat['whois'])
					{
						// Grab group details for legend display for who is online on the custom page
						$order_legend = $this->config['legend_sort_groupname'] ? 'group_name' : 'group_legend';
						if ($this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
						{
							$sql = 'SELECT group_id, group_name, group_colour, group_type
								FROM ' . GROUPS_TABLE . '
								WHERE group_legend <> 0
								ORDER BY ' . $order_legend . ' ASC';
						}
						else
						{
							$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type
								FROM ' . GROUPS_TABLE . ' g
								LEFT JOIN ' . USER_GROUP_TABLE . ' ug ON (g.group_id = ug.group_id AND ug.user_id = ' . $this->user->data['user_id'] . ' AND ug.user_pending = 0)
								WHERE g.group_legend <> 0
									AND (g.group_type <> ' . GROUP_HIDDEN . '
									OR ug.user_id = ' . (int) $this->user->data['user_id'] . ')
								ORDER BY g.' . $order_legend . ' ASC';
						}
						$result = $this->db->sql_query($sql);
						$rows = $this->db->sql_fetchrowset($result);
						$this->db->sql_freeresult($result);

						$legend = array();
						foreach ($rows as $row)
						{
							$colour_text = $row['group_colour'] ? ' style="color:#' . $row['group_colour'] . '"' : '';
							$group_name = $row['group_type'] == GROUP_SPECIAL ? $this->user->lang['G_' . $row['group_name']] : $row['group_name'];
							if ($row['group_name'] == 'BOTS' || $this->user->data['user_id'] != ANONYMOUS && !$this->auth->acl_get('u_viewprofile'))
							{
								$legend[] = '<span' . $colour_text . '>' . $group_name . '</span>';
							}
							else
							{
								$legend[] = '<a' . $colour_text . ' href="' . append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=group&amp;g='.$row['group_id']) . '">' . $group_name . '</a>';
							}
						}

						$this->template->assign_vars(array(
							'LEGEND'	=> implode(', ', $legend),
						));
					}

					$this->template->assign_block_vars('navlinks', array(
						'FORUM_NAME'	=> $this->user->lang['MCHAT_TITLE'],
						'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller'),
					));
				}

				if ($mchat_view)
				{
					$message_number = $config_mchat[$mchat_custom_page ? 'message_limit' : 'message_num'];
					$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'WHERE m.forum_id = 0';

					// Message row
					$sql = 'SELECT m.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm
						FROM ' . $this->mchat_table . ' m
						LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
						' . $sql_where . '
						ORDER BY message_id DESC';
					$result = $this->db->sql_query_limit($sql, $message_number);
					$rows = $this->db->sql_fetchrowset($result);
					$this->db->sql_freeresult($result);

					// Reverse the array if messages appear at the bottom
					if (!$this->config['mchat_message_top'])
					{
						$rows = array_reverse($rows, true);
					}

					foreach ($rows as $row)
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

						$mchat_ban		= $this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id'];
						$mchat_edit		= $this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $chat_auths);
						$mchat_del		= $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $chat_auths);
						$message_edit	= $row['message'];

						decode_message($message_edit, $row['bbcode_uid']);
						$message_edit = str_replace('"', '&quot;', $message_edit);
						$message_edit = mb_ereg_replace("'", "&#146;", $message_edit);

						if (!empty($foes_array) && in_array($row['user_id'], $foes_array))
						{
							$row['message'] = sprintf($this->user->lang['MCHAT_FOE'], get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']));
						}

						$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
						$message = str_replace('\'', '&rsquo;', $row['message']);

						$this->template->assign_block_vars('mchatrow', array(
							'MCHAT_ALLOW_BAN'		=> $mchat_ban,
							'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
							'MCHAT_ALLOW_DEL'		=> $mchat_del,
							'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
							'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
							'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
							'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
							'MCHAT_MESSAGE_EDIT'	=> $message_edit,
							'MCHAT_MESSAGE_ID'		=> $row['message_id'],
							'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USER_IP'			=> $row['user_ip'],
							'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
							'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
							'MCHAT_MESSAGE'			=> generate_text_for_display($message, $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
							'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $config_mchat['date']),
							'MCHAT_CLASS'			=> $row['message_id'] % 2 ? 1 : 2,
						));
					}

					// Write no message
					if (empty($rows))
					{
						$mchat_no_message = true;
					}

					// Display custom bbcodes
					if ($mchat_allow_bbcode && $this->config['allow_bbcode'])
					{
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

					// If the static message is defined in the language file use it, else just use the entry in the database
					if (isset($this->user->lang[strtoupper('static_message')]) || !empty($config_mchat['static_message']))
					{
						$config_mchat['static_message'] = $config_mchat['static_message'];
						if (isset($this->user->lang[strtoupper('static_message')]))
						{
							$config_mchat['static_message'] = $this->user->lang[strtoupper('static_message')];
						}
					}

					// If the static message is defined in the language file use it, else just use the entry in the database
					if (isset($this->user->lang[strtoupper('mchat_rules')]) || !empty($config_mchat['rules']))
					{
						if (isset($this->user->lang[strtoupper('mchat_rules')]))
						{
							$config_mchat['rules'] = $this->user->lang[strtoupper('mchat_rules')];
						}
					}

					// A list of users using the chat
					$mchat_users = $this->functions_mchat->mchat_users($mchat_session_time, $mchat_custom_page);
					$this->template->assign_vars(array(
						'MCHAT_USERS_COUNT'		=> $mchat_users['mchat_users_count'],
						'MCHAT_USERS_LIST'		=> $mchat_users['online_userlist'],
					));
				}

				break;
		}

		/**
		* Event render_helper_aft
		*
		* @event dmzx.mchat.core.render_helper_aft
		* @since 0.1.2
		*/
		$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_aft');

		// Show index stats
		if (!empty($this->config['mchat_stats_index']) && !empty($this->user->data['user_mchat_stats_index']))
		{
			$mchat_session_time = !empty($config_mchat['timeout']) ? $config_mchat['timeout'] : $this->config['session_length'];
			$mchat_stats = $this->functions_mchat->mchat_users($mchat_session_time, false);
			$this->template->assign_vars(array(
				'MCHAT_INDEX_STATS'			=> true,
				'MCHAT_INDEX_USERS_COUNT'	=> $mchat_stats['mchat_users_count'],
				'MCHAT_INDEX_USERS_LIST'	=> !empty($mchat_stats['online_userlist']) ? $mchat_stats['online_userlist'] : '',
				'L_MCHAT_ONLINE_EXPLAIN'	=> $mchat_stats['refresh_message'],
			));
		}

		$copyright = base64_decode('PGEgaHJlZj0iaHR0cDovL3JtY2dpcnI4My5vcmciPlJNY0dpcnI4MzwvYT4gJmNvcHk7IDxhIGhyZWY9Imh0dHA6Ly93d3cuZG16eC13ZWIubmV0IiB0aXRsZT0id3d3LmRtengtd2ViLm5ldCI+ZG16eDwvYT4=');
		add_form_key('mchat_posting');

		// Template function...
		$this->template->assign_vars(array(
			'MCHAT_FILE_NAME'				=> $this->helper->route('dmzx_mchat_controller'),
			'MCHAT_REFRESH_JS'				=> 1000 * $config_mchat['refresh'],
			'MCHAT_ADD_MESSAGE'				=> $mchat_add_mess,
			'MCHAT_READ_MODE'				=> $mchat_read_mode,
			'MCHAT_ARCHIVE_MODE'			=> $mchat_archive_mode,
			'MCHAT_INPUT_TYPE'				=> $this->user->data['user_mchat_input_area'],
			'MCHAT_RULES'					=> $mchat_rules,
			'MCHAT_ALLOW_SMILES'			=> $mchat_smilies,
			'MCHAT_ALLOW_IP'				=> $mchat_ip,
			'MCHAT_ALLOW_PM'				=> $mchat_pm,
			'MCHAT_ALLOW_LIKE'				=> $mchat_like,
			'MCHAT_ALLOW_QUOTE'				=> $mchat_quote,
			'MCHAT_NOMESSAGE_MODE'			=> $mchat_no_message,
			'MCHAT_ALLOW_BBCODES'			=> $mchat_allow_bbcode && $this->config['allow_bbcode'],
			'MCHAT_MESSAGE_TOP'				=> $this->config['mchat_message_top'],
			'MCHAT_ENABLE'					=> $this->config['mchat_enable'],
			'MCHAT_ARCHIVE_URL'				=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive')),
			'MCHAT_CUSTOM_PAGE'				=> $mchat_custom_page,
			'MCHAT_INDEX_HEIGHT'			=> $config_mchat['index_height'],
			'MCHAT_CUSTOM_HEIGHT'			=> $config_mchat['custom_height'],
			'MCHAT_READ_ARCHIVE_BUTTON'		=> $mchat_read_archive,
			'MCHAT_FOUNDER'					=> $mchat_founder,
			'MCHAT_CLEAN_URL'				=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'clean', 'redirect' => $include_on_index ? 'index' : 'mchat')),
			'MCHAT_STATIC_MESS'				=> !empty($config_mchat['static_message']) ? htmlspecialchars_decode($config_mchat['static_message']) : '',
			'L_MCHAT_COPYRIGHT'				=> $copyright,
			'MCHAT_WHOIS'					=> $config_mchat['whois'],
			'MCHAT_MESSAGE_LNGTH'			=> $config_mchat['max_message_lngth'],
			//'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> $config_mchat['max_message_lngth']) ? sprintf($this->user->lang['MCHAT_MESSAGE_LNGTH_EXPLAIN'], $config_mchat['max_message_lngth']) : '',
			'MCHAT_MESS_LONG'				=> sprintf($this->user->lang['MCHAT_MESS_LONG'], $config_mchat['max_message_lngth']),
			'MCHAT_USER_TIMEOUT'			=> 1000 * $config_mchat['timeout'],
			'MCHAT_WHOIS_REFRESH'			=> 1000 * $config_mchat['whois_refresh'],
			'MCHAT_PAUSE_ON_INPUT'			=> $config_mchat['pause_on_input'],
			'L_MCHAT_ONLINE_EXPLAIN'		=> $this->functions_mchat->mchat_session_time($mchat_session_time),
			'MCHAT_REFRESH_YES'				=> sprintf($this->user->lang['MCHAT_REFRESH_YES'], $config_mchat['refresh']),
			'L_MCHAT_WHOIS_REFRESH_EXPLAIN'	=> sprintf($this->user->lang['WHO_IS_REFRESH_EXPLAIN'], $config_mchat['whois_refresh']),
			'S_MCHAT_AVATARS'				=> $mchat_avatars,
			'S_MCHAT_LOCATION'				=> $config_mchat['location'],
			'S_MCHAT_SOUND_YES'				=> $this->user->data['user_mchat_sound'],
			'S_MCHAT_INDEX_STATS'			=> $this->user->data['user_mchat_stats_index'],
			'U_MORE_SMILIES'				=> append_sid("{$this->phpbb_root_path}posting.{$this->phpEx}", 'mode=smilies'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'rules')),
			'S_MCHAT_ON_INDEX'				=> $this->config['mchat_on_index'] && !empty($this->user->data['user_mchat_index']),
			'EXT_URL'						=> generate_board_url() . '/ext/dmzx/mchat/',
		));

		// Return for $this->helper->render(filename, lang_title);
		return array(
			'filename'		=> 'mchat_body.html',
			'lang_title'	=> $this->user->lang['MCHAT_TITLE'],
		);
	}

	public function get_disallowed_bbcodes()
	{
		return $this->functions_mchat->get_disallowed_bbcodes();
	}
}
