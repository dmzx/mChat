<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	/** @var \dmzx\mchat\core\functions */
	protected $functions;

	/** @var \dmzx\mchat\core\mchat */
	protected $mchat;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\functions		$functions
	* @param \dmzx\mchat\core\mchat			$mchat
	* @param \phpbb\controller\helper		$helper
	* @param \phpbb\user					$user
	* @param string							$php_ext
	*/
	public function __construct(\dmzx\mchat\core\functions $functions, \dmzx\mchat\core\mchat $mchat, \phpbb\controller\helper $helper, \phpbb\user $user, $php_ext)
	{
		$this->functions	= $functions;
		$this->mchat		= $mchat;
		$this->helper		= $helper;
		$this->user			= $user;
		$this->php_ext		= $php_ext;
	}

	/**
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location'		=> 'add_page_viewonline',
			'core.user_setup'							=> 'load_language_on_setup',
			'core.page_header'							=> 'add_page_header_link',
			'core.index_modify_page_title'				=> 'display_mchat_on_index',
			'core.posting_modify_submit_post_after'		=> 'posting_modify_submit_post_after',
			'core.display_custom_bbcodes_modify_sql'	=> 'display_custom_bbcodes_modify_sql',
		);
	}

	/**
	 * @param object $event The event object
	 */
	public function add_page_viewonline($event)
	{
		if (strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/mchat') === 0)
		{
			$event['location'] = $this->user->lang('MCHAT_TITLE');
			$event['location_url'] = $this->helper->route('dmzx_mchat_controller');
		}
	}

	/**
	 * @param object $event The event object
	 */
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
	 */
	public function add_page_header_link($event)
	{
		$this->mchat->render_page_header_link();
	}

	/**
	 * Check if mchat should be displayed on index.
	 *
	 * @param object $event The event object
	 */
	public function display_mchat_on_index($event)
	{
		$this->mchat->page_index();
	}

	/**
	 * @param object $event The event object
	 */
	public function posting_modify_submit_post_after($event)
	{
		$this->functions->mchat_insert_posting($event['mode'], array(
			'forum_id'		=> $event['forum_id'],
			'forum_name'	=> $event['post_data']['forum_name'],
			'post_id'		=> $event['data']['post_id'],
			'post_subject'	=> $event['post_data']['post_subject'],
		));
	}

	/**
	 * @param object $event The event object
	 */
	public function display_custom_bbcodes_modify_sql($event)
	{
		$event['sql_ary'] = $this->mchat->remove_disallowed_bbcodes($event['sql_ary']);
	}
}
