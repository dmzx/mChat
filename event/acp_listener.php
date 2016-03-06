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

class acp_listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var array */
	protected $user_config_keys;

	/**
	* Constructor
	*
	* @param \phpbb\template\template			$template
	* @param \phpbb\request\request				$request
	* @param \phpbb\user						$user
	* @param array								$user_config_keys
	*/
	public function __construct(\phpbb\template\template $template, \phpbb\request\request $request, \phpbb\user $user, $user_config_keys)
	{
		$this->template			= $template;
		$this->request			= $request;
		$this->user				= $user;
		$this->user_config_keys	= $user_config_keys;
	}

	/**
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions'							=> 'permissions',
			'core.acp_users_prefs_modify_data'			=> 'acp_users_prefs_modify_data',
			'core.acp_users_prefs_modify_sql'			=> 'acp_users_prefs_modify_sql',
			'core.acp_users_prefs_modify_template_data'	=> 'acp_users_prefs_modify_template_data',
		);
	}

	/**
	 * @param object $event The event object
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

	/**
	 * @param object $event The event object
	 */
	public function acp_users_prefs_modify_data($event)
	{
		$data = $event['data'];

		foreach ($this->user_config_keys as $config_key)
		{
			$data[$config_key] = $this->request->variable($config_key, (int) $event['user_row'][$config_key]);
		}

		$event['data'] = $data;
	}

	/**
	 * @param object $event The event object
	 */
	public function acp_users_prefs_modify_template_data($event)
	{
		$this->user->add_lang_ext('dmzx/mchat', 'mchat_ucp');

		foreach ($this->user_config_keys as $config_key)
		{
			$this->template->assign_var(strtoupper($config_key), $event['data'][$config_key]);
		}
	}

	/**
	 * @param object $event The event object
	 */
	public function acp_users_prefs_modify_sql($event)
	{
		$sql_ary = $event['sql_ary'];

		foreach ($this->user_config_keys as $config_key)
		{
			$sql_ary[$config_key] = $event['data'][$config_key];
		}

		$event['sql_ary'] = $sql_ary;
	}
}
