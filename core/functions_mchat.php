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

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $mchat_table;

	/** @var string */
	protected $mchat_sessions_table;

	/** @var array */
	protected $foes = null;

	/**
	* Constructor
	*
	* @param \phpbb\config\config					$config
	* @param \phpbb\user							$user
	* @param \phpbb\auth\auth						$auth
	* @param \phpbb\log\log_interface				$log
	* @param \phpbb\db\driver\driver_interface		$db
	* @param \phpbb\cache\driver\driver_interface	$cache
	* @param string									$phpbb_root_path
	* @param string									$php_ext
	* @param string									$mchat_table
	* @param string									$mchat_sessions_table
	*/
	function __construct(\phpbb\config\config $config, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\log\log_interface $log, \phpbb\db\driver\driver_interface $db, \phpbb\cache\driver\driver_interface $cache, $phpbb_root_path, $php_ext, $mchat_table, $mchat_sessions_table)
	{
		$this->config				= $config;
		$this->user					= $user;
		$this->auth					= $auth;
		$this->log					= $log;
		$this->db					= $db;
		$this->cache				= $cache;
		$this->phpbb_root_path		= $phpbb_root_path;
		$this->php_ext				= $php_ext;
		$this->mchat_table			= $mchat_table;
		$this->mchat_sessions_table = $mchat_sessions_table;
	}

	/**
	* Converts a number of seconds to a string in the format 'x hours y minutes z seconds'
	*/
	protected function mchat_format_seconds($time)
	{
		$times = array();

		$hours = floor($time / 3600);
		if ($hours)
		{
			$time -= $hours * 3600;
			$times[] = $hours . '&nbsp;' . $this->user->lang($hours > 1 ? 'MCHAT_HOURS' : 'MCHAT_HOUR');
		}

		$minutes = floor($time / 60);
		if ($minutes)
		{
			$time -= $minutes * 60;
			$times[] = $minutes . '&nbsp;' . $this->user->lang($minutes > 1 ? 'MCHAT_MINUTES' : 'MCHAT_MINUTE');
		}

		$seconds = ceil($time);
		if ($seconds)
		{
			$times[] = $seconds . '&nbsp;' . $this->user->lang($seconds > 1 ? 'MCHAT_SECONDS' : 'MCHAT_SECOND');
		}

		return sprintf($this->user->lang('MCHAT_ONLINE_EXPLAIN'), implode('&nbsp;', $times));
	}

	/**
	* Returns the total session time in seconds
	*/
	protected function mchat_session_time()
	{
		return !empty($this->config['mchat_timeout']) ? $this->config['mchat_timeout'] : (!empty($this->config['load_online_time']) ? $this->config['load_online_time'] * 60 : $this->config['session_length']);
	}

	/**
	* Returns data about users who are currently chatting
	*/
	public function mchat_active_users()
	{
		$mchat_users = array();

		$check_time = time() - $this->mchat_session_time();

		$sql = 'SELECT m.user_id, u.username, u.user_type, u.user_allow_viewonline, u.user_colour
			FROM ' . $this->mchat_sessions_table . ' m
			LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
			WHERE m.user_lastupdate >= ' . (int) $check_time . '
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

				$row['username'] = '<em>' . $row['username'] . '</em>';
			}

			$mchat_users[] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST'));
		}

		return array(
			'online_userlist'	=> implode($this->user->lang('COMMA_SEPARATOR'), $mchat_users),
			'mchat_users_count'	=> count($mchat_users) ? $this->user->lang(count($mchat_users) > 1 ? 'MCHAT_ONLINE_USERS_TOTAL' : 'MCHAT_ONLINE_USER_TOTAL', count($mchat_users)) : $this->user->lang('MCHAT_NO_CHATTERS'),
			'refresh_message'	=> $this->mchat_format_seconds($this->mchat_session_time()),
		);
	}

	/**
	* Inserts the current user into the mchat_sessions table
	*/
	public function mchat_add_user_session()
	{
		// Remove expired sessions from the database
		$check_time = time() - $this->mchat_session_time();
		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . '
			WHERE user_lastupdate < ' . $check_time;
		$this->db->sql_query($sql);

		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL && $this->user->data['user_id'] != ANONYMOUS && !$this->user->data['is_bot'])
		{
			$sql = 'SELECT *
				FROM ' . $this->mchat_sessions_table . '
				WHERE user_id = ' . (int) $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row)
			{
				$sql = 'UPDATE ' . $this->mchat_sessions_table . '
					SET user_lastupdate = ' . time() . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
			}
			else
			{
				$sql = 'INSERT INTO ' . $this->mchat_sessions_table . ' ' . $this->db->sql_build_array('INSERT', array(
					'user_id'			=> $this->user->data['user_id'],
					'user_ip'			=> $this->user->data['user_ip'],
					'user_lastupdate'	=> time(),
				));
			}

			$this->db->sql_query($sql);
		}
	}

	/**
	* Prune messages
	*/
	public function mchat_prune()
	{
		if ($this->config['mchat_prune'])
		{
			$mchat_total_messages = $this->mchat_total_message_count();

			if ($mchat_total_messages > $this->config['mchat_prune_num'])
			{
				$sql = 'SELECT message_id
					FROM '. $this->mchat_table . '
					ORDER BY message_id ASC';
				$result = $this->db->sql_query_limit($sql, 1);
				$first_id = (int) $this->db->sql_fetchfield('message_id');
				$this->db->sql_freeresult($result);

				// Compute new oldest message id
				$delete_id = $mchat_total_messages - $this->config['mchat_prune_num'] + $first_id;

				// Delete older messages
				$this->mchat_action('prune', null, $delete_id);
			}
		}
	}

	/**
	* Returns the total number of messages
	*/
	public function mchat_total_message_count()
	{
		return $this->db->get_row_count($this->mchat_table);
	}

	/**
	* Fetch messages from the database
	*/
	public function mchat_get_messages($sql_where, $total = 0, $offset = 0)
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

	/**
	* Generates the user legend markup
	*/
	public function mchat_legend()
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
				$legend[] = '<a' . $colour_text . ' href="' . append_sid("{$this->phpbb_root_path}memberlist.{$this->php_ext}", 'mode=group&amp;g='.$row['group_id']) . '">' . $group_name . '</a>';
			}
		}

		return $legend;
	}

	/**
	* Returns a list of all foes of the current user
	*/
	public function mchat_foes()
	{
		if (is_null($this->foes))
		{
			$sql = 'SELECT *
				FROM ' . ZEBRA_TABLE . '
				WHERE foe = 1 AND user_id = ' . (int) $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$rows = $this->db->sql_fetchrowset($result);
			$this->db->sql_freeresult($result);

			$this->foes = array();
			foreach ($rows as $row)
			{
				$this->foes[] = $row['zebra_id'];
			}
		}

		return $this->foes;
	}

	/**
	* Adds forbidden BBCodes to the passed SQL where statement
	*/
	public function mchat_sql_append_forbidden_bbcodes($sql_where)
	{
		$disallowed_bbcodes = explode('|', strtoupper($this->config['mchat_bbcode_disallowed']));

		if (!empty($disallowed_bbcodes))
		{
			$sql_where .= ' AND ' . $this->db->sql_in_set('UPPER(b.bbcode_tag)', $disallowed_bbcodes, true);
		}

		return $sql_where;
	}

	/**
	* Inserts a message with posting information into the database
	*/
	public function mchat_insert_posting($mode, $data)
	{
		$mode_config = array(
			'post'	=> $this->config['mchat_new_posts_topic'],
			'quote'	=> $this->config['mchat_new_posts_quote'],
			'edit'	=> $this->config['mchat_new_posts_edit'],
			'reply'	=> $this->config['mchat_new_posts_reply'],
		);

		if (empty($mode_config[$mode]))
		{
			return;
		}

		$mchat_new_data = $this->user->lang('MCHAT_NEW_' . strtoupper($mode));

		$message = utf8_normalize_nfc($mchat_new_data . ': [url=' . generate_board_url() . '/viewtopic.' . $this->php_ext . '?p=' . $data['post_id'] . '#p' . $data['post_id'] . ']' . $data['post_subject'] . '[/url] '. $this->user->lang('MCHAT_IN') . ' [url=' . generate_board_url() . '/viewforum.' . $this->php_ext . '?f=' . $data['forum_id'] . ']' . $data['forum_name'] . ' [/url] ' . $this->user->lang('MCHAT_IN_SECTION'));

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

	/**
	* Checks if the current user is flooding the chat
	*/
	public function mchat_is_user_flooding()
	{
		if (!$this->config['mchat_flood_time'] || $this->auth->acl_get('u_mchat_flood_ignore'))
		{
			return false;
		}

		$sql = 'SELECT message_time
			FROM ' . $this->mchat_table . '
			WHERE user_id = ' . (int) $this->user->data['user_id'] . '
			ORDER BY message_time DESC';
		$result = $this->db->sql_query_limit($sql, 1);
		$message_time = (int) $this->db->sql_fetchfield('message_time');
		$this->db->sql_freeresult($result);

		return $message_time && time() - $message_time < $this->config['mchat_flood_time'];
	}

	/**
	* Returns user ID & name of the specified message
	*/
	public function mchat_author_for_message($message_id)
	{
		$sql = 'SELECT u.user_id, u.username, m.message_time
			FROM ' . $this->mchat_table . ' m
			LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
			WHERE m.message_id = ' . (int) $message_id;
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	/**
	* Returns an array of message IDs that have been deleted from the message table
	*/
	public function mchat_missing_ids($start_id, $end_id)
	{
		if ($this->config['mchat_edit_delete_limit'])
		{
			$sql_where = 'message_time < ' . (time() - $this->config['mchat_edit_delete_limit']);
			$cache_ttl = 0;
		}
		else
		{
			$sql_where = 'message_id < ' . (int) $start_id;
			$cache_ttl = 3600;
		}

		$sql = 'SELECT message_id
			FROM ' . $this->mchat_table . '
			WHERE ' . $sql_where . '
			ORDER BY message_id DESC';
		$result = $this->db->sql_query_limit($sql, 1, 0, $cache_ttl);
		$earliest_id = (int) $this->db->sql_fetchfield('message_id');
		$this->db->sql_freeresult($result);

		if (!$earliest_id)
		{
			$sql = 'SELECT MIN(message_id) as earliest_id
				FROM ' . $this->mchat_table;
			$result = $this->db->sql_query($sql, 3600);
			$earliest_id = $this->db->sql_fetchfield('earliest_id');
			$this->db->sql_freeresult($result);
		}

		if (!$earliest_id)
		{
			return range($start_id, $end_id);
		}

		$sql = 'SELECT (t1.message_id + 1) AS start, (
			SELECT MIN(t3.message_id) - 1
			FROM ' . $this->mchat_table . ' t3
			WHERE t3.message_id > t1.message_id
		) AS end
		FROM ' . $this->mchat_table . ' t1
		WHERE t1.message_id > ' . (int) $earliest_id . ' AND NOT EXISTS (
			SELECT t2.message_id
			FROM ' . $this->mchat_table . ' t2
			WHERE t2.message_id = t1.message_id + 1
		)';

		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$missing_ids = array();

		if ($start_id < $earliest_id && !$this->config['mchat_edit_delete_limit'])
		{
			$missing_ids[] = range($start_id, $earliest_id - 1);
		}

		foreach ($rows as $row)
		{
			if ($row['end'])
			{
				$missing_ids[] = range($row['start'], $row['end']);
			}
			else
			{
				$latest_message = $row['start'] - 1;
				if ($end_id > $latest_message)
				{
					$missing_ids[] = range($latest_message + 1, $end_id);
				}
			}
		}

		// Flatten
		if (!empty($missing_ids))
		{
			$missing_ids = call_user_func_array('array_merge', $missing_ids);
		}

		return $missing_ids;
	}

	/**
	* Performs add|edit|del|clean|prune actions
	*/
	public function mchat_action($action, $sql_ary = null, $message_id = 0, $log_username = '')
	{
		switch ($action)
		{
			// User adds a message
			case 'add':
				$sql = 'INSERT INTO ' . $this->mchat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->mchat_add_user_session();
				break;
			// User edits a message
			case 'edit':
				$sql = 'UPDATE ' . $this->mchat_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . ' WHERE message_id = ' . (int) $message_id;
				$this->mchat_add_user_session();
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EDITED_MCHAT', false, array($log_username));
				break;
			// User deletes a message
			case 'del':
				$sql = 'DELETE FROM ' . $this->mchat_table . ' WHERE message_id = ' . (int) $message_id;
				$this->mchat_add_user_session();
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_DELETED_MCHAT', false, array($log_username));
				$this->cache->destroy('sql', $this->mchat_table);
				break;
			// Founder purges all messages
			case 'clean':
				$sql = 'TRUNCATE TABLE ' . $this->mchat_table;
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED');
				$this->cache->destroy('sql', $this->mchat_table);
				break;
			// User triggers messages to be pruned
			case 'prune':
				$sql = 'DELETE FROM ' . $this->mchat_table . ' WHERE message_id < ' . (int) $message_id;
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED');
				$this->cache->destroy('sql', $this->mchat_table);
				break;
			default:
				return;
		}

		$result = $this->db->sql_query($sql);

		if ($result !== false)
		{
			switch ($action)
			{
				case 'add':
					if ($this->db->sql_nextid() == 1)
					{
						$this->cache->destroy('sql', $this->mchat_table);
					}
					break;
			}
		}
	}
}
