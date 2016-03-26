<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

class settings
{
	const VALIDATE_TYPE = 0;
	const VALIDATE_IS_OPTIONAL = 1;
	const VALIDATE_MIN_VALUE = 2;
	const VALIDATE_MAX_VALUE = 3;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var array */
	public $global;

	/** @var array */
	public $ucp;

	/** @var bool */
	public $is_phpbb31;

	/** @var bool */
	public $is_phpbb32;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user			$user
	 * @param \phpbb\config\config	$config
	 * @param \phpbb\auth\auth		$auth
	 * @param array					$global
	 * @param array					$ucp
	 */
	public function __construct(\phpbb\user $user, \phpbb\config\config $config, \phpbb\auth\auth $auth, $global, $ucp)
	{
		$this->user			= $user;
		$this->config		= $config;
		$this->auth			= $auth;
		$this->global		= $global;
		$this->ucp			= $ucp;

		$this->is_phpbb31	= phpbb_version_compare($config['version'], '3.1.0@dev', '>=') && phpbb_version_compare($config['version'], '3.2.0@dev', '<');
		$this->is_phpbb32	= phpbb_version_compare($config['version'], '3.2.0@dev', '>=') && phpbb_version_compare($config['version'], '3.3.0@dev', '<');

		$this->inject_core_config_values();
	}

	/**
	 * Writes phpBB config values into the mChat config for validating input data
	 */
	protected function inject_core_config_values()
	{
		// Limit mChat session timeout to phpBB session length
		$this->global['mchat_timeout']['validation'][self::VALIDATE_MAX_VALUE] = (int) $this->cfg('session_length');
	}

	/**
	 * @param string $config
	 * @param bool $force_global
	 * @return string
	 */
	public function cfg($config, $force_global = false)
	{
		return $this->cfg_user($config, $this->user->data, $this->auth, $force_global);
	}

	/**
	 * @param string $config
	 * @param array $user_data
	 * @param \phpbb\auth\auth $auth
	 * @param bool $force_global
	 * @return string
	 */
	public function cfg_user($config, $user_data, $auth, $force_global = false)
	{
		if (!$force_global && isset($this->ucp[$config]) && $auth->acl_get('u_' . $config))
		{
			return $user_data['user_' . $config];
		}

		return $this->config[$config];
	}

	/**
	 * @param $config
	 * @param $value
	 */
	public function set_cfg($config, $value)
	{
		$this->config->set($config, $value);
	}

	/**
	 * @param string $selected
	 * @return array
	 */
	public function get_date_template_data($selected)
	{
		$dateformat_options = '';

		foreach ($this->user->lang['dateformats'] as $format => $null)
		{
			$dateformat_options .= '<option value="' . $format . '"' . (($format == $selected) ? ' selected="selected"' : '') . '>';
			$dateformat_options .= $this->user->format_date(time(), $format, false) . ((strpos($format, '|') !== false) ? $this->user->lang('VARIANT_DATE_SEPARATOR') . $this->user->format_date(time(), $format, true) : '');
			$dateformat_options .= '</option>';
		}

		$s_custom = false;

		$dateformat_options .= '<option value="custom"';
		if (!isset($this->user->lang['dateformats'][$selected]))
		{
			$dateformat_options .= ' selected="selected"';
			$s_custom = true;
		}
		$dateformat_options .= '>' . $this->user->lang('MCHAT_CUSTOM_DATEFORMAT') . '</option>';

		return array(
			'S_MCHAT_DATEFORMAT_OPTIONS'	=> $dateformat_options,
			'A_MCHAT_DEFAULT_DATEFORMAT'	=> addslashes($this->ucp['mchat_date']['default']),
			'S_MCHAT_CUSTOM_DATEFORMAT'		=> $s_custom,
		);
	}

	/**
	 * @return string
	 */
	public function get_enabled_post_notifications_lang()
	{
		$enabled_notifications_lang = array();

		foreach (array('topic', 'reply', 'quote', 'edit') as $notification)
		{
			if ($this->cfg('mchat_posts_' . $notification))
			{
				$enabled_notifications_lang[] = $this->user->lang('MCHAT_POSTS_' . strtoupper($notification));
			}
		}

		return implode($this->user->lang('COMMA_SEPARATOR'), $enabled_notifications_lang);
	}
}
