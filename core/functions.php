<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

use phpbb\auth\auth;
use phpbb\cache\driver\driver_interface as cache_interface;
use phpbb\db\driver\driver_interface as db_interface;
use phpbb\event\dispatcher_interface;
use phpbb\log\log_interface;
use phpbb\user;

class functions
{
	/** @var settings */
	protected $settings;

	/** @var user */
	protected $user;

	/** @var auth */
	protected $auth;

	/** @var log_interface */
	protected $log;

	/** @var db_interface */
	protected $db;

	/** @var cache_interface */
	protected $cache;

	/** @var dispatcher_interface */
	protected $dispatcher;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	protected $mchat_table;

	/** @var string */
	protected $mchat_log_table;

	/** @var string */
	protected $mchat_sessions_table;

	/** @var array */
	public $log_types = array(
		1 => 'edit',
		2 => 'del',
	);

	/**
	 * Value of the phpbb_mchat.post_id field for login notification
	 * messages if the user session is visible at the time of login
	 */
	const LOGIN_VISIBLE	= 1;

	/**
	 * Value of the phpbb_mchat.post_id field for login notification
	 * messages if the user session is hidden at the time of login
	 */
	const LOGIN_HIDDEN	= 2;

	/**
	* Constructor
	*
	* @param settings				$settings
	* @param user					$user
	* @param auth					$auth
	* @param log_interface			$log
	* @param db_interface			$db
	* @param cache_interface		$cache
	* @param dispatcher_interface	$dispatcher
	* @param string					$root_path
	* @param string					$php_ext
	* @param string					$mchat_table
	* @param string					$mchat_log_table
	* @param string					$mchat_sessions_table
	*/
	function __construct(
		settings $settings,
		user $user,
		auth $auth,
		log_interface $log,
		db_interface $db,
		cache_interface $cache,
		dispatcher_interface $dispatcher,
		$root_path,
		$php_ext,
		$mchat_table,
		$mchat_log_table,
		$mchat_sessions_table
	)
	{
		$this->settings				= $settings;
		$this->user					= $user;
		$this->auth					= $auth;
		$this->log					= $log;
		$this->db					= $db;
		$this->cache				= $cache;
		$this->dispatcher			= $dispatcher;
		$this->root_path			= $root_path;
		$this->php_ext				= $php_ext;
		$this->mchat_table			= $mchat_table;
		$this->mchat_log_table		= $mchat_log_table;
		$this->mchat_sessions_table	= $mchat_sessions_table;
	}

	/**
	 * Converts a number of seconds to a string in the format 'x hours y minutes z seconds'
	 *
	 * @param int $time
	 * @return string
	 */
	protected function mchat_format_seconds($time)
	{
		$times = array();

		$hours = floor($time / 3600);
		if ($hours)
		{
			$time -= $hours * 3600;
			$times[] = $this->user->lang('MCHAT_HOURS', $hours);
		}

		$minutes = floor($time / 60);
		if ($minutes)
		{
			$time -= $minutes * 60;
			$times[] = $this->user->lang('MCHAT_MINUTES', $minutes);
		}

		$seconds = ceil($time);
		if ($seconds)
		{
			$times[] = $this->user->lang('MCHAT_SECONDS', $seconds);
		}

		return $this->user->lang('MCHAT_ONLINE_EXPLAIN', implode('&nbsp;', $times));
	}

	/**
	 * Returns the total session time in seconds
	 *
	 * @return int
	 */
	protected function mchat_session_time()
	{
		$mchat_timeout = $this->settings->cfg('mchat_timeout');
		if ($mchat_timeout)
		{
			return $mchat_timeout;
		}

		$load_online_time = $this->settings->cfg('load_online_time');
		if ($load_online_time)
		{
			return $load_online_time * 60;
		}

		return $this->settings->cfg('session_length');
	}

