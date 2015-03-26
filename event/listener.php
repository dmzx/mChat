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

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	protected $phpbb_root_path;

	protected $phpEx;

	/** @var string */
	protected $table_prefix;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	public function __construct(\dmzx\mchat\core\render_helper $render_helper, \phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $controller_helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, $root_path, $phpEx, $table_prefix)
	{
		$this->render_helper = $render_helper;
		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
		$this->controller_helper = $controller_helper;
		$this->user = $user;
		$this->db = $db;
		$this->root_path = $root_path;
		$this->phpEx = $phpEx;
		$this->table_prefix = $table_prefix;

	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location'				  => 'add_page_viewonline',
			'core.user_setup'					=> 'load_language_on_setup',
			'core.page_header'					=> 'add_page_header_link',
			'core.index_modify_page_title'		=> 'display_mchat_on_index',
			'core.posting_modify_submit_post_after'	 => 'posting_modify_submit_post_after',
		);
	}

	public function add_page_viewonline($event)
	{
	global $user, $phpbb_container, $phpEx;

	   if (strrpos($event['row']['session_page'], 'app.' . $phpEx . '/chat') === 0)
	   {
		$event['location'] = $user->lang('MCHAT_TITLE');
		$event['location_url'] = $phpbb_container->get('controller.helper')->route('dmzx_mchat_controller');
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
			$sql = 'SELECT style_name
				FROM ' . STYLES_TABLE . '
				WHERE style_id = ' . $this->user->data['user_style'];
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);

			$this->template->assign_vars(array(
				'S_MCHAT_ON_INDEX' => true,
				'S_IS_NOT_PBTECH_STYLE' =>  $row['style_name'] != "PBTech" ? TRUE : FALSE,
			));

			$this->db->sql_freeresult($result);

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
			 else if ($event['mode'] == 'reply'&& (isset($this->config['mchat_new_posts_reply']) && $this->config['mchat_new_posts_reply']))
			 {
				$mchat_new_data = $this->user->lang['MCHAT_NEW_REPLY'];
			 }
			 else
			 {
				return;
			 }

	  // Data...
	  $message = utf8_normalize_nfc($mchat_new_data . ': [url=' . generate_board_url() . '/viewtopic.' . $this->phpEx . '?p=' . $event['data']['post_id'] . '#p' . $event['data']['post_id'] . ']' . $event['post_data']['post_subject'] . '[/url] in [url=' . generate_board_url() . '/viewforum.' . $this->phpEx . '?f=' . $event['forum_id'] . ']' . $event['post_data']['forum_name'] . ' Section[/url] ');

	  $uid = $bitfield = $options = ''; // will be modified by generate_text_for_storage
	  generate_text_for_storage($message, $uid, $bitfield, $options, true, false, false);
	  $sql_ary = array(
		 'forum_id'		 => $event['forum_id'],
		 'post_id'		 => $event['post_id'],
			'user_id'		 => $this->user->data['user_id'],
			'user_ip'		 => $this->user->data['session_ip'],
			'message'		 => $message,
			'bbcode_bitfield'   => $bitfield,
			'bbcode_uid'	   => $uid,
			'bbcode_options'	=> $options,
			'message_time'	   => time()
		  );
		  $sql = 'INSERT INTO ' .  $this->table_prefix . \dmzx\mchat\core\functions_mchat::MCHAT_TABLE  . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
		  $this->db->sql_query($sql);
   }

  }

}