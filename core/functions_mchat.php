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
	protected $mchat_table;

	/** @var string */
	protected $mchat_config_table;

	/** @var string */
	protected $mchat_sessions_table;

	/**
	* Constructor
	*
	* @param \phpbb\template\template			$template
	* @param \phpbb\user						$user
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\log\log_interface			$log
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\cache\service				$cache
	* @param string								$mchat_table
	* @param string								$mchat_config_table
	* @param string								$mchat_sessions_table
	*/
	function __construct(\phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\log\log_interface $log, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, $mchat_table, $mchat_config_table, $mchat_sessions_table)
	{
		$this->template 			= $template;
		$this->user 				= $user;
		$this->auth 				= $auth;
		$this->log 					= $log;
		$this->db 					= $db;
		$this->cache 				= $cache;
		$this->mchat_table 			= $mchat_table;
		$this->mchat_config_table 	= $mchat_config_table;
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
			$chat_session .= $hours > 1 ? ($hours . '&nbsp;' . $this->user->lang['MCHAT_HOURS']) : ($hours . '&nbsp;' . $this->user->lang['MCHAT_HOUR']);
		}

		$minutes = floor($chat_timeout / 60);
		if ($minutes)
		{
			$minutes = $minutes > 1 ? ($minutes . '&nbsp;' . $this->user->lang['MCHAT_MINUTES']) : ($minutes . '&nbsp;' . $this->user->lang['MCHAT_MINUTE']);
			$chat_timeout = $chat_timeout - ($minutes * 60);
			$chat_session .= $minutes;
		}

		$seconds = ceil($chat_timeout);
		if ($seconds)
		{
			$seconds = $seconds > 1 ? ($seconds . '&nbsp;' . $this->user->lang['MCHAT_SECONDS']) : ($seconds . '&nbsp;' . $this->user->lang['MCHAT_SECOND']);
			$chat_session .= $seconds;
		}

		return sprintf($this->user->lang['MCHAT_ONLINE_EXPLAIN'], $chat_session);
	}

	/**
	* @param $session_time amount of time before a users session times out
	*/
	function mchat_users($session_time, $on_page)
	{
		$check_time = time() - (int) $session_time;

		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . '
			WHERE user_lastupdate < ' . $check_time;
		$this->db->sql_query($sql);

		// Add the user into the sessions upon first visit
		if ($on_page && ($this->user->data['user_id'] != ANONYMOUS && !$this->user->data['is_bot']))
		{
			$this->mchat_sessions($session_time);
		}

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
			$mchat_user_online_link = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']);
			$mchat_user_list .= ($mchat_user_list != '') ? $this->user->lang['COMMA_SEPARATOR'] . $mchat_user_online_link : $mchat_user_online_link;
		}

		$refresh_message = $this->mchat_session_time($session_time);

		if (!$mchat_user_count)
		{
			return array(
				'online_userlist'	=> '',
				'mchat_users_count'	=> $this->user->lang['MCHAT_NO_CHATTERS'],
				'refresh_message'	=> $refresh_message,
			);
		}
		else
		{
			return array(
				'online_userlist'	=> $mchat_user_list,
				'mchat_users_count'	=> $mchat_user_count > 1 ? sprintf($this->user->lang['MCHAT_ONLINE_USERS_TOTAL'], $mchat_user_count) : sprintf($this->user->lang['MCHAT_ONLINE_USER_TOTAL'], $mchat_user_count),
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
			WHERE user_lastupdate <' . $check_time;
		$this->db->sql_query($sql);

		// Insert user into the mChat sessions table
		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL)
		{
			$sql = 'SELECT *
				FROM ' . $this->mchat_sessions_table . '
				WHERE user_id =' . (int) $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			$sql_ary = array('user_lastupdate' => time());

			if ($row)
			{
				$sql = 'UPDATE ' . $this->mchat_sessions_table . '
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE user_id =' . (int) $this->user->data['user_id'];
			}
			else
			{
				$sql_ary['user_id'] = $this->user->data['user_id'];
				$sql = 'INSERT INTO ' . $this->mchat_sessions_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
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

		// From /includes/functions_display.php
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
}