	/**
	 * Returns data about users who are currently chatting
	 *
	 * @return array
	 */
	public function mchat_active_users()
	{
		$check_time = time() - $this->mchat_session_time();

		$sql_array = array(
			'SELECT'	=> 'u.user_id, u.username, u.user_colour, s.session_viewonline',
			'FROM'		=> array(
				$this->mchat_sessions_table => 'ms'
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(SESSIONS_TABLE => 's'),
					'ON'	=> 'ms.user_id = s.session_user_id',
				),
				array(
					'FROM'	=> array(USERS_TABLE => 'u'),
					'ON'	=> 'ms.user_id = u.user_id',
				),
			),
			'WHERE'		=> 'u.user_id <> ' . ANONYMOUS . ' AND s.session_viewonline IS NOT NULL AND ms.user_lastupdate > ' . (int) $check_time,
			'ORDER_BY'	=> 'u.username ASC',
		);

		/**
		 * Event to modify the SQL query that fetches active mChat users
		 *
		 * @event dmzx.mchat.active_users_sql_before
		 * @var array	sql_array	Array with SQL query data to fetch the current active sessions
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'sql_array',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.active_users_sql_before', compact($vars)));

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$mchat_users = array();
		$can_view_hidden = $this->auth->acl_get('u_viewonline');

		foreach ($rows as $row)
		{
			if (!$row['session_viewonline'])
			{
				if (!$can_view_hidden && $row['user_id'] !== $this->user->data['user_id'])
				{
					continue;
				}

				$row['username'] = '<em>' . $row['username'] . '</em>';
			}

			$mchat_users[$row['user_id']] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST'));
		}

		$active_users = array(
			'online_userlist'	=> implode($this->user->lang('COMMA_SEPARATOR'), $mchat_users),
			'users_count_title'	=> $this->user->lang('MCHAT_TITLE_COUNT', count($mchat_users)),
			'users_total'		=> $this->user->lang('MCHAT_ONLINE_USERS_TOTAL', count($mchat_users)),
			'refresh_message'	=> $this->mchat_format_seconds($this->mchat_session_time()),
		);

		/**
		 * Event to modify collected data about active mChat users
		 *
		 * @event dmzx.mchat.active_users_after
		 * @var array	mchat_users		Array containing all currently active mChat sessions, mapping from user ID to full username
		 * @var array	active_users	Array containing info about currently active mChat users
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'mchat_users',
			'active_users',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.active_users_after', compact($vars)));

		return $active_users;
	}

	/**
	 * Inserts the current user into the mchat_sessions table
	 *
	 * @return bool Returns true if a new session was created, otherwise false
	 */
	public function mchat_add_user_session()
	{
		if (!$this->user->data['is_registered'] || $this->user->data['user_id'] == ANONYMOUS || $this->user->data['is_bot'])
		{
			return false;
		}

		$sql = 'UPDATE ' . $this->mchat_sessions_table . '
			SET user_lastupdate = ' . time() . '
			WHERE user_id = ' . (int) $this->user->data['user_id'];
		$this->db->sql_query($sql);

		$is_new_session = $this->db->sql_affectedrows() < 1;

		if ($is_new_session)
		{
			$sql = 'INSERT INTO ' . $this->mchat_sessions_table . ' ' . $this->db->sql_build_array('INSERT', array(
				'user_id'			=> (int) $this->user->data['user_id'],
				'user_ip'			=> $this->user->data['user_ip'],
				'user_lastupdate'	=> time(),
			));
			$this->db->sql_query($sql);
		}

		return $is_new_session;
	}

	/**
	 * Remove expired sessions from the database
	 */
	public function mchat_session_gc()
	{
		$check_time = time() - $this->mchat_session_time();

		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . '
			WHERE user_lastupdate <= ' . (int) $check_time;
		$this->db->sql_query($sql);
	}

	/**
	 * Prune messages
	 *
	 * @param int|array $user_ids
	 * @return array
	 */
	public function mchat_prune($user_ids = array())
	{
		$prune_num = (int) $this->settings->cfg('mchat_prune_num');
		$prune_mode = (int) $this->settings->cfg('mchat_prune_mode');

		if (empty($this->settings->prune_modes[$prune_mode]))
		{
			return array();
		}

		$sql_array = array(
			'SELECT'	=> 'message_id',
			'FROM'		=> array($this->mchat_table => 'm'),
		);

		if ($user_ids)
		{
			if (!is_array($user_ids))
			{
				$user_ids = array($user_ids);
			}

			$sql_array['WHERE'] = $this->db->sql_in_set('m.user_id', $user_ids);
			$offset = 0;
		}
		else if ($this->settings->prune_modes[$prune_mode] === 'messages')
		{
			// Skip fixed number of messages, delete all others
			$sql_array['ORDER_BY'] = 'm.message_id DESC';
			$offset = $prune_num;
		}
		else
		{
			// Delete messages older than time period
			$sql_array['WHERE'] = 'm.message_time < ' . (int) strtotime($prune_num * $prune_mode . ' hours ago');
			$offset = 0;
		}

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, 0, $offset);
		$rows = $this->db->sql_fetchrowset();
		$this->db->sql_freeresult($result);

