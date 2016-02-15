<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\migrations;

class install_mchat extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['mchat_version']) && version_compare($this->config['mchat_version'], '1.0.0-RC1', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v311');
	}

	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('mchat_version', '1.0.0-RC1')),
			array('config.add', array('mchat_archive_limit', 25)),
			array('config.add', array('mchat_avatars', 1)),
			array('config.add', array('mchat_bbcode_disallowed', '')),
			array('config.add', array('mchat_custom_height', 350)),
			array('config.add', array('mchat_custom_page', 1)),
			array('config.add', array('mchat_date', 'D M d, Y g:i a')),
			array('config.add', array('mchat_edit_delete_limit', 0)),
			array('config.add', array('mchat_flood_time', 0)),
			array('config.add', array('mchat_index_height', 250)),
			array('config.add', array('mchat_live_updates', 1)),
			array('config.add', array('mchat_location', 0)),
			array('config.add', array('mchat_max_message_lngth', 500)),
			array('config.add', array('mchat_message_limit', 10)),
			array('config.add', array('mchat_message_num', 10)),
			array('config.add', array('mchat_message_top', 1)),
			array('config.add', array('mchat_new_posts_edit', 0)),
			array('config.add', array('mchat_new_posts_quote', 0)),
			array('config.add', array('mchat_new_posts_reply', 0)),
			array('config.add', array('mchat_new_posts_topic', 0)),
			array('config.add', array('mchat_on_index', 1)),
			array('config.add', array('mchat_override_min_post_chars', 0)),
			array('config.add', array('mchat_override_smilie_limit', 0)),
			array('config.add', array('mchat_pause_on_input', 0)),
			array('config.add', array('mchat_prune', 0)),
			array('config.add', array('mchat_prune_num', 0)),
			array('config.add', array('mchat_refresh', 10)),
			array('config.add', array('mchat_rules', '')),
			array('config.add', array('mchat_static_message', '')),
			array('config.add', array('mchat_stats_index', 0)),
			array('config.add', array('mchat_timeout', 0)),
			array('config.add', array('mchat_whois', 1)),
			array('config.add', array('mchat_whois_refresh', 60)),

			// Add permissions
			array('permission.add', array('u_mchat_use', true)),
			array('permission.add', array('u_mchat_view', true)),
			array('permission.add', array('u_mchat_edit', true)),
			array('permission.add', array('u_mchat_delete', true)),
			array('permission.add', array('u_mchat_ip', true)),
			array('permission.add', array('u_mchat_pm', true)),
			array('permission.add', array('u_mchat_like', true)),
			array('permission.add', array('u_mchat_quote', true)),
			array('permission.add', array('u_mchat_flood_ignore', true)),
			array('permission.add', array('u_mchat_archive', true)),
			array('permission.add', array('u_mchat_bbcode', true)),
			array('permission.add', array('u_mchat_smilies', true)),
			array('permission.add', array('u_mchat_urls', true)),
			array('permission.add', array('a_mchat', true)),

			// Set permissions
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_use', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_view', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_edit', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_delete', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_ip', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_pm', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_like', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_quote', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_flood_ignore', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_archive', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_bbcode', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_smilies', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_urls', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_mchat', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_use', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_view', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_pm', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_like', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_quote', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_archive', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_bbcode', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_smilies', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_urls', 'group')),

			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_CAT_MCHAT'
			)),

			array('module.add', array(
				'acp',
				'ACP_CAT_MCHAT',
				array(
					'module_basename'			=> '\dmzx\mchat\acp\acp_mchat_module',
					'modes'						=> array('configuration'),
					'module_auth'				=> 'a_mchat',
				),
			)),

			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_USERS',
				array(
					'module_basename'			=> 'users',
					'module_enabled'			=> 1,
					'module_display'			=> 0,
					'module_langname'			=> 'ACP_USER_MCHAT',
					'module_mode'				=> 'mchat',
					'module_auth'				=> 'acl_a_user',
					),
				),

				// First, lets add a new category named UCP_CAT_MCHAT
				array(
					'ucp',
					false,
					'UCP_CAT_MCHAT'
				),

				// next let's add our module
				array(
					'ucp',
					'UCP_CAT_MCHAT',
					array(
						'module_basename'		=> 'mchat',
						'modes'					=> array('configuration'),
						'module_auth'			=> 'u_mchat_use',
					),
				),
			),

			// Add UCP module
			array('module.add', array(
				'ucp',
				false,
				'UCP_MCHAT_CONFIG'
			)),

			array('module.add', array(
				'ucp',
				'UCP_MCHAT_CONFIG',
				array(
					'module_basename'			=> '\dmzx\mchat\ucp\ucp_mchat_module',
					'modes'						=> array('configuration'),
					'auth'						=> 'acl_u_mchat_use',
				),
			)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'mchat'	=> array(
					'COLUMNS'		=> array(
						'message_id'			=> array('UINT', null, 'auto_increment'),
						'user_id'				=> array('UINT', 0),
						'user_ip'				=> array('VCHAR:40', ''),
						'message'				=> array('MTEXT_UNI', ''),
						'bbcode_bitfield'		=> array('VCHAR', ''),
						'bbcode_uid'			=> array('VCHAR:8', ''),
						'bbcode_options'		=> array('BOOL', '7'),
						'message_time'			=> array('INT:11', 0),
						'edit_time'				=> array('INT:11', 0),
						'forum_id'				=> array('UINT', 0),
						'post_id'				=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),

				$this->table_prefix . 'mchat_sessions'	=> array(
					'COLUMNS'		=> array(
						'user_id'				=> array('UINT', 0),
						'user_lastupdate'		=> array('TIMESTAMP', 0),
						'user_ip'				=> array('VCHAR:40', ''),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),

			'add_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_mchat_index' 			=> array('BOOL', '1'),
					'user_mchat_sound' 			=> array('BOOL', '1'),
					'user_mchat_stats_index'	=> array('BOOL', '1'),
					'user_mchat_topics' 		=> array('BOOL', '1'),
					'user_mchat_avatars' 		=> array('BOOL', '1'),
					'user_mchat_input_area'		=> array('BOOL', '1'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'mchat',
				$this->table_prefix . 'mchat_sessions',
			),

			'drop_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_mchat_index',
					'user_mchat_sound',
					'user_mchat_stats_index',
					'user_mchat_topics',
					'user_mchat_avatars',
					'user_mchat_input_area',
				),
			),
		);
	}
}
