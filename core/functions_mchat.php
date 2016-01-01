<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

class functions_mchat
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $phpEx;

	/** @var string */
	protected $mchat_table;

	/** @var string */
	protected $mchat_config_table;

	/** @var string */
	protected $mchat_sessions_table;

	/**
	* Constructor
	*
	* @param \phpbb\config\config				$config
	* @param \phpbb\template\template			$template
	* @param \phpbb\user						$user
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\log\log_interface			$log
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\cache\service				$cache
	* @param string								$phpbb_root_path
	* @param string								$phpEx
	* @param string								$mchat_table
	* @param string								$mchat_config_table
	* @param string								$mchat_sessions_table
	*/
	function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\log\log_interface $log, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, $phpbb_root_path, $phpEx, $mchat_table, $mchat_config_table, $mchat_sessions_table)
	{
		$this->config				= $config;
		$this->template				= $template;
		$this->user					= $user;
		$this->auth					= $auth;
		$this->log					= $log;
		$this->db					= $db;
		$this->cache				= $cache;
		$this->phpbb_root_path		= $phpbb_root_path;
		$this->phpEx				= $phpEx;
		$this->mchat_table			= $mchat_table;
		$this->mchat_config_table	= $mchat_config_table;
		$this->mchat_sessions_table = $mchat_sessions_table;
	}

	/**
	* Builds the cache if it doesn't exist
	*/
	function mchat_cache()
	{
		// Grab the config entries in the ACP...and cache em :P
		$config_mchat = $this->cache->get('_mchat_config');

		if ($config_mchat === false)
		{
			$sql = 'SELECT *
				FROM ' . $this->mchat_config_table;
			$result = $this->db->sql_query($sql);
			$rows = $this->db->sql_fetchrowset($result);
			$this->db->sql_freeresult($result);

			$config_mchat = array();
			foreach ($rows as $row)
			{
				$config_mchat[$row['config_name']] = $row['config_value'];
			}

			$this->cache->put('_mchat_config', $config_mchat);
		}

		return $config_mchat;
	}

	/**
	* @param $time the amount of time to display
	*/
	function mchat_session_time($time)
	{
		// Fix the display of the time limit
		$chat_session = '';
		$chat_timeout = (int) $time;
		$hours = $minutes = $seconds = 0;

		if ($chat_timeout >= 3600)
		{
			$hours = floor($chat_timeout / 3600);
			$chat_timeout = $chat_timeout - ($hours * 3600);
			$chat_session .= $hours > 1 ? ($hours . '&nbsp;' . $this->user->lang('MCHAT_HOURS')) : ($hours . '&nbsp;' . $this->user->lang('MCHAT_HOUR'));
		}

		$minutes = floor($chat_timeout / 60);
		if ($minutes)
		{
			$minutes = $minutes > 1 ? ($minutes . '&nbsp;' . $this->user->lang('MCHAT_MINUTES')) : ($minutes . '&nbsp;' . $this->user->lang('MCHAT_MINUTE'));
			$chat_timeout = $chat_timeout - ($minutes * 60);
			$chat_session .= $minutes;
		}

		$seconds = ceil($chat_timeout);
		if ($seconds)
		{
			$seconds = $seconds > 1 ? ($seconds . '&nbsp;' . $this->user->lang('MCHAT_SECONDS')) : ($seconds . '&nbsp;' . $this->user->lang('MCHAT_SECOND'));
			$chat_session .= $seconds;
		}

		return sprintf($this->user->lang('MCHAT_ONLINE_EXPLAIN'), $chat_session);
	}

	/**
	* @param $session_time amount of time before a users session times out
	*/
	function mchat_users($session_time)
	{
		$check_time = time() - (int) $session_time;

		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . '
			WHERE user_lastupdate < ' . $check_time;
		$this->db->sql_query($sql);

		$mchat_user_count = 0;
		$mchat_user_list = '';

		$sql = 'SELECT m.user_id, u.username, u.user_type, u.user_allow_viewonline, u.user_colour
			FROM ' . $this->mchat_sessions_table . ' m
			LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
			WHERE m.user_lastupdate > ' . $check_time . '
			ORDER BY u.username ASC';
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$can_view_hidden = $this->auth->acl_get('u_viewonline');
		foreach ($rows as $row)
		{
			if (!$row['user_allow_viewonline'])
			{
				if (!$can_view_hidden)
				{
					continue;
				}
				else
				{
					$row['username'] = '<em>' . $row['username'] . '</em>';
				}
			}

			$mchat_user_count++;
			$mchat_user_online_link = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST'));
			$mchat_user_list .= ($mchat_user_list != '') ? $this->user->lang('COMMA_SEPARATOR') . $mchat_user_online_link : $mchat_user_online_link;
		}

		$refresh_message = $this->mchat_session_time($session_time);

		if (!$mchat_user_count)
		{
			return array(
				'online_userlist'	=> '',
				'mchat_users_count'	=> $this->user->lang('MCHAT_NO_CHATTERS'),
				'refresh_message'	=> $refresh_message,
			);
		}
		else
		{
			return array(
				'online_userlist'	=> $mchat_user_list,
				'mchat_users_count'	=> sprintf($this->user->lang($mchat_user_count > 1 ? 'MCHAT_ONLINE_USERS_TOTAL' : 'MCHAT_ONLINE_USER_TOTAL'), $mchat_user_count),
				'refresh_message'	=> $refresh_message,
			);
		}
	}

	/**
	* @param mixed $session_time amount of time before a user is not shown as being in the chat
	*/
	function mchat_sessions($session_time)
	{
		$check_time = time() - (int) $session_time;
		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . '
			WHERE user_lastupdate < ' . $check_time;
		$this->db->sql_query($sql);

		// Insert user into the mChat sessions table
		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL && $this->user->data['user_id'] != ANONYMOUS && !$this->user->data['is_bot'])
		{
			$sql = 'SELECT *
				FROM ' . $this->mchat_sessions_table . '
				WHERE user_id = ' . (int) $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$user_lastupdate = time();

			if ($row)
			{
				$sql = 'UPDATE ' . $this->mchat_sessions_table . '
					SET user_lastupdate = ' . $user_lastupdate . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
			}
			else
			{
				$sql = 'INSERT INTO ' . $this->mchat_sessions_table . ' ' . $this->db->sql_build_array('INSERT', array(
					'user_id'			=> $this->user->data['user_id'],
					'user_ip'			=> $this->user->data['user_ip'],
					'user_lastupdate'	=> $user_lastupdate,
				));
			}

			$this->db->sql_query($sql);
		}
	}

	/**
	* mChat add-on Topic Notification
	*
	* @param mixed $post_id limits deletion to a post_id in the forum
	*/
	function mchat_delete_topic($post_id)
	{
		if ($post_id)
		{
			$sql = 'DELETE FROM ' . $this->mchat_table . '
				WHERE post_id = ' . (int) $post_id;
			$this->db->sql_query($sql);
		}
	}

	/**
	* AutoPrune Chats
	*
	* @param mixed $mchat_prune_amount set from mchat config entry
	*/
	function mchat_prune($mchat_prune_amount)
	{
		// How many chats do we have?
		$sql = 'SELECT COUNT(message_id) AS messages
			FROM ' . $this->mchat_table;
		$result = $this->db->sql_query($sql);
		$mchat_total_messages = (int) $this->db->sql_fetchfield('messages');
		$this->db->sql_freeresult($result);

		if ($mchat_total_messages <= $mchat_prune_amount)
		{
			return;
		}

		$result = $this->db->sql_query_limit('SELECT message_id
			FROM '. $this->mchat_table . '
			ORDER BY message_id ASC', 1);
		$first_id = (int) $this->db->sql_fetchfield('message_id');
		$this->db->sql_freeresult($result);

		// Compute the delete id
		$delete_id = $mchat_total_messages - $mchat_prune_amount + $first_id;

		$sql = 'DELETE FROM ' . $this->mchat_table . '
			WHERE message_id < ' . (int) $delete_id;
		$this->db->sql_query($sql);

		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED');
	}

	/**
	* @param mixed $mchat_prune_amount set from mchat config entry
	*/
	function display_mchat_bbcodes()
	{
		$default_bbcodes = array('B', 'I', 'U', 'QUOTE', 'CODE', 'LIST', 'IMG', 'URL', 'SIZE', 'COLOR', 'EMAIL', 'FLASH');
		$disallowed_bbcode_array = $this->get_disallowed_bbcodes();

		// Let's remove the default bbcodes
		if (!empty($disallowed_bbcode_array))
		{
			$disallowed_bbcode_array = array_map('strtoupper', $disallowed_bbcode_array);
			foreach ($default_bbcodes as $default_bbcode)
			{
				if (!in_array($default_bbcode, $disallowed_bbcode_array))
				{
					$this->template->assign_vars(array(
						'S_MCHAT_BBCODE_' . $default_bbcode => true,
					));
				}
			}
		}

		display_custom_bbcodes();
	}

	public function get_disallowed_bbcodes()
	{
		$config_mchat = $this->mchat_cache();
		$disallowed_bbcode = $config_mchat['bbcode_disallowed'];
		$disallowed_bbcode_array = explode('|', $disallowed_bbcode);
		return $disallowed_bbcode_array;
	}

	function mchat_avatar($row)
	{
		return phpbb_get_user_avatar(array(
			'avatar'		=> $row['user_avatar'],
			'avatar_type'	=> $row['user_avatar_type'],
			'avatar_width'	=> $row['user_avatar_width'] > $row['user_avatar_height'] ? 40 : (40 / $row['user_avatar_height']) * $row['user_avatar_width'],
			'avatar_height'	=> $row['user_avatar_height'] > $row['user_avatar_width'] ? 40 : (40 / $row['user_avatar_width']) * $row['user_avatar_height'],
		));
	}

	function mchat_messages($sql_where, $total, $offset = 0)
	{
		$sql_array = array(
			'SELECT'	=> 'm.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm',
			'FROM'		=> array($this->mchat_table	=> 'm'),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(USERS_TABLE => 'u'),
					'ON'	=> 'm.user_id = u.user_id',
				)
			),
			'WHERE'		=> $sql_where,
			'ORDER_BY'	=> 'm.message_id DESC',
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $total, $offset);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		return $rows;
	}

	function mchat_legend()
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
			$group_name = $row['group_type'] == GROUP_SPECIAL ? $this->user->lang('G_' . $row['group_name']) : $row['group_name'];
			if ($row['group_name'] == 'BOTS' || $this->user->data['user_id'] != ANONYMOUS && !$this->auth->acl_get('u_viewprofile'))
			{
				$legend[] = '<span' . $colour_text . '>' . $group_name . '</span>';
			}
			else
			{
				$legend[] = '<a' . $colour_text . ' href="' . append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=group&amp;g='.$row['group_id']) . '">' . $group_name . '</a>';
			}
		}

		return $legend;
	}

	function mchat_truncate_messages()
	{
		$sql = 'TRUNCATE TABLE ' . $this->mchat_table;
		$this->db->sql_query($sql);

		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED');
	}

	function mchat_foes()
	{
		$sql = 'SELECT *
			FROM ' . ZEBRA_TABLE . '
			WHERE user_id = ' . (int) $this->user->data['user_id'] . '
				AND foe = 1';
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$foes = array();
		foreach ($rows as $row)
		{
			$foes[] = $row['zebra_id'];
		}

		return $foes;
	}

	function mchat_insert_posting($mode, $data)
	{
		if (empty($this->config['mchat_enable']) || empty($this->config['mchat_new_posts']))
		{
			return;
		}

		if ($mode == 'post' && !empty($this->config['mchat_new_posts_topic']))
		{
			$mchat_new_data = $this->user->lang('MCHAT_NEW_TOPIC');
		}
		else if ($mode == 'quote' && !empty($this->config['mchat_new_posts_quote']))
		{
			$mchat_new_data = $this->user->lang('MCHAT_NEW_QUOTE');
		}
		else if ($mode == 'edit' && !empty($this->config['mchat_new_posts_edit']))
		{
			$mchat_new_data = $this->user->lang('MCHAT_NEW_EDIT');
		}
		else if ($mode == 'reply' && !empty($this->config['mchat_new_posts_reply']))
		{
			$mchat_new_data = $this->user->lang('MCHAT_NEW_REPLY');
		}
		else
		{
			return;
		}

		$message = utf8_normalize_nfc($mchat_new_data . ': [url=' . generate_board_url() . '/viewtopic.' . $this->phpEx . '?p=' . $data['post_id'] . '#p' . $data['post_id'] . ']' . $data['post_subject'] . '[/url] '. $this->user->lang('MCHAT_IN') . ' [url=' . generate_board_url() . '/viewforum.' . $this->phpEx . '?f=' . $data['forum_id'] . ']' . $data['forum_name'] . ' [/url] ' . $this->user->lang('MCHAT_IN_SECTION'));

		$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
		generate_text_for_storage($message, $uid, $bitfield, $options, true, false, false);
		$sql_ary = array(
			'forum_id'			=> $data['forum_id'],
			'post_id'			=> $data['post_id'],
			'user_id'			=> $this->user->data['user_id'],
			'user_ip'			=> $this->user->data['session_ip'],
			'message'			=> $message,
			'bbcode_bitfield'	=> $bitfield,
			'bbcode_uid'		=> $uid,
			'bbcode_options'	=> $options,
			'message_time'		=> time(),
		);
		$sql = 'INSERT INTO ' .	$this->mchat_table	. ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
		$this->db->sql_query($sql);
	}
}