		$prune_ids = array();

		foreach ($rows as $row)
		{
			$prune_ids[] = (int) $row['message_id'];
		}

		/**
		 * Event to modify messages that are about to be pruned
		 *
		 * @event dmzx.mchat.prune_before
		 * @var array	prune_ids	Array of message IDs that are about to be pruned
		 * @var array	user_ids	Array of user IDs that are being pruned
		 * @since 2.0.0-RC6
		 * @changed 2.0.1 Added user_ids
		 */
		$vars = array(
			'prune_ids',
			'user_ids',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.prune_before', compact($vars)));

		if ($prune_ids)
		{
			$this->db->sql_query('DELETE FROM ' . $this->mchat_table . ' WHERE ' . $this->db->sql_in_set('message_id', $prune_ids));
			$this->db->sql_query('DELETE FROM ' . $this->mchat_log_table . ' WHERE ' . $this->db->sql_in_set('message_id', $prune_ids));
			$this->cache->destroy('sql', $this->mchat_log_table);

			// Only add a log entry if message pruning was not triggered by user pruning
			if (!$user_ids)
			{
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED', false, array($this->user->data['username'], count($prune_ids)));
			}
		}

		return $prune_ids;
	}

	/**
	 * Returns the total number of messages
	 *
	 * @return string
	 */
	public function mchat_total_message_count()
	{
		$sql_where_ary = $this->get_sql_where_for_notifcation_messages();

		$sql_array = array(
			'SELECT'	=> 'COUNT(*) AS rows_total',
			'FROM'		=> array($this->mchat_table => 'm'),
			'WHERE'		=> $sql_where_ary ? $this->db->sql_escape('(' . implode(') AND (', $sql_where_ary) . ')') : '',
		);

		/**
		 * Event to modifying the SQL query that fetches the total number of mChat messages
		 *
		 * @event dmzx.mchat.total_message_count_modify_sql
		 * @var array	sql_array	Array with SQL query data to fetch the total message count
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'sql_array',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.total_message_count_modify_sql', compact($vars)));

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);
		$rows_total = $this->db->sql_fetchfield('rows_total');
		$this->db->sql_freeresult($result);

		return (int) $rows_total;
	}

	/**
	 * Fetch messages from the database
	 *
	 * @param int|array $message_ids IDs of specific messages to fetch, e.g. for fetching edited messages
	 * @param int $last_id The ID of the latest message that the user has, for fetching new messages
	 * @param int $total
	 * @param int $offset
	 * @return array
	 */
	public function mchat_get_messages($message_ids, $last_id = 0, $total = 0, $offset = 0)
	{
		$sql_where_message_id = array();

		// Fetch new messages
		if ($last_id)
		{
			$sql_where_message_id[] = 'm.message_id > ' . (int) $last_id;
		}

		// Fetch edited messages
		if ($message_ids)
		{
			if (!is_array($message_ids))
			{
				$message_ids = array($message_ids);
			}

			$sql_where_message_id[] = $this->db->sql_in_set('m.message_id', array_map('intval', $message_ids));
		}

		$sql_where_ary = $this->get_sql_where_for_notifcation_messages();

		if ($sql_where_message_id)
		{
			$sql_where_ary[] = implode(' OR ', $sql_where_message_id);
		}

		$sql_array = array(
			'SELECT'	=> 'm.*, u.username, u.user_colour, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height, u.user_allow_pm, p.post_visibility',
			'FROM'		=> array($this->mchat_table	=> 'm'),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(USERS_TABLE => 'u'),
					'ON'	=> 'm.user_id = u.user_id',
				),
				array(
					'FROM'	=> array(POSTS_TABLE => 'p'),
					'ON'	=> 'm.post_id = p.post_id AND m.forum_id <> 0',
				),
			),
			'WHERE'		=> $sql_where_ary ? $this->db->sql_escape('(' . implode(') AND (', $sql_where_ary) . ')') : '',
			'ORDER_BY'	=> 'm.message_id DESC',
		);

