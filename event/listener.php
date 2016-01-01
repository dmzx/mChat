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

	/** @var \dmzx\mchat\core\render_helper */
	protected $render_helper;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpEx;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\functions_mchat	$functions_mchat
	* @param \dmzx\mchat\core\render_helper		$render_helper
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\controller\helper			$controller_helper
	* @param \phpbb\template\template			$template
	* @param \phpbb\user						$user
	* @param string								$phpEx
	*/
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \dmzx\mchat\core\render_helper $render_helper, \phpbb\auth\auth $auth, \phpbb\controller\helper $controller_helper, \phpbb\template\template $template, \phpbb\user $user, $phpEx)
	{
		$this->functions_mchat		= $functions_mchat;
		$this->render_helper		= $render_helper;
		$this->auth					= $auth;
		$this->controller_helper	= $controller_helper;
		$this->template				= $template;
		$this->user					= $user;
		$this->phpEx				= $phpEx;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location'		=> 'add_page_viewonline',
			'core.user_setup'							=> 'load_language_on_setup',
			'core.page_header'							=> 'add_page_header_link',
			'core.index_modify_page_title'				=> 'display_mchat_on_index',
			'core.posting_modify_submit_post_after'		=> 'posting_modify_submit_post_after',
			'core.permissions'							=> 'permissions',
			'core.display_custom_bbcodes_modify_sql'	=> 'display_custom_bbcodes_modify_sql',
		);
	}

	public function add_page_viewonline($event)
	{
		if (strrpos($event['row']['session_page'], 'app.' . $this->phpEx . '/mchat') === 0)
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
		$allow_view = $this->auth->acl_get('u_mchat_view');
		$config_mchat = $allow_view ? $this->functions_mchat->mchat_cache() : array();
		$this->template->assign_vars(array(
			'MCHAT_ALLOW_VIEW'		=> $this->auth->acl_get('u_mchat_view'),
			'S_MCHAT_CUSTOM_PAGE'	=> !empty($config_mchat['custom_page']),
			'U_MCHAT'				=> $this->controller_helper->route('dmzx_mchat_controller'),
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
		$this->render_helper->render_data_for_page(true);
		$this->render_helper->assign_whois();
	}

	public function posting_modify_submit_post_after($event)
	{
		$this->functions_mchat->mchat_insert_posting($event['mode'], array(
			'forum_id'		=> $event['forum_id'],
			'forum_name'	=> $event['post_data']['forum_name'],
			'post_id'		=> $event['data']['post_id'],
			'post_subject'	=> $event['post_data']['post_subject'],
		));
	}

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

	public function display_custom_bbcodes_modify_sql($event)
	{
		// Add disallowed BBCodes to the template only if we're rendering for mChat
		if ($this->render_helper->is_mchat_rendered)
		{
			$disallowed_bbcode_array = $this->functions_mchat->get_disallowed_bbcodes();

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
