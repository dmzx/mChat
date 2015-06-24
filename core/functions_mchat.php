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

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\cache\service */
	protected $cache;

	protected $table_prefix;

 	/**
	* The database tables
	*
	* @var string
	*/
	protected $mchat_table;

	protected $mchat_config_table;

	protected $mchat_sessions_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\user						$user
	 * @param \phpbb\auth\auth					$auth
	 * @param \phpbb\db\driver\driver_interface	$db
	 * @param \phpbb\cache\service				$cache
	 * @param									$table_prefix
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\log\log_interface $log, \phpbb\db\driver\driver_interface $db, \phpbb\cache\service $cache, $table_prefix, $mchat_table, $mchat_config_table, $mchat_sessions_table)
	{
		$this->template = $template;
		$this->user = $user;
		$this->auth = $auth;
		$this->db = $db;
		$this->cache = $cache;
		$this->phpbb_log = $log;
		$this->table_prefix = $table_prefix;
		$this->mchat_table = $mchat_table;
		$this->mchat_config_table = $mchat_config_table;
		$this->mchat_sessions_table = $mchat_sessions_table;
	}

	// mchat_cache
	/**
	 * builds the cache if it doesn't exist
	 */
	function mchat_cache()
	{
		// Grab the config entries in the ACP...and cache em :P
		if (($config_mchat = $this->cache->get('_mchat_config')) === false)
		{
			$sql = 'SELECT * FROM ' . $this->mchat_config_table;
			$result = $this->db->sql_query($sql);
			$config_mchat = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$config_mchat[$row['config_name']] = $row['config_value'];
			}
			$this->db->sql_freeresult($result);

			$this->cache->put('_mchat_config', $config_mchat);
		}
	}

	// mchat_user_fix
	/**
	 * @param $user_id the id of the user being deleted from the forum
	 *
	 */
	function mchat_user_fix($user_id)
	{
		$sql = 'UPDATE ' . $this->mchat_table . '
		SET user_id = ' . ANONYMOUS . '
		WHERE user_id = ' . (int) $user_id;
		$this->db->sql_query($sql);

		return;
	}

	// mchat_session_time
	/**
	 * @param $time the amount of time to display
	 *
	 */
	function mchat_session_time($time)
	{
		// fix the display of the time limit
		// hours, minutes, seconds
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

	// mchat_users
	/**
	 * @param $session_time amount of time before a users session times out
	 */
	function mchat_users($session_time, $on_page = false)
	{
		$check_time = time() - (int) $session_time;

		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . ' WHERE user_lastupdate < ' . $check_time;
		$this->db->sql_query($sql);

		// add the user into the sessions upon first visit
		if($on_page && ($this->user->data['user_id'] != ANONYMOUS && !$this->user->data['is_bot']))
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
		$can_view_hidden = $this->auth->acl_get('u_viewonline');
		while ($row = $this->db->sql_fetchrow($result))
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
		$this->db->sql_freeresult($result);

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

	// mchat_sessions
	/**
	 * @param mixed $session_time amount of time before a user is not shown as being in the chat
	 */
	function mchat_sessions($session_time)
	{
		$check_time = time() - (int) $session_time;
		$sql = 'DELETE FROM ' . $this->mchat_sessions_table . ' WHERE user_lastupdate <' . $check_time;
		$this->db->sql_query($sql);

		// insert user into the mChat sessions table
		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL)
		{
			$sql = 'SELECT * FROM ' . $this->mchat_sessions_table . ' WHERE user_id =' . (int) $this->user->data['user_id'];
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if (!$row)
			{
				$sql_ary = array(
					'user_id'			=> $this->user->data['user_id'],
					'user_lastupdate'	=> time(),
				);
				$sql = 'INSERT INTO ' . $this->mchat_sessions_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->db->sql_query($sql);
			}
			else
			{
				$sql_ary = array(
					'user_lastupdate'	=> time(),
				);
				$sql = 'UPDATE ' . $this->mchat_sessions_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . ' WHERE user_id =' . (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);
			}
		}
		return;
	}

	// mChat add-on Topic Notification
	/**
	 * @param mixed $post_id limits deletion to a post_id in the forum
	 */
	function mchat_delete_topic($post_id)
	{
		if (!isset($post_id) || empty($post_id))
		{
			return;
		}

		$sql = 'DELETE FROM ' . $this->mchat_table . ' WHERE post_id = ' . (int) $post_id;
		$this->db->sql_query($sql);

		return;
	}

	// mchat_prune
	// AutoPrune Chats
	/**
	 * @param mixed $mchat_prune_amount set from mchat config entry
	 */
	function mchat_prune($mchat_prune_amount)
	{
		// Run query to get the total message rows...
		$sql = 'SELECT COUNT(message_id) AS total_messages FROM ' . $this->mchat_table;
		$result = $this->db->sql_query($sql);
		$mchat_total_messages = (int) $this->db->sql_fetchfield('total_messages');
		$this->db->sql_freeresult($result);

		// count is below prune amount?
		// do nothing
		$prune = true;
		if ($mchat_total_messages <= $mchat_prune_amount)
		{
			$prune = false;
		}

		if ($prune)
		{

			$result = $this->db->sql_query_limit('SELECT * FROM '. $this->mchat_table . ' ORDER BY message_id ASC', 1);
			$row = $this->db->sql_fetchrow($result);
			$first_id = (int) $row['message_id'];

			$this->db->sql_freeresult($result);

			// compute the delete id
			$delete_id = $mchat_total_messages - $mchat_prune_amount + $first_id;

			// let's go delete them...if the message id is less than the delete id
			$sql = 'DELETE FROM ' . $this->mchat_table . '
			WHERE message_id < ' . (int) $delete_id;
			$this->db->sql_query($sql);

			$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_MCHAT_TABLE_PRUNED');

		}
		// free up some memory...variable(s) are no longer needed.
		unset($mchat_total_messages);

		// return to what we were doing
		return;

	}
	// display_mchat_bbcodes
	// can't use the default phpBB one but
	// most of code is from similar function
	/**
	 * @param mixed $mchat_prune_amount set from mchat config entry
	 */
	function display_mchat_bbcodes()
	{
		// grab the bbcodes that aren't allowed
		$config_mchat = $this->cache->get('_mchat_config');

		$disallowed_bbcode_array = explode('|', strtoupper($config_mchat['bbcode_disallowed']));
		preg_replace('#^(.*?)=#si','$1',$disallowed_bbcode_array);
		$default_bbcodes = array('b','i','u','quote','code','list','img','url','size','color','email','flash');

		// let's remove the default bbcodes
		if (sizeof($disallowed_bbcode_array))
		{
			foreach ($default_bbcodes as $default_bbcode)
			{
				$default_bbcode = strtoupper($default_bbcode);
				if (!in_array($default_bbcode, $disallowed_bbcode_array))
				{
					$this->template->assign_vars(array(
						'S_MCHAT_BBCODE_'.$default_bbcode => true,
					));
				}
			}
		}

		// now for the custom bbcodes
		// Start counting from 22 for the bbcode ids (every bbcode takes two ids - opening/closing)
		$num_predefined_bbcodes = 22;

		$sql = 'SELECT bbcode_id, bbcode_tag, bbcode_helpline
		FROM ' . BBCODES_TABLE . '
		WHERE display_on_posting = 1
		ORDER BY bbcode_tag';
		$result = $this->db->sql_query($sql);

		$i = 0;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcode_tag_name = strtoupper($row['bbcode_tag']);
			if (sizeof($disallowed_bbcode_array))
			{
				if (in_array($bbcode_tag_name, $disallowed_bbcode_array))
				{
					continue;
				}
			}
			// If the helpline is defined within the language file, we will use the localised version, else just use the database entry...
			if (isset($this->user->lang[strtoupper($row['bbcode_helpline'])]))
			{
				$row['bbcode_helpline'] = $this->user->lang[strtoupper($row['bbcode_helpline'])];
			}

			$this->template->assign_block_vars('custom_tags', array(
				'BBCODE_NAME'		=> "'[{$row['bbcode_tag']}]', '[/" . str_replace('=', '', $row['bbcode_tag']) . "]'",
				'BBCODE_ID'			=> $num_predefined_bbcodes + ($i * 2),
				'BBCODE_TAG'		=> $row['bbcode_tag'],
				'BBCODE_HELPLINE'	=> $row['bbcode_helpline'],
				'A_BBCODE_HELPLINE'	=> str_replace(array('&amp;', '&quot;', "'", '&lt;', '&gt;'), array('&', '"', "\'", '<', '>'), $row['bbcode_helpline']),
			));

			$i++;
		}
		$this->db->sql_freeresult($result);
	}
}