		/**
		 * Event to modify the SQL query that fetches mChat messages
		 *
		 * @event dmzx.mchat.get_messages_modify_sql
		 * @var array	message_ids	IDs of specific messages to fetch, e.g. for fetching edited messages
		 * @var int		last_id		The ID of the latest message that the user has, for fetching new messages
		 * @var int		total		SQL limit
		 * @var int		offset		SQL offset
		 * @var	array	sql_array	Array containing the SQL query data
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'message_ids',
			'last_id',
			'total',
			'offset',
			'sql_array',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.get_messages_modify_sql', compact($vars)));

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $total, $offset);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		// Set deleted users to ANONYMOUS
		foreach ($rows as $i => $row)
		{
			if (!isset($row['username']))
			{
				$rows[$i]['user_id'] = ANONYMOUS;
			}
		}

		return $rows;
	}

	/**
	 * Generates SQL where conditions to include or exlude notifacation
	 * messages based on the current user's settings and permissions
	 *
	 * @return array
	 */
	protected function get_sql_where_for_notifcation_messages()
	{
		$sql_where_ary = array();

		if ($this->settings->cfg('mchat_posts'))
		{
			// If the current user doesn't have permission to see hidden users, exclude their login posts
			if (!$this->auth->acl_get('u_viewonline'))
			{
				$sql_where_ary[] = 'm.post_id <> ' . (int) self::LOGIN_HIDDEN .	// Exclude all notifications that were created by hidden users ...
					' OR m.user_id = ' . (int) $this->user->data['user_id'] .	// ... but include all login notifications of the current user
					' OR m.forum_id <> 0';										// ... and include all post notifications
			}
		}
		else
		{
			// Exclude all post notifications
			$sql_where_ary[] = 'm.post_id = 0';
		}

		return $sql_where_ary;
	}

	/**
	 * Fetches log entries from the database and sorts them
	 *
	 * @param int $log_id The ID of the latest log entry that the user has
	 * @return array
	 */
	public function mchat_get_logs($log_id)
	{
		$sql_array = array(
			'SELECT'	=> 'ml.*',
			'FROM'		=> array($this->mchat_log_table => 'ml'),
			'WHERE'		=> 'ml.log_id > ' . (int) $log_id,
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql, 3600);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$logs = array(
			'id' => $log_id,
		);

		foreach ($rows as $row)
		{
			$logs['id'] = max((int) $logs['id'], (int) $row['log_id']);
			$logs[] = $row;
		}

		return $logs;
	}

	/**
	 * Fetches the highest log ID
	 *
	 * @return int
	 */
	public function get_latest_log_id()
	{
		$sql_array = array(
			'SELECT'	=> 'ml.log_id',
			'FROM'		=> array($this->mchat_log_table => 'ml'),
			'ORDER_BY'	=> 'log_id DESC',
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, 1);
		$max_log_id = (int) $this->db->sql_fetchfield('log_id');
		$this->db->sql_freeresult($result);

		return $max_log_id;
	}

	/**
	 * Generates the user legend markup
	 *
	 * @return array Array of HTML markup for each group
	 */
	public function mchat_legend()
	{
		// Grab group details for legend display for who is online on the custom page
		$order_legend = $this->settings->cfg('legend_sort_groupname') ? 'group_name' : 'group_legend';

		$sql_array = array(
			'SELECT'	=> 'g.group_id, g.group_name, g.group_colour, g.group_type',
			'FROM'		=> array(GROUPS_TABLE => 'g'),
			'WHERE'		=> 'group_legend <> 0',
			'ORDER_BY'	=> 'g.' . $order_legend . ' ASC',
		);

		if ($this->auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel'))
		{
			$sql_array['LEFT_JOIN'] = array(
				array(
					'FROM'	=> array(USER_GROUP_TABLE => 'ug'),
					'ON'	=> 'g.group_id = ug.group_id AND ug.user_id = ' . (int) $this->user->data['user_id'] . ' AND ug.user_pending = 0',
				),
			);

			$sql_array['WHERE'] .= ' AND (g.group_type <> ' . GROUP_HIDDEN . ' OR ug.user_id = ' . (int) $this->user->data['user_id'] . ')';
		}

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
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
				$legend[] = '<a' . $colour_text . ' href="' . append_sid("{$this->root_path}memberlist.{$this->php_ext}", 'mode=group&amp;g='. $row['group_id']) . '">' . $group_name . '</a>';
			}
		}

