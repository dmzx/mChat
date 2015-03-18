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

	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	protected $user;

	protected $db;

	protected $root_path;

	protected $php_ext;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	public function __construct(\dmzx\mchat\core\render_helper $render_helper, \phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $controller_helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\db\driver\driver_interface $db, $root_path, $php_ext)
	{
		$this->render_helper = $render_helper;
		$this->auth = $auth;
		$this->config = $config;
		$this->template = $template;
		$this->controller_helper = $controller_helper;
		$this->user = $user;
		$this->db = $db;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'					=> 'load_language_on_setup',
			'core.page_header'					=> 'add_page_header_link',
			'core.index_modify_page_title'		=> 'display_mchat_on_index',
		);
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
}