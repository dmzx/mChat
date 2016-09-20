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
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/**
	 * Keys for global settings that only the administrator is allowed to modify.
	 * The values are stored in the phpbb_config table.
	 *
	 * @var array
	 */
	public $global;

	/**
	 * Keys for user-specific settings for which the administrator can set default
	 * values as well as adjust permissions to allow users to customize them.
	 * The values are stored in the phpbb_users table as well as the phpbb_config table.
	 * If a user has permission to customize a setting, the value in the phpbb_users
	 * table is used, otherwise the value in the phpbb_config table is used.
	 *
	 * @var array
	 */
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
	 */
	public function __construct(\phpbb\user $user, \phpbb\config\config $config, \phpbb\auth\auth $auth)
	{
		$this->user			= $user;
		$this->config		= $config;
		$this->auth			= $auth;

		$this->global = array(
			'mchat_bbcode_disallowed'		=> array('default' => '',	'validation' => array('string', false, 0, 255)),
			'mchat_custom_height'			=> array('default' => 350,	'validation' => array('num', false, 50, 1000)),
			'mchat_custom_page'				=> array('default' => 1),
			'mchat_edit_delete_limit'		=> array('default' => 0),
			'mchat_flood_time'				=> array('default' => 0,	'validation' => array('num', false, 0, 60)),
			'mchat_index_height'			=> array('default' => 250,	'validation' => array('num', false, 50, 1000)),
			'mchat_live_updates'			=> array('default' => 1),
			'mchat_max_message_lngth'		=> array('default' => 500,	'validation' => array('num', false, 0, 1000)),
			'mchat_message_num_archive'		=> array('default' => 25,	'validation' => array('num', false, 10, 100)),
			'mchat_message_num_custom'		=> array('default' => 10,	'validation' => array('num', false, 5, 50)),
			'mchat_message_num_index'		=> array('default' => 10,	'validation' => array('num', false, 5, 50)),
			'mchat_navbar_link'				=> array('default' => 1),
			'mchat_navbar_link_count'		=> array('default' => 1),
			'mchat_override_min_post_chars' => array('default' => 0),
			'mchat_override_smilie_limit'	=> array('default' => 0),
			'mchat_posts_edit'				=> array('default' => 0),
			'mchat_posts_quote'				=> array('default' => 0),
			'mchat_posts_reply'				=> array('default' => 0),
			'mchat_posts_topic'				=> array('default' => 0),
			'mchat_posts_login'				=> array('default' => 0),
			'mchat_prune'					=> array('default' => 0),
			'mchat_prune_num'				=> array('default' => '0'),
			'mchat_refresh'					=> array('default' => 10,	'validation' => array('num', false, 5, 60)),
			'mchat_rules'					=> array('default' => '',	'validation' => array('string', false, 0, 255)),
			'mchat_static_message'			=> array('default' => '',	'validation' => array('string', false, 0, 255)),
			'mchat_timeout'					=> array('default' => 0,	'validation' => array('num', false, 0, (int) $this->cfg('session_length'))),
			'mchat_whois_refresh'			=> array('default' => 60,	'validation' => array('num', false, 10, 300)),
		);

		$this->ucp = array(
			'mchat_avatars'					=> array('default' => 1),
			'mchat_capital_letter'			=> array('default' => 1),
			'mchat_character_count'			=> array('default' => 1),
			'mchat_date'					=> array('default' => 'D M d, Y g:i a', 'validation' => array('string', false, 0, 64)),
			'mchat_index'					=> array('default' => 1),
			'mchat_input_area'				=> array('default' => 1),
			'mchat_location'				=> array('default' => 1),
			'mchat_message_top'				=> array('default' => 1),
			'mchat_pause_on_input'			=> array('default' => 0),
			'mchat_posts'					=> array('default' => 1),
			'mchat_relative_time'			=> array('default' => 1),
			'mchat_sound'					=> array('default' => 1),
			'mchat_stats_index'				=> array('default' => 0),
			'mchat_whois_index'				=> array('default' => 1),
		);

		$this->is_phpbb31 = phpbb_version_compare(PHPBB_VERSION, '3.1.0@dev', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.2.0@dev', '<');
		$this->is_phpbb32 = phpbb_version_compare(PHPBB_VERSION, '3.2.0@dev', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.3.0@dev', '<');
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
	 * @param bool $volatile
	 */
	public function set_cfg($config, $value, $volatile = false)
	{
		if ($volatile)
		{
			$this->config[$config] = $value;
		}
		else
		{
			$this->config->set($config, $value);
		}
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

		foreach (array('topic', 'reply', 'quote', 'edit', 'login') as $notification)
		{
			if ($this->cfg('mchat_posts_' . $notification))
			{
				$enabled_notifications_lang[] = $this->user->lang('MCHAT_POSTS_' . strtoupper($notification));
			}
		}

		return implode($this->user->lang('COMMA_SEPARATOR'), $enabled_notifications_lang);
	}
}