		return $legend;
	}

	/**
	 * Returns a list of all foes of the current user
	 *
	 * @return array Array of user IDs
	 */
	public function mchat_foes()
	{
		$sql = 'SELECT zebra_id
			FROM ' . ZEBRA_TABLE . '
			WHERE foe = 1
				AND user_id = ' . (int) $this->user->data['user_id'];
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

	/**
	 * Fetches post subjects and their forum names
	 *
	 * @param array $post_ids
	 * @return array
	 */
	public function mchat_get_post_data($post_ids)
	{
		if (!$post_ids)
		{
			return array();
		}

		$sql = 'SELECT p.post_id, p.post_subject, f.forum_id, f.forum_name
				FROM ' . POSTS_TABLE . ' p, ' . FORUMS_TABLE . ' f
				WHERE p.forum_id = f.forum_id
					AND ' . $this->db->sql_in_set('p.post_id', $post_ids);

		$result = $this->db->sql_query($sql);
		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$post_subjects = array();

		foreach ($rows as $row)
		{
			$post_subjects[$row['post_id']] = array(
				'post_subject'	=> $row['post_subject'],
				'forum_id'		=> $row['forum_id'],
				'forum_name'	=> $row['forum_name'],
			);
		}

		// Handle deleted posts
		$non_existent_post_ids = array_diff($post_ids, array_keys($post_subjects));

		foreach ($non_existent_post_ids as $post_id)
		{
			$post_subjects[$post_id] = null;
		}

		return $post_subjects;
	}

	/**
	 * Adds forbidden BBCodes to the passed SQL where statement
	 *
	 * @param string $sql_where
	 * @return string
	 */
	public function mchat_sql_append_forbidden_bbcodes($sql_where)
	{
		$disallowed_bbcodes = explode('|', $this->settings->cfg('mchat_bbcode_disallowed'));

		if (!empty($disallowed_bbcodes))
		{
			$sql_where .= ' AND ' . $this->db->sql_in_set('b.bbcode_tag', $disallowed_bbcodes, true);
		}

		return $sql_where;
	}

	/**
	 * Inserts a message with posting information into the database
	 *
	 * @param string $mode One of post|quote|edit|reply|login
	 * @param int $forum_id
	 * @param int $post_id
	 * @param bool $is_hidden_login
	 */
	public function mchat_insert_posting($mode, $forum_id, $post_id, $is_hidden_login)
	{
		$mode_config = array(
			'post'	=> 'mchat_posts_topic',
			'quote'	=> 'mchat_posts_quote',
			'edit'	=> 'mchat_posts_edit',
			'reply'	=> 'mchat_posts_reply',
			'login' => 'mchat_posts_login',
		);

		$is_mode_enabled = !empty($mode_config[$mode]) && $this->settings->cfg($mode_config[$mode]);

		// Special treatment for login notifications
		if ($mode === 'login')
		{
			$forum_id = 0;
			$post_id = $is_hidden_login ? self::LOGIN_HIDDEN : self::LOGIN_VISIBLE;
		}

		$sql_array = array(
			'forum_id'			=> (int) $forum_id,
			'post_id'			=> (int) $post_id,
			'user_id'			=> (int) $this->user->data['user_id'],
			'user_ip'			=> $this->user->data['session_ip'],
			'message'			=> 'MCHAT_NEW_' . strtoupper($mode),
			'message_time'		=> time(),
		);

		/**
		 * Event that allows to modify data of a posting notification before it is inserted in the database
		 *
		 * @event dmzx.mchat.insert_posting_before
		 * @var string	mode			The posting mode, one of post|quote|edit|reply|login
		 * @var int		forum_id		The ID of the forum where the post was made, or 0 if mode is login.
		 * @var int		post_id			The ID of the post that was made. If mode is login this value is
		 * 								one of the constants LOGIN_HIDDEN|LOGIN_VISIBLE
		 * @var bool	is_hidden_login	Whether or not the user session is hidden. Only used if mode is login.
		 * @var array	is_mode_enabled	Whether or not the posting should be added to the database.
		 * @var array	sql_array		An array containing the data that is about to be inserted into the messages table.
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'mode',
			'forum_id',
			'post_id',
			'is_hidden_login',
			'is_mode_enabled',
			'sql_array',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.insert_posting_before', compact($vars)));

		if ($is_mode_enabled)
		{
			$sql = 'INSERT INTO ' .	$this->mchat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_array);
			$this->db->sql_query($sql);
		}
	}

	/**
	 * Checks if the current user is flooding the chat
	 *
	 * @return bool
	 */
	public function mchat_is_user_flooding()
	{
		if (!$this->settings->cfg('mchat_flood_time') || $this->auth->acl_get('u_mchat_flood_ignore'))
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

		return $message_time && time() - $message_time < $this->settings->cfg('mchat_flood_time');
	}

	/**
	 * Returns user ID & name of the specified message
	 *
	 * @param int $message_id
	 * @return array
	 */
	public function mchat_author_for_message($message_id)
	{
		$sql = 'SELECT m.user_id, m.message_time, m.post_id
			FROM ' . $this->mchat_table . ' m
			WHERE m.message_id = ' . (int) $message_id;
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row;
	}

	/**
	 * Performs AJAX actions
	 *
	 * @param string $action One of add|edit|del
	 * @param array $sql_ary
	 * @param int $message_id
	 * @return bool
	 */
	public function mchat_action($action, $sql_ary = null, $message_id = 0)
	{
		$update_session_infos = true;

		/**
		 * Event to modify the SQL query that adds, edits or deletes an mChat message
		 *
		 * @event dmzx.mchat.action_before
		 * @var	string	action					The action that is being performed, one of add|edit|del
		 * @var bool	sql_ary					Array containing SQL data, or null if a message is deleted
		 * @var int		message_id				The ID of the message that is being edited or deleted, or 0 if a message is added
		 * @var bool	update_session_infos	Whether or not to update the user session
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'action',
			'sql_ary',
			'message_id',
			'update_session_infos',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_before', compact($vars)));

		$is_new_session = false;

		switch ($action)
		{
			// User adds a message
			case 'add':
				if ($update_session_infos)
				{
					$this->user->update_session_infos();
				}
				$is_new_session = $this->mchat_add_user_session();
				$this->db->sql_query('INSERT INTO ' . $this->mchat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary));
				break;

			// User edits a message
			case 'edit':
				if ($update_session_infos)
				{
					$this->user->update_session_infos();
				}
				$is_new_session = $this->mchat_add_user_session();
				$this->db->sql_query('UPDATE ' . $this->mchat_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . ' WHERE message_id = ' . (int) $message_id);
				$this->mchat_insert_log('edit', $message_id);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EDITED_MCHAT', false, array($this->user->data['username']));
				break;

			// User deletes a message
			case 'del':
				if ($update_session_infos)
				{
					$this->user->update_session_infos();
				}
				$is_new_session = $this->mchat_add_user_session();
				$this->db->sql_query('DELETE FROM ' . $this->mchat_table . ' WHERE message_id = ' . (int) $message_id);
				$this->mchat_insert_log('del', $message_id);
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_DELETED_MCHAT', false, array($this->user->data['username']));
				break;
		}

		return $is_new_session;
	}

	/**
	 * @param string $log_type The log type, one of edit|del
	 * @param int $message_id The ID of the message to which this log entry belongs
	 * @return int The ID of the newly added log row
	 */
	public function mchat_insert_log($log_type, $message_id)
	{
		$this->db->sql_query('INSERT INTO ' . $this->mchat_log_table . ' ' . $this->db->sql_build_array('INSERT', array(
			'log_type'		=> array_search($log_type, $this->log_types),
			'user_id'		=> (int) $this->user->data['user_id'],
			'message_id'	=> (int) $message_id,
			'log_ip'		=> $this->user->ip,
			'log_time'		=> time(),
		)));

		$log_id = (int) $this->db->sql_nextid();

		$this->cache->destroy('sql', $this->mchat_log_table);

		return $log_id;
	}
}
