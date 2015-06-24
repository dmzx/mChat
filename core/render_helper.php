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

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\request\request */
	protected $request;

	protected $phpbb_root_path;

	protected $phpEx;

	protected $table_prefix;
	/**
	* The database tables
	*
	* @var string
	*/
	protected $mchat_table;

	/**
	 * Constructor
	 *
	 * @param \dmzx\mchat\core\functions_mchat	$functions_mchat
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\controller\helper			$helper
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\user						$user
	 * @param \phpbb\auth\auth					$auth
	 * @param \phpbb\db\driver\driver_interface	$db
	 * @param \phpbb\cache\service				$cache
	 * @param \phpbb\request\request			$request
	 * @param									$phpbb_root_path
	 * @param									$phpEx
	 * @param									$table_prefix
	 */
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, \phpbb\pagination $pagination, \phpbb\request\request $request, $phpbb_root_path, $phpEx, $table_prefix, $mchat_table)
	{
		$this->functions_mchat = $functions_mchat;
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->auth = $auth;
		$this->db = $db;
		$this->cache = $cache;
		$this->pagination = $pagination;
		$this->request = $request;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpEx = $phpEx;
		$this->phpbb_log = $log;
		$this->table_prefix = $table_prefix;
		$this->mchat_table = $mchat_table;
	}

	/**
	 * Method to render the page data
	 *
	 * @var bool		Bool if the rendering is only for index
	 * @return array	Data for page rendering
	 */
	public function render_data_for_page($only_for_index = false)
	{
		$include_on_index = ($only_for_index === true);

		// Add lang file
		$this->user->add_lang('posting');

		//chat enabled
		if (!$this->config['mchat_enable'])
		{
			trigger_error($this->user->lang['MCHAT_ENABLE'], E_USER_NOTICE);
		}

		//	avatars
		if (!function_exists('get_user_avatar'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->phpEx);
		}

		if (($this->config_mchat = $this->cache->get('_mchat_config')) === false)
		{
			$this->functions_mchat->mchat_cache();
		}
		$this->config_mchat = $this->cache->get('_mchat_config');
		// Access rights
		$mchat_allow_bbcode	= ($this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode')) ? true : false;
		$mchat_smilies = ($this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies')) ? true : false;
		$mchat_urls = ($this->config['allow_post_links'] && $this->auth->acl_get('u_mchat_urls')) ? true : false;
		$mchat_ip = ($this->auth->acl_get('u_mchat_ip')) ? true : false;
		$mchat_pm = ($this->auth->acl_get('u_mchat_pm')) ? true : false;
		$mchat_like = ($this->auth->acl_get('u_mchat_like')) ? true : false;
		$mchat_quote = ($this->auth->acl_get('u_mchat_quote')) ? true : false;
		$mchat_add_mess	= ($this->auth->acl_get('u_mchat_use')) ? true : false;
		$mchat_view	= ($this->auth->acl_get('u_mchat_view')) ? true : false;
		$mchat_no_flood	= ($this->auth->acl_get('u_mchat_flood_ignore')) ? true : false;
		$mchat_read_archive = ($this->auth->acl_get('u_mchat_archive')) ? true : false;
		$mchat_founder = ($this->user->data['user_type'] == USER_FOUNDER) ? true : false;
		$mchat_session_time = !empty($this->config_mchat['timeout']) ? $this->config_mchat['timeout'] : (!empty($this->config['load_online_time']) ? $this->config['load_online_time'] * 60 : $this->config['session_length']);
		$mchat_rules = (!empty($this->config_mchat['rules']) || isset($this->user->lang[strtoupper('mchat_rules')])) ? true : false;
		$mchat_avatars = (!empty($this->config_mchat['avatars']) && $this->user->optionget('viewavatars') && $this->user->data['user_mchat_avatars']) ? true : false;

		// needed variables
		// Request options.
		$mchat_mode	= $this->request->variable('mode', '');
		$mchat_read_mode = $mchat_archive_mode = $mchat_custom_page = $mchat_no_message = false;
		// set redirect if on index or custom page
		$on_page = $include_on_index ? 'index' : 'mchat';

		// grab fools..uhmmm, foes the user has
		$foes_array = array();
		$sql = 'SELECT * FROM ' . ZEBRA_TABLE . '
			WHERE user_id = ' . $this->user->data['user_id'] . '	AND foe = 1';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$foes_array[] = $row['zebra_id'];
		}
		$this->db->sql_freeresult($result);

		// Request mode...
		switch ($mchat_mode)
		{
			// rules popup..
			case 'rules':
				// If the rules are defined in the language file use them, else just use the entry in the database
				if ($mchat_rules || isset($this->user->lang[strtoupper('mchat_rules')]))
				{
					if(isset($this->user->lang[strtoupper('mchat_rules')]))
					{
						$this->template->assign_var('MCHAT_RULES', $this->user->lang[strtoupper('mchat_rules')]);
					}
					else
					{
						$mchat_rules = $this->config_mchat['rules'];
						$mchat_rules = explode("\n", $mchat_rules);

						foreach ($mchat_rules as $mchat_rule)
						{
							$mchat_rule = utf8_htmlspecialchars($mchat_rule);
							$this->template->assign_block_vars('rule', array(
								'MCHAT_RULE' => $mchat_rule,
							));
						}
					}

					// Output the page
					// Return for: \$this->helper->render(filename, lang_title);
					return array(
						'filename'		=> 'mchat_rules.html',
						'lang_title'	=> $this->user->lang['MCHAT_HELP'],
					);
				}
				else
				{
					// Show no rules
					trigger_error('MCHAT_NO_RULES', E_USER_NOTICE);
				}

				break;
			// whois function..
			case 'whois':

				// Must have auths
				if ($mchat_mode == 'whois' && $mchat_ip)
				{
					// function already exists..
					if (!function_exists('user_ipwhois'))
					{
						include($this->phpbb_root_path . 'includes/functions_user.' . $this->phpEx);
					}

					$this->user_ip = $this->request->variable('ip', '');

					$this->template->assign_var('WHOIS', user_ipwhois($this->user_ip));

					// Output the page
					// Return for: \$this->helper->render(filename, lang_title);
					return array(
						'filename'		=> 'viewonline_whois.html',
						'lang_title'	=> $this->user->lang['WHO_IS_ONLINE'],
					);
				}
				else
				{
					// Show not authorized
					trigger_error('NO_AUTH_OPERATION', E_USER_NOTICE);
				}
				break;
			// Clean function...
			case 'clean':

				// User logged in?
				if(!$this->user->data['is_registered'] || !$mchat_founder)
				{
					if(!$this->user->data['is_registered'])
					{
						// Login box...
						login_box('', $this->user->lang['LOGIN']);
					}
					else if (!$mchat_founder)
					{
						// Show not authorized
						trigger_error('NO_AUTH_OPERATION', E_USER_NOTICE);
					}
				}

				$mchat_redirect = $this->request->variable('redirect', '');
				$mchat_redirect = ($mchat_redirect == 'index') ? append_sid("{$this->phpbb_root_path}index.{$this->phpEx}") : $this->helper->route('dmzx_mchat_controller', array('#mChat'));

				if(confirm_box(true))
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

			// Archive function...
			case 'archive':

				if (!$mchat_read_archive || !$mchat_view)
				{
					// redirect to correct page
					$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");
					// Redirect to previous page
					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang['MCHAT_NOACCESS_ARCHIVE']. '<br /><br />' . sprintf($this->user->lang['RETURN_PAGE'], '<a href="' . $mchat_redirect . '">', '</a>'));
				}

				if ($this->config['mchat_enable'] && $mchat_read_archive && $mchat_view)
				{
					// how many chats do we have?
					$sql = 'SELECT COUNT(message_id) AS messages FROM ' . $this->mchat_table;
					$result = $this->db->sql_query($sql);
					$mchat_total_messages = $this->db->sql_fetchfield('messages');
					$this->db->sql_freeresult($result);
					// prune the chats if necessary and amount in ACP not empty
					if ($this->config_mchat['prune_enable'] && ($mchat_total_messages > $this->config_mchat['prune_num'] && $this->config_mchat['prune_num'] > 0))
					{
						$this->functions_mchat->mchat_prune((int) $this->config_mchat['prune_num']);
					}

					// Reguest...
					$mchat_archive_start = $this->request->variable('start', 0);
					$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'WHERE m.forum_id = 0';
					// Message row
					$sql = 'SELECT m.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm
						FROM ' . $this->mchat_table . ' m
							LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
						' . $sql_where . '
						ORDER BY m.message_id DESC';
					$result = $this->db->sql_query_limit($sql, (int) $this->config_mchat['archive_limit'], $mchat_archive_start);
					$rows = $this->db->sql_fetchrowset($result);
					$this->db->sql_freeresult($result);

					foreach($rows as $row)
					{
						// auth check
						if ($row['forum_id'] != 0 && !$this->auth->acl_get('f_read', $row['forum_id']))
						{
							continue;
						}
						// edit, delete and permission auths
						$mchat_ban = ($this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id']) ? true : false;
						$mchat_edit = ($this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id'])) ? true : false;
						$mchat_del = ($this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id'])) ? true : false;
						$mchat_avatar = $row['user_avatar'] ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], ($row['user_avatar_width'] > $row['user_avatar_height']) ? 40 : (40 / $row['user_avatar_height']) * $row['user_avatar_width'], ($row['user_avatar_height'] > $row['user_avatar_width']) ? 40 : (40 / $row['user_avatar_width']) * $row['user_avatar_height']) : '';
						$message_edit = $row['message'];
						decode_message($message_edit, $row['bbcode_uid']);
						$message_edit = str_replace('"', '&quot;', $message_edit); // Edit Fix ;)
						if (sizeof($foes_array))
						{
							if (in_array($row['user_id'], $foes_array))
							{
								$row['message'] = sprintf($this->user->lang['MCHAT_FOE'], get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']));
							}
						}
						$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
						$this->template->assign_block_vars('mchatrow', array(
							'MCHAT_ALLOW_BAN'		=> $mchat_ban,
							'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
							'MCHAT_ALLOW_DEL'		=> $mchat_del,
							'MCHAT_USER_AVATAR'		=> $mchat_avatar,
							'U_VIEWPROFILE'			=> ($row['user_id'] != ANONYMOUS) ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
							'U_USER_IDS'			=> ($row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
							'BOT_USER_ID' => $row['user_id'] != '1',
							'U_USER_ID'			=> ($row['user_id'] != ANONYMOUS && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && $this->user->data['user_id'] != $row['user_id'] && $row['user_id'] != '1' && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_'))) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
							'MCHAT_MESSAGE_EDIT'	=> $message_edit,
							'MCHAT_MESSAGE_ID'		=> $row['message_id'],
							'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USER_IP'			=> $row['user_ip'],
							'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
							'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
							'MCHAT_MESSAGE'			=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
							'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $this->config_mchat['date']),
							'MCHAT_CLASS'			=> ($row['message_id'] % 2) ? 1 : 2
						));
					}

					// Write no message
					if (empty($rows))
					{
						$mchat_no_message = true;
					}
				}

				// Run query again to get the total message rows...
				$sql = 'SELECT COUNT(message_id) AS mess_id FROM ' . $this->mchat_table;
				$result = $this->db->sql_query($sql);
				$mchat_total_message = $this->db->sql_fetchfield('mess_id');
				$this->db->sql_freeresult($result);

				// Page list function...
				$pagination_url = $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive'));

				$start = $this->request->variable('start', 0);
				$this->pagination->generate_template_pagination($pagination_url, 'pagination', 'start', $mchat_total_message,	(int) $this->config_mchat['archive_limit'], $mchat_archive_start);

				$this->template->assign_vars(array(
					'MCHAT_TOTAL_MESSAGES'	=> sprintf($this->user->lang['MCHAT_TOTALMESSAGES'], $mchat_total_message),
				));

				//add to navlinks
				$this->template->assign_block_vars('navlinks', array(
					'FORUM_NAME'		 => $this->user->lang['MCHAT_ARCHIVE_PAGE'],
					'U_VIEW_FORUM'		=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive')),
				));
				// If archive mode request set true
				$mchat_archive_mode = true;
				$old_mode = 'archive';

				break;

			// Read function...
			case 'read':

				// If mChat disabled or user can't view the chat
				if (!$this->config['mchat_enable'] || !$mchat_view)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}
				// if we're reading on the custom page, then we are chatting
				if ($mchat_custom_page)
				{
					// insert user into the mChat sessions table
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
				$result = $this->db->sql_query_limit($sql, (int) $this->config_mchat['message_limit']);
				$rows = $this->db->sql_fetchrowset($result);
				$this->db->sql_freeresult($result);
				// Reverse the array wanting messages appear in reverse
				if($this->config['mchat_message_top'])
				{
				$rows = array_reverse($rows);
				}

				foreach($rows as $row)
				{
					// auth check
					if ($row['forum_id'] != 0 && !$this->auth->acl_get('f_read', $row['forum_id']))
					{
						continue;
					}
					// edit auths
					if ($this->user->data['user_id'] == ANONYMOUS && $this->user->data['user_id'] == $row['user_id'])
					{
						$chat_auths = $this->user->data['session_ip'] == $row['user_ip'] ? true : false;
					}
					else
					{
						$chat_auths = $this->user->data['user_id'] == $row['user_id'] ? true : false;
					}
					// edit, delete and permission auths
					$mchat_ban = ($this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id']) ? true : false;
					$mchat_edit = ($this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $chat_auths)) ? true : false;
					$mchat_del = ($this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $chat_auths)) ? true : false;
					$mchat_avatar = $row['user_avatar'] ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], ($row['user_avatar_width'] > $row['user_avatar_height']) ? 40 : (40 / $row['user_avatar_height']) * $row['user_avatar_width'], ($row['user_avatar_height'] > $row['user_avatar_width']) ? 40 : (40 / $row['user_avatar_width']) * $row['user_avatar_height']) : '';
					$message_edit = $row['message'];
					decode_message($message_edit, $row['bbcode_uid']);
					$message_edit = str_replace('"', '&quot;', $message_edit);
					$message_edit = mb_ereg_replace("'", "&#146;", $message_edit);				// Edit Fix ;)
					if (sizeof($foes_array))
					{
						if (in_array($row['user_id'], $foes_array))
						{
							$row['message'] = sprintf($this->user->lang['MCHAT_FOE'], get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']));
						}
					}
					$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
					$this->template->assign_block_vars('mchatrow', array(
						'MCHAT_ALLOW_BAN'		=> $mchat_ban,
						'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
						'MCHAT_ALLOW_DEL'		=> $mchat_del,
						'MCHAT_USER_AVATAR'		=> $mchat_avatar,
						'U_VIEWPROFILE'			=> ($row['user_id'] != ANONYMOUS) ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
						'U_USER_IDS'			=> ($row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
						'BOT_USER_ID' => $row['user_id'] != '1',
						'U_USER_ID'			=> ($row['user_id'] != ANONYMOUS && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && $this->user->data['user_id'] != $row['user_id'] && $row['user_id'] != '1' && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_'))) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
						'MCHAT_MESSAGE_EDIT'	=> $message_edit,
						'MCHAT_MESSAGE_ID' 		=> $row['message_id'],
						'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
						'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
						'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
						'MCHAT_USER_IP'			=> $row['user_ip'],
						'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
						'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
						'MCHAT_MESSAGE'			=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
						'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $this->config_mchat['date']),
						'MCHAT_CLASS'			=> ($row['message_id'] % 2) ? 1 : 2
					));
				}

				// Write no message
				if (empty($rows))
				{
					$mchat_no_message = true;
				}

				// If read mode request set true
				$mchat_read_mode = true;

				break;

			// Stats function...
			case 'stats':

				// If mChat disabled or user can't view the chat
				if (!$this->config['mchat_enable'] || !$mchat_view || !$this->config_mchat['whois'])
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}

				$mchat_stats = $this->functions_mchat->mchat_users($mchat_session_time);

				if(!empty($mchat_stats['online_userlist']))
				{
					$message = '<div class="mChatStats" id="mChatStats"><a href="#" onclick="mChat.toggle(\'UserList\'); return false;">' . $mchat_stats['mchat_users_count'] . '</a>&nbsp;' . $mchat_stats['refresh_message'] . '<br /><span id="mChatUserList" style="display: none; float: left;">' . $mchat_stats['online_userlist'] . '</span></div>';
				}
				else
				{
					$message = '<div class="mChatStats" id="Div1">' . $this->user->lang['MCHAT_NO_CHATTERS'] . '&nbsp;(' . $mchat_stats['refresh_message'] . ')</div>';
				}

				if ($this->request->is_ajax())
				{
					// Return for: \Symfony\Component\HttpFoundation\JsonResponse
					return array(
						'json'			=> true,
						'message'		=> $message,
					);
				}
				else
				{
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				break;

			// Add function...
			case 'add':

				// If mChat disabled
				if (!$this->config['mchat_enable'] || !$mchat_add_mess || !check_form_key('mchat_posting', -1))
				{
					// Forbidden (for jQ AJAX request)
					if ($this->request->is_ajax()) // FOR DEBUG
						throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}

				// Reguest...
				$message = utf8_ucfirst(utf8_normalize_nfc($this->request->variable('message', '', true)));

				// must have something other than bbcode in the message
				if (empty($mchatregex))
				{
					//let's strip all the bbcode
					$mchatregex = '#\[/?[^\[\]]+\]#mi';
				}
				$message_chars = preg_replace($mchatregex, '', $message);
				$message_chars = (utf8_strlen(trim($message_chars)) > 0) ? true : false;

				if (!$message || !$message_chars)
				{
					// Not Implemented (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				// Flood control
				if (!$mchat_no_flood && $this->config_mchat['flood_time'])
				{
					$mchat_flood_current_time = time();
					$sql = 'SELECT message_time FROM ' . $this->mchat_table . '
						WHERE user_id = ' . (int) $this->user->data['user_id'] . '
						ORDER BY message_time DESC';
					$result = $this->db->sql_query_limit($sql, 1);
					$row = $this->db->sql_fetchrow($result);
					$this->db->sql_freeresult($result);
					if($row['message_time'] > 0 && ($mchat_flood_current_time - $row['message_time']) < (int) $this->config_mchat['flood_time'])
					{
						// Locked (for jQ AJAX request)
						throw new \phpbb\exception\http_exception(400, 'MCHAT_BAD_REQUEST');
					}
				}
				// insert user into the mChat sessions table
				$this->functions_mchat->mchat_sessions($mchat_session_time, true);
				// we override the $this->config['min_post_chars'] entry?
				if ($this->config_mchat['override_min_post_chars'])
				{
					$old_cfg['min_post_chars'] = $this->config['min_post_chars'];
					$this->config['min_post_chars'] = 0;
				}
				//we do the same for the max number of smilies?
				if ($this->config_mchat['override_smilie_limit'])
				{
					$old_cfg['max_post_smilies'] = $this->config['max_post_smilies'];
					$this->config['max_post_smilies'] = 0;
				}

				// Add function part code from http://wiki.phpbb.com/Parsing_text
				$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
				generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_allow_bbcode, $mchat_urls, $mchat_smilies);
				// Not allowed bbcodes
				if (!$mchat_allow_bbcode || $this->config_mchat['bbcode_disallowed'])
				{
					if (!$mchat_allow_bbcode)
					{
						$bbcode_remove = '#\[/?[^\[\]]+\]#Usi';
						$message = preg_replace($bbcode_remove, '', $message);
					}
					// disallowed bbcodes
					else if ($this->config_mchat['bbcode_disallowed'])
					{
						if (empty($bbcode_replace))
						{
							$bbcode_replace = array('#\[(' . $this->config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
												'#\[/(' . $this->config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
											);
						}
						$message = preg_replace($bbcode_replace, '', $message);
					}
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
					'message_time'		=> time()
				);
				$sql = 'INSERT INTO ' . $this->mchat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->db->sql_query($sql);

				// reset the config settings
				if(isset($old_cfg['min_post_chars']))
				{
					$this->config['min_post_chars'] = $old_cfg['min_post_chars'];
					unset($old_cfg['min_post_chars']);
				}
				if(isset($old_cfg['max_post_smilies']))
				{
					$this->config['max_post_smilies'] = $old_cfg['max_post_smilies'];
					unset($old_cfg['max_post_smilies']);
				}

				// Stop run code!
				if ($this->request->is_ajax())
				{
					// Return for: \Symfony\Component\HttpFoundation\JsonResponse
					return array(
						'json'			=> true,
						'success'		=> true,
					);
				}
				else
				{
					exit_handler();
				}
				break;

			// Edit function...
			case 'edit':

				$message_id = $this->request->variable('message_id', 0);

				// If mChat disabled and not edit
				if (!$this->config['mchat_enable'] || !$message_id)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}

				// check for the correct user
				$sql = 'SELECT *
					FROM ' . $this->mchat_table . '
					WHERE message_id = ' . (int) $message_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				// edit and delete auths
				$mchat_edit = $this->auth->acl_get('u_mchat_edit')&& ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']) ? true : false;
				$mchat_del = $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']) ? true : false;
				// If mChat disabled and not edit
				if (!$mchat_edit)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}
				// Reguest...
				$message = $this->request->variable('message', '', true);

				// must have something other than bbcode in the message
				if (empty($mchatregex))
				{
					//let's strip all the bbcode
					$mchatregex = '#\[/?[^\[\]]+\]#mi';
				}
				$message_chars = preg_replace($mchatregex, '', $message);
				$message_chars = (utf8_strlen(trim($message_chars)) > 0) ? true : false;
				if (!$message || !$message_chars)
				{
					// Not Implemented (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				// Message limit
				$message = ($this->config_mchat['max_message_lngth'] != 0 && utf8_strlen($message) >= $this->config_mchat['max_message_lngth'] + 3) ? utf8_substr($message, 0, $this->config_mchat['max_message_lngth']).'...' : $message;

				// we override the $this->config['min_post_chars'] entry?
				if ($this->config_mchat['override_min_post_chars'])
				{
					$old_cfg['min_post_chars'] = $this->config['min_post_chars'];
					$this->config['min_post_chars'] = 0;
				}
				//we do the same for the max number of smilies?
				if ($this->config_mchat['override_smilie_limit'])
				{
					$old_cfg['max_post_smilies'] = $this->config['max_post_smilies'];
					$this->config['max_post_smilies'] = 0;
				}

				// Edit function part code from http://wiki.phpbb.com/Parsing_text
				$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
				generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_allow_bbcode, $mchat_urls, $mchat_smilies);

				// Not allowed bbcodes
				if (!$mchat_allow_bbcode || $this->config_mchat['bbcode_disallowed'])
				{
					if (!$mchat_allow_bbcode)
					{
						$bbcode_remove = '#\[/?[^\[\]]+\]#Usi';
						$message = preg_replace($bbcode_remove, '', $message);
					}
					// disallowed bbcodes
					else if ($this->config_mchat['bbcode_disallowed'])
					{
						if (empty($bbcode_replace))
						{
							$bbcode_replace = array('#\[(' . $this->config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
												'#\[/(' . $this->config_mchat['bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
							);
						}
						$message = preg_replace($bbcode_replace, '', $message);
					}
				}

				$sql_ary = array(
					'message'			=> str_replace('\'', '&rsquo;', $message),
					'bbcode_bitfield'	=> $bitfield,
					'bbcode_uid'		=> $uid,
					'bbcode_options'	=> $options
				);

				$sql = 'UPDATE ' . $this->mchat_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary).'
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
				$message_edit = str_replace('"', '&quot;', $message_edit); // Edit Fix ;)
				$message_edit = mb_ereg_replace("'", "&#146;", $message_edit);				// Edit Fix ;)
				$mchat_ban = ($this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id']) ? true : false;
				$mchat_avatar = $row['user_avatar'] ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], ($row['user_avatar_width'] > $row['user_avatar_height']) ? 40 : (40 / $row['user_avatar_height']) * $row['user_avatar_width'], ($row['user_avatar_height'] > $row['user_avatar_width']) ? 40 : (40 / $row['user_avatar_width']) * $row['user_avatar_height']) : '';
				$this->template->assign_block_vars('mchatrow', array(
					'MCHAT_ALLOW_BAN'		=> $mchat_ban,
					'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
					'MCHAT_ALLOW_DEL'		=> $mchat_del,
					'MCHAT_MESSAGE_EDIT'	=> $message_edit,
					'MCHAT_USER_AVATAR'		=> $mchat_avatar,
					'U_VIEWPROFILE'			=> ($row['user_id'] != ANONYMOUS) ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
					'U_USER_IDS'			=> ($row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
					'BOT_USER_ID' => $row['user_id'] != '1',
					'U_USER_ID'			=> ($row['user_id'] != ANONYMOUS && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && $this->user->data['user_id'] != $row['user_id'] && $row['user_id'] != '1' && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_'))) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
					'MCHAT_MESSAGE_ID'		=> $row['message_id'],
					'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
					'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
					'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
					'MCHAT_USER_IP'			=> $row['user_ip'],
					'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
					'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
					'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
					'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $this->config_mchat['date']),
					'MCHAT_CLASS'			=> ($row['message_id'] % 2) ? 1 : 2
				));
				// reset the config settings
				if(isset($old_cfg['min_post_chars']))
				{
					$this->config['min_post_chars'] = $old_cfg['min_post_chars'];
					unset($old_cfg['min_post_chars']);
				}
				if(isset($old_cfg['max_post_smilies']))
				{
					$this->config['max_post_smilies'] = $old_cfg['max_post_smilies'];
					unset($old_cfg['max_post_smilies']);
				}
				//adds a log
			//	$message_author = get_username_string('no_profile', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']);
			//	add_log('admin', 'LOG_EDITED_MCHAT', $message_author);
				$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EDITED_MCHAT', false, array($row['username']));
				// insert user into the mChat sessions table
				$this->functions_mchat->mchat_sessions($mchat_session_time, true);
				// If read mode request set true
				$mchat_read_mode = true;

				break;

			// Delete function...
			case 'delete':

				$message_id = $this->request->variable('message_id', 0);
				// If mChat disabled
				if (!$this->config['mchat_enable'] || !$message_id)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}
				// check for the correct user
				$sql = 'SELECT m.*, u.username, u.user_colour
					FROM ' . $this->mchat_table . ' m
					LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
					WHERE m.message_id = ' . (int) $message_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				// edit and delete auths
				$mchat_edit = $this->auth->acl_get('u_mchat_edit')&& ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']) ? true : false;
				$mchat_del = $this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $this->user->data['user_id'] == $row['user_id']) ? true : false;

				// If mChat disabled
				if (!$mchat_del)
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_ERROR_FORBIDDEN');
				}

				// Run delete!
				$sql = 'DELETE FROM ' . $this->mchat_table . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				//adds a log
				$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_DELETED_MCHAT', false, array($row['username']));
				// insert user into the mChat sessions table
				$this->functions_mchat->mchat_sessions($mchat_session_time, true);

				// Stop running code
				if ($this->request->is_ajax())
				{
					// Return for: \Symfony\Component\HttpFoundation\JsonResponse
					return array(
						'json'			=> true,
						'success'		=> true,
					);
				}
				else
				{
					exit_handler();
				}
				break;

			// Default function...
			default:

				// If not include in index.php set mchat.php page true
				if (!$include_on_index)
				{
					// Yes its custom page...
					$mchat_custom_page = true;

					// If custom page false mchat.php page redirect to index...
					if (!$this->config_mchat['custom_page'] && $mchat_custom_page)
					{
						$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");
						// Redirect to previous page
						meta_refresh(3, $mchat_redirect);
						trigger_error($this->user->lang['MCHAT_NO_CUSTOM_PAGE']. '<br /><br />' . sprintf($this->user->lang['RETURN_PAGE'], '<a href="' . $mchat_redirect . '">', '</a>'));
					}

					// user has permissions to view the custom chat?
					if (!$mchat_view && $mchat_custom_page)
					{
						trigger_error('NOT_AUTHORISED', E_USER_NOTICE);
					}

					// if whois true
					if ($this->config_mchat['whois'])
					{
						// Grab group details for legend display for who is online on the custom page.
						$order_legend = ($this->config['legend_sort_groupname']) ? 'group_name' : 'group_legend';
						if ($this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
						{
							$sql = 'SELECT group_id, group_name, group_colour, group_type FROM ' . GROUPS_TABLE . '
						WHERE group_legend <> 0
							ORDER BY ' . $order_legend . ' ASC';
						}
						else
						{
							$sql = 'SELECT g.group_id, g.group_name, g.group_colour, g.group_type FROM ' . GROUPS_TABLE . ' g
						LEFT JOIN ' . USER_GROUP_TABLE . ' ug ON (g.group_id = ug.group_id AND ug.user_id = ' . $this->user->data['user_id'] . ' AND ug.user_pending = 0)
							WHERE g.group_legend <> 0
								AND (g.group_type <> ' . GROUP_HIDDEN . '
									OR ug.user_id = ' . (int) $this->user->data['user_id'] . ')
							ORDER BY g.' . $order_legend . ' ASC';
						}
						$result = $this->db->sql_query($sql);
						$legend = array();

						while ($row = $this->db->sql_fetchrow($result))
						{
							$colour_text = ($row['group_colour']) ? ' style="color:#'.$row['group_colour'].'"' : '';
							$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang['G_'.$row['group_name']] : $row['group_name'];
							if ($row['group_name'] == 'BOTS' || ($this->user->data['user_id'] != ANONYMOUS && !$this->auth->acl_get('u_viewprofile')))
							{
								$legend[] = '<span'.$colour_text.'>'.$group_name.'</span>';
							}
							else
							{
								$legend[] = '<a'.$colour_text.' href="'.append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=group&amp;g='.$row['group_id']).'">'.$group_name.'</a>';
							}
						}
						$this->db->sql_freeresult($result);
						$legend = implode(', ', $legend);

						// Assign index specific vars
						$this->template->assign_vars(array(
							'LEGEND'	=> $legend,
						));
					}
					$this->template->assign_block_vars('navlinks', array(
						'FORUM_NAME'		 => $this->user->lang['MCHAT_TITLE'],
						'U_VIEW_FORUM'		=> $this->helper->route('dmzx_mchat_controller'),
					));
				}

				// Run code...
				if ($mchat_view)
				{
					$message_number = $mchat_custom_page ? $this->config_mchat['message_limit'] : $this->config_mchat['message_num'];
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

					if($this->config['mchat_message_top'])
					{
					$rows = array_reverse($rows, true);
					}

					foreach($rows as $row)
					{
						// auth check
						if ($row['forum_id'] != 0 && !$this->auth->acl_get('f_read', $row['forum_id']))
						{
							continue;
						}
						// edit, delete and permission auths
						$mchat_ban = ($this->auth->acl_get('a_authusers') && $this->user->data['user_id'] != $row['user_id']) ? true : false;
						// edit auths
						if ($this->user->data['user_id'] == ANONYMOUS && $this->user->data['user_id'] == $row['user_id'])
						{
							$chat_auths = $this->user->data['session_ip'] == $row['user_ip'] ? true : false;
						}
						else
						{
							$chat_auths = $this->user->data['user_id'] == $row['user_id'] ? true : false;
						}
						$mchat_edit = ($this->auth->acl_get('u_mchat_edit') && ($this->auth->acl_get('m_') || $chat_auths)) ? true : false;
						$mchat_del = ($this->auth->acl_get('u_mchat_delete') && ($this->auth->acl_get('m_') || $chat_auths)) ? true : false;
						$mchat_avatar = $row['user_avatar'] ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], ($row['user_avatar_width'] > $row['user_avatar_height']) ? 40 : (40 / $row['user_avatar_height']) * $row['user_avatar_width'], ($row['user_avatar_height'] > $row['user_avatar_width']) ? 40 : (40 / $row['user_avatar_width']) * $row['user_avatar_height']) : '';
						$message_edit = $row['message'];
						decode_message($message_edit, $row['bbcode_uid']);
						$message_edit = str_replace('"', '&quot;', $message_edit); // Edit Fix ;)
						$message_edit = mb_ereg_replace("'", "&#146;", $message_edit);
						if (sizeof($foes_array))
						{
							if (in_array($row['user_id'], $foes_array))
							{
								$row['message'] = sprintf($this->user->lang['MCHAT_FOE'], get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']));
							}
						}
						$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
						$message = str_replace('\'', '&rsquo;', $row['message']);
						$this->template->assign_block_vars('mchatrow', array(
							'MCHAT_ALLOW_BAN'		=> $mchat_ban,
							'MCHAT_ALLOW_EDIT'		=> $mchat_edit,
							'MCHAT_ALLOW_DEL'		=> $mchat_del,
							'MCHAT_USER_AVATAR'		=> $mchat_avatar,
							'U_VIEWPROFILE'			=> ($row['user_id'] != ANONYMOUS) ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
							'U_USER_IDS'			=> ($row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id']) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
							'BOT_USER_ID' => $row['user_id'] != '1',
							'U_USER_ID'			=> ($row['user_id'] != ANONYMOUS && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && $this->user->data['user_id'] != $row['user_id'] && $row['user_id'] != '1' && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_'))) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
							'MCHAT_MESSAGE_EDIT'	=> $message_edit,
							'MCHAT_MESSAGE_ID'		=> $row['message_id'],
							'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
							'MCHAT_USER_IP'			=> $row['user_ip'],
							'MCHAT_U_WHOIS'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'whois', 'ip' => $row['user_ip'])),
							'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
							'MCHAT_MESSAGE'			=> generate_text_for_display($message, $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
							'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $this->config_mchat['date']),
							'MCHAT_CLASS'			=> ($row['message_id'] % 2) ? 1 : 2
						));

					}

					// Write no message
					if (empty($rows))
					{
						$mchat_no_message = true;
					}
					// display custom bbcodes
					if($mchat_allow_bbcode && $this->config['allow_bbcode'])
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
					if (isset($this->user->lang[strtoupper('static_message')]) || !empty($this->config_mchat['static_message']))
					{
						$this->config_mchat['static_message'] = $this->config_mchat['static_message'];
						if(isset($this->user->lang[strtoupper('static_message')]))
						{
							$this->config_mchat['static_message'] = $this->user->lang[strtoupper('static_message')];
						}
					}
					// If the static message is defined in the language file use it, else just use the entry in the database
					if (isset($this->user->lang[strtoupper('mchat_rules')]) || !empty($this->config_mchat['rules']))
					{
						if(isset($this->user->lang[strtoupper('mchat_rules')]))
						{
							$this->config_mchat['rules'] = $this->user->lang[strtoupper('mchat_rules')];
						}
					}
					// a list of users using the chat
					if ($mchat_custom_page)
					{
						$mchat_users = $this->functions_mchat->mchat_users($mchat_session_time, true);
					}
					else
					{
						$mchat_users = $this->functions_mchat->mchat_users($mchat_session_time);
					}
					$this->template->assign_vars(array(
						'MCHAT_USERS_COUNT'		=> $mchat_users['mchat_users_count'],
						'MCHAT_USERS_LIST'		=> $mchat_users['online_userlist'],
					));
				}
				break;
		}

		// show index stats
		if (!empty($this->config['mchat_stats_index']) && !empty($this->user->data['user_mchat_stats_index']))
		{
			// stats display
			$mchat_session_time = !empty($this->config_mchat['timeout']) ? $this->config_mchat['timeout'] : $this->config['session_length'];
			$mchat_stats = $this->functions_mchat->mchat_users($mchat_session_time);
			$this->template->assign_vars(array(
				'MCHAT_INDEX_STATS'	=> true,
				'MCHAT_INDEX_USERS_COUNT'	=> $mchat_stats['mchat_users_count'],
				'MCHAT_INDEX_USERS_LIST'	=> !empty($mchat_stats['online_userlist']) ? $mchat_stats['online_userlist'] : '',
				'L_MCHAT_ONLINE_EXPLAIN'	=> $mchat_stats['refresh_message'],
			));
		}

		$copyright = base64_decode('PGEgaHJlZj0iaHR0cDovL3JtY2dpcnI4My5vcmciPlJNY0dpcnI4MzwvYT4gJmNvcHk7IDxhIGhyZWY9Imh0dHA6Ly93d3cuZG16eC13ZWIubmV0IiB0aXRsZT0id3d3LmRtengtd2ViLm5ldCI+ZG16eDwvYT4=');
		add_form_key('mchat_posting');
		// Template function...
		$this->template->assign_vars(array(
			'MCHAT_FILE_NAME'		=> $this->helper->route('dmzx_mchat_controller'),
			'MCHAT_REFRESH_JS'		=> 1000 * $this->config_mchat['refresh'],
			'MCHAT_ADD_MESSAGE'		=> $mchat_add_mess,
			'MCHAT_READ_MODE'		=> $mchat_read_mode,
			'MCHAT_ARCHIVE_MODE'	=> $mchat_archive_mode,
			'MCHAT_INPUT_TYPE'		=> $this->user->data['user_mchat_input_area'],
			'MCHAT_RULES'			=> $mchat_rules,
			'MCHAT_ALLOW_SMILES'	=> $mchat_smilies,
			'MCHAT_ALLOW_IP'		=> $mchat_ip,
			'MCHAT_ALLOW_PM'		=> $mchat_pm,
			'MCHAT_ALLOW_LIKE'		=> $mchat_like,
			'MCHAT_ALLOW_QUOTE'		=> $mchat_quote,
			'MCHAT_NOMESSAGE_MODE'	=> $mchat_no_message,
			'MCHAT_ALLOW_BBCODES'	=> ($mchat_allow_bbcode && $this->config['allow_bbcode']) ? true : false,
			'MCHAT_MESSAGE_TOP'		=> $this->config['mchat_message_top'] ? true : false,
			'MCHAT_ENABLE'			=> $this->config['mchat_enable'],
			'MCHAT_ARCHIVE_URL'		=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'archive')),
			'MCHAT_CUSTOM_PAGE'		=> $mchat_custom_page,
			'MCHAT_INDEX_HEIGHT'	=> $this->config_mchat['index_height'],
			'MCHAT_CUSTOM_HEIGHT'	=> $this->config_mchat['custom_height'],
			'MCHAT_READ_ARCHIVE_BUTTON'		=> $mchat_read_archive,
			'MCHAT_FOUNDER'			=> $mchat_founder,
			'MCHAT_CLEAN_URL'		=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'clean', 'redirect' => $on_page)),
			'MCHAT_STATIC_MESS'		=> !empty($this->config_mchat['static_message']) ? htmlspecialchars_decode($this->config_mchat['static_message']) : '',
			'L_MCHAT_COPYRIGHT'		=> $copyright,
			'MCHAT_WHOIS'			=> $this->config_mchat['whois'],
			'MCHAT_MESSAGE_LNGTH'	=> $this->config_mchat['max_message_lngth'],
			'L_MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> (intval($this->config_mchat['max_message_lngth'])) ? sprintf($this->user->lang['MCHAT_MESSAGE_LNGTH_EXPLAIN'], intval($this->config_mchat['max_message_lngth'])) : '',
			'MCHAT_MESS_LONG'		=> sprintf($this->user->lang['MCHAT_MESS_LONG'], $this->config_mchat['max_message_lngth']),
			'MCHAT_USER_TIMEOUT'	=> $this->config_mchat['timeout'] ? 1000 * $this->config_mchat['timeout'] : false,
			'MCHAT_WHOIS_REFRESH'	=> 1000 * $this->config_mchat['whois_refresh'],
			'MCHAT_PAUSE_ON_INPUT'	=> $this->config_mchat['pause_on_input'] ? true : false,
			'L_MCHAT_ONLINE_EXPLAIN'	=> $this->functions_mchat->mchat_session_time($mchat_session_time),
			'MCHAT_REFRESH_YES'		=> sprintf($this->user->lang['MCHAT_REFRESH_YES'], $this->config_mchat['refresh']),
			'L_MCHAT_WHOIS_REFRESH_EXPLAIN'	=> sprintf($this->user->lang['WHO_IS_REFRESH_EXPLAIN'], $this->config_mchat['whois_refresh']),
			'S_MCHAT_AVATARS'		=> $mchat_avatars,
			'S_MCHAT_LOCATION'		=> $this->config_mchat['location'],
			'S_MCHAT_SOUND_YES'		=> $this->user->data['user_mchat_sound'],
			'S_MCHAT_INDEX_STATS'	=> $this->user->data['user_mchat_stats_index'],
			'U_MORE_SMILIES'		=> append_sid("{$this->phpbb_root_path}posting.{$this->phpEx}", 'mode=smilies'),
			'U_MCHAT_RULES'			=> $this->helper->route('dmzx_mchat_controller', array('mode' => 'rules')),
			'S_MCHAT_ON_INDEX'		=> ($this->config['mchat_on_index'] && !empty($this->user->data['user_mchat_index'])) ? true : false,
		));

		// Return for: \$this->helper->render(filename, lang_title);
		return array(
			'filename'		=> 'mchat_body.html',
			'lang_title'	=> $this->user->lang['MCHAT_TITLE'],
		);
	}
}