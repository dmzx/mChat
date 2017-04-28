<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\event;

use dmzx\mchat\core\functions;
use dmzx\mchat\core\settings;
use phpbb\auth\auth;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb\user;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class acp_listener implements EventSubscriberInterface
{
	/** @var template */
	protected $template;

	/** @var request_interface */
	protected $request;

	/** @var user */
	protected $user;

	/** @var settings */
	protected $settings;

	/** @var functions */
	protected $functions;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param template			$template
	* @param request_interface	$request
	* @param user				$user
	* @param settings			$settings
	* @param functions			$functions
	* @param string				$root_path
	* @param string				$php_ext
	*/
	public function __construct(
		template $template,
		request_interface $request,
		user $user,
		settings $settings,
		functions $functions,
		$root_path,
		$php_ext
	)
	{
		$this->template		= $template;
		$this->request		= $request;
		$this->user			= $user;
		$this->settings		= $settings;
		$this->functions	= $functions;
		$this->root_path	= $root_path;
		$this->php_ext		= $php_ext;
	}

	/**
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions'							=> 'permissions',
			'core.acp_users_prefs_modify_sql'			=> 'acp_users_prefs_modify_sql',
			'core.acp_users_prefs_modify_template_data'	=> 'acp_users_prefs_modify_template_data',
			'core.acp_users_overview_before'			=> 'acp_users_overview_before',
			'core.delete_user_after'					=> 'delete_user_after',
		);
	}

	/**
	 * @param Event $event
	 */
	public function permissions($event)
	{
		$ucp_configs = array();

		foreach (array_keys($this->settings->ucp_settings()) as $config_name)
		{
			$ucp_configs[] = 'u_' . $config_name;
		}

		$permission_categories = array(
			'mchat' => array(
				'u_mchat_use',
				'u_mchat_view',
				'u_mchat_edit',
				'u_mchat_delete',
				'u_mchat_moderator_edit',
				'u_mchat_moderator_delete',
				'u_mchat_ip',
				'u_mchat_pm',
				'u_mchat_like',
				'u_mchat_quote',
				'u_mchat_flood_ignore',
				'u_mchat_archive',
				'u_mchat_bbcode',
				'u_mchat_smilies',
				'u_mchat_urls',
				'a_mchat',
			),
			'mchat_user_config' => $ucp_configs,
		);

		$mchat_permissions = array();

		foreach ($permission_categories as $cat => $permissions)
		{
			foreach ($permissions as $permission)
			{
				$mchat_permissions[$permission] = array(
					'lang'	=> 'ACL_' . strtoupper($permission),
					'cat'	=> $cat,
				);
			}
		}

		$event['permissions'] = array_merge($event['permissions'], $mchat_permissions);

		$event['categories'] = array_merge($event['categories'], array(
			'mchat'				=> 'ACP_CAT_MCHAT',
			'mchat_user_config'	=> 'ACP_CAT_MCHAT_USER_CONFIG',
		));
	}

	/**
	 * @param Event $event
	 */
	public function acp_users_prefs_modify_sql($event)
	{
		$sql_ary = array();
		$validation = array();

		$user_id = $event['user_row']['user_id'];

		$auth = new auth();
		$userdata = $auth->obtain_user_data($user_id);
		$auth->acl($userdata);

		foreach ($this->settings->ucp_settings() as $config_name => $config_data)
		{
			if ($auth->acl_get('u_' . $config_name))
			{
				$default = $event['user_row']['user_' . $config_name];
				settype($default, gettype($config_data['default']));
				$sql_ary['user_' . $config_name] = $this->request->variable('user_' . $config_name, $default, is_string($default));

				if (isset($config_data['validation']))
				{
					$validation['user_' . $config_name] = $config_data['validation'];
				}
			}
		}

		if (!function_exists('validate_data'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$event['error'] = array_merge($event['error'], validate_data($sql_ary, $validation));
		$event['sql_ary'] = array_merge($event['sql_ary'], $sql_ary);
	}

	/**
	 * @param Event $event
	 */
	public function acp_users_prefs_modify_template_data($event)
	{
		$this->user->add_lang_ext('dmzx/mchat', array('mchat_acp', 'mchat_ucp'));

		$user_id = $event['user_row']['user_id'];

		$auth = new auth();
		$userdata = $auth->obtain_user_data($user_id);
		$auth->acl($userdata);

		$selected = $this->settings->cfg_user('mchat_date', $event['user_row'], $auth);
		$date_template_data = $this->settings->get_date_template_data($selected);
		$this->template->assign_vars($date_template_data);

		$notifications_template_data = $this->settings->get_enabled_post_notifications_lang();
		$this->template->assign_var('MCHAT_POSTS_ENABLED_LANG', $notifications_template_data);

		foreach (array_keys($this->settings->ucp_settings()) as $config_name)
		{
			$upper = strtoupper($config_name);
			$this->template->assign_vars(array(
				$upper				=> $this->settings->cfg_user($config_name, $event['user_row'], $auth),
				$upper . '_NOAUTH'	=> !$auth->acl_get('u_' . $config_name, $user_id),
			));
		}
	}

	/**
	 * @param Event $event
	 */
	public function acp_users_overview_before($event)
	{
		$this->user->add_lang_ext('dmzx/mchat', 'mchat_acp');

		$this->template->assign_vars(array(
			'L_RETAIN_POSTS'	=> $this->user->lang('MCHAT_RETAIN_MESSAGES', $this->user->lang('RETAIN_POSTS')),
			'L_DELETE_POSTS'	=> $this->user->lang('MCHAT_DELETE_MESSAGES', $this->user->lang('DELETE_POSTS')),
		));
	}

	/**
	 * @param Event $event
	 */
	public function delete_user_after($event)
	{
		if ($event['mode'] == 'remove')
		{
			$this->functions->mchat_prune($event['user_ids']);
		}
	}
}
