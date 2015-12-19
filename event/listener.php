<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \dmzx\mchat\core\render_helper */
	protected $render_helper;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var string */
	protected $phpEx;

	/** @var string */
	protected $mchat_table;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\render_helper	$render_helper
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\config\config				$config
	* @param \phpbb\controller\helper			$controller_helper
	* @param \phpbb\template\template			$template
	* @param \phpbb\user						$user
	* @param \phpbb\db\driver\driver_interface	$db
	* @param string							$phpEx
	* @param string							$mchat_table
	*
	*/
	public function __construct(\dmzx\mchat\core\render_helper $render_helper, \phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $controller_helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, $phpEx, $mchat_table)
	{
		$this->render_helper 		= $render_helper;
		$this->auth 				= $auth;
		$this->config 				= $config;
		$this->template 			= $template;
		$this->controller_helper 	= $controller_helper;
		$this->user 				= $user;
		$this->db 					= $db;
		$this->phpEx 				= $phpEx;
		$this->mchat_table 			= $mchat_table;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location' 		=> 'add_page_viewonline',
			'core.user_setup'					 		=> 'load_language_on_setup',
			'core.page_header'					 		=> 'add_page_header_link',
			'core.index_modify_page_title'		 		=> 'display_mchat_on_index',
			'core.posting_modify_submit_post_after'		=> 'posting_modify_submit_post_after',
			'core.permissions'							=> 'permissions',
			'core.display_custom_bbcodes_modify_sql'	=> 'display_custom_bbcodes_modify_sql',
		);
	}

	public function add_page_viewonline($event)
	{
		if (strrpos($event['row']['session_page'], 'app.' . $this->phpEx . '/chat') === 0)
		{
			$event['location'] = $this->user->lang('MCHAT_TITLE');
			$event['location_url'] = $this->controller_helper->route('dmzx_mchat_controller');
		}
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'dmzx/mchat',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Create a URL to the mchat controller file for the header linklist
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function add_page_header_link($event)
	{
		$this->template->assign_vars(array(
			'U_MCHAT' => $this->controller_helper->route('dmzx_mchat_controller'),
		));
	}

	/**
	 * Check if mchat should be displayed on index.
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function display_mchat_on_index($event)
	{
		$mchat_on_index = $this->config['mchat_on_index'];
		$mchat_view	= ($this->auth->acl_get('u_mchat_view')) ? true : false;

		if ($mchat_on_index && $mchat_view)
		{
			$this->template->assign_var('S_MCHAT_ON_INDEX', true);

			$this->render_helper->render_data_for_page(true);
		}
	}

	public function posting_modify_submit_post_after($event)
	{
		// only trigger if mode is post
		$mchat_forums_allowed = array();
		if ($event['mode'] == 'post' || $event['mode'] == 'reply' || $event['mode'] == 'quote'|| $event['mode'] == 'edit' && (isset($this->config['mchat_enable']) && $this->config['mchat_enable']) && (isset($this->config['mchat_new_posts']) && $this->config['mchat_new_posts']))
		{

			if ($event['mode'] == 'post' && (isset($this->config['mchat_new_posts_topic']) && $this->config['mchat_new_posts_topic']))
			{
				$mchat_new_data = $this->user->lang['MCHAT_NEW_TOPIC'];
			}
			else if ($event['mode'] == 'quote' && (isset($this->config['mchat_new_posts_quote']) && $this->config['mchat_new_posts_quote']))
			{
				$mchat_new_data = $this->user->lang['MCHAT_NEW_QUOTE'];
			}
			else if ($event['mode'] == 'edit' && (isset($this->config['mchat_new_posts_edit']) && $this->config['mchat_new_posts_edit']))
			{
				$mchat_new_data = $this->user->lang['MCHAT_NEW_EDIT'];
			}
			else if ($event['mode'] == 'reply' && (isset($this->config['mchat_new_posts_reply']) && $this->config['mchat_new_posts_reply']))
			{
				$mchat_new_data = $this->user->lang['MCHAT_NEW_REPLY'];
			}
			else
			{
				return;
			}

			// Data...
			$message = utf8_normalize_nfc($mchat_new_data . ': [url=' . generate_board_url() . '/viewtopic.' . $this->phpEx . '?p=' . $event['data']['post_id'] . '#p' . $event['data']['post_id'] . ']' . $event['post_data']['post_subject'] . '[/url] '. $this->user->lang['MCHAT_IN'] .' [url=' . generate_board_url() . '/viewforum.' . $this->phpEx . '?f=' . $event['forum_id'] . ']' . $event['post_data']['forum_name']	. ' [/url] ' . $this->user->lang['MCHAT_IN_SECTION']);

			$uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
			generate_text_for_storage($message, $uid, $bitfield, $options, true, false, false);
			$sql_ary = array(
				'forum_id'		 	=> $event['forum_id'],
				'post_id'		 	=> $event['post_id'],
				'user_id'		 	=> $this->user->data['user_id'],
				'user_ip'		 	=> $this->user->data['session_ip'],
				'message'		 	=> $message,
				'bbcode_bitfield'	=> $bitfield,
				'bbcode_uid'		=> $uid,
				'bbcode_options'	=> $options,
				'message_time'		=> time(),
			);
			$sql = 'INSERT INTO ' .	$this->mchat_table	. ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
			$this->db->sql_query($sql);
		}
	}

	public function permissions($event)
	{
		$event['permissions'] = array_merge($event['permissions'], array(
			'u_mchat_use'		=> array(
				'lang'		=> 'ACL_U_MCHAT_USE',
				'cat'		=> 'mChat'
			),
			'u_mchat_view'	=> array(
				'lang'		=> 'ACL_U_MCHAT_VIEW',
				'cat'		=> 'mChat'
			),
			'u_mchat_edit'	=> array(
				'lang'		=> 'ACL_U_MCHAT_EDIT',
				'cat'		=> 'mChat'
			),
			'u_mchat_delete'	=> array(
				'lang'		=> 'ACL_U_MCHAT_DELETE',
				'cat'		=> 'mChat'
			),
			'u_mchat_ip'	=> array(
				'lang'		=> 'ACL_U_MCHAT_IP',
				'cat'		=> 'mChat'
			),
			'u_mchat_pm'	=> array(
				'lang'		=> 'ACL_U_MCHAT_PM',
				'cat'		=> 'mChat'
			),
			'u_mchat_like'	=> array(
				'lang'		=> 'ACL_U_MCHAT_LIKE',
				'cat'		=> 'mChat'
			),
			'u_mchat_quote'	=> array(
				'lang'		=> 'ACL_U_MCHAT_QUOTE',
				'cat'		=> 'mChat'
			),
			'u_mchat_flood_ignore'	=> array(
				'lang'		=> 'ACL_U_MCHAT_FLOOD_IGNORE',
				'cat'		=> 'mChat'
			),
			'u_mchat_archive'	=> array(
				'lang'		=> 'ACL_U_MCHAT_ARCHIVE',
				'cat'		=> 'mChat'
			),
			'u_mchat_bbcode'	=> array(
				'lang'		=> 'ACL_U_MCHAT_BBCODE',
				'cat'		=> 'mChat'
			),
			'u_mchat_smilies'	=> array(
				'lang'		=> 'ACL_U_MCHAT_SMILIES',
				'cat'		=> 'mChat'
			),
			'u_mchat_urls'	=> array(
				'lang'		=> 'ACL_U_MCHAT_URLS',
				'cat'		=> 'mChat'
			),
			'a_mchat'	=> array(
				'lang'		=> 'ACL_A_MCHAT',
				'cat'		=> 'mChat'
			),
		));

		$event['categories'] = array_merge($event['categories'], array(
			'mChat'	=> 'ACP_CAT_MCHAT',
		));
	}

	public function display_custom_bbcodes_modify_sql($event)
	{
		// Prevent disallowed BBCodes from being added to the template only if we're rendering for mChat
		if ($this->render_helper->initialized)
		{
			$disallowed_bbcode_array = $this->render_helper->get_disallowed_bbcodes();

			if (!empty($disallowed_bbcode_array))
			{
				$disallowed_bbcode_array = array_map('strtoupper', $disallowed_bbcode_array);
				$sql_ary = $event['sql_ary'];
				$sql_ary['WHERE'] .= " AND UPPER(b.bbcode_tag) NOT IN ('" . implode("','", $disallowed_bbcode_array) . "')";
				$event['sql_ary'] = $sql_ary;
			}
		}
	}
}
