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
	/** @var \dmzx\mchat\core\functions_mchat */
	protected $functions_mchat;

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
	* @param \dmzx\mchat\core\functions_mchat	$functions_mchat
	* @param \dmzx\mchat\core\mchat				$mchat
	* @param \phpbb\controller\helper			$helper
	* @param \phpbb\user						$user
	* @param string								$php_ext
	*/
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \dmzx\mchat\core\mchat $mchat, \phpbb\controller\helper $helper, \phpbb\user $user, $php_ext)
	{
		$this->functions_mchat	= $functions_mchat;
		$this->mchat			= $mchat;
		$this->helper			= $helper;
		$this->user				= $user;
		$this->php_ext			= $php_ext;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location'		=> 'add_page_viewonline',
			'core.user_setup'							=> 'load_language_on_setup',
			'core.page_header'							=> 'display_mchat_on_index',
			'core.posting_modify_submit_post_after'		=> 'posting_modify_submit_post_after',
			'core.permissions'							=> 'permissions',
			'core.display_custom_bbcodes_modify_sql'	=> 'display_custom_bbcodes_modify_sql',
		);
	}

	/**
	*
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
	*
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
	* @return null
	* @access public
	*/
	public function add_page_header_link($event)
	{
		$this->mchat->render_page_header_link();
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
	$this->mchat->render_page_header_link();
	if ($this->user->page['page'] == "index.php")
		{
		$this->mchat->page_index();
		}
	if ($this->user->page['page'] == "app.php")
		{
		$this->mchat->page_index();
		}
	if ($this->user->page['page'] == "portal")
		{
		$this->mchat->page_index();
		}
	}

	/**
	*
	*/
	public function posting_modify_submit_post_after($event)
	{
		$this->functions_mchat->mchat_insert_posting($event['mode'], array(
			'forum_id'		=> $event['forum_id'],
			'forum_name'	=> $event['post_data']['forum_name'],
			'post_id'		=> $event['data']['post_id'],
			'post_subject'	=> $event['post_data']['post_subject'],
		));
	}

	/**
	*
	*/
	public function display_custom_bbcodes_modify_sql($event)
	{
		$event['sql_ary'] = $this->mchat->remove_disallowed_bbcodes($event['sql_ary']);
	}

	/**
	*
	*/
	public function permissions($event)
	{
		$event['permissions'] = array_merge($event['permissions'], array(
			'u_mchat_use'	=> array(
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
			'a_mchat'		=> array(
				'lang'		=> 'ACL_A_MCHAT',
				'cat'		=> 'mChat'
			),
		));

		$event['categories'] = array_merge($event['categories'], array(
			'mChat'	=> 'ACP_CAT_MCHAT',
		));
	}
}
