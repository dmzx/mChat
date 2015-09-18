<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_schema extends \phpbb\db\migration\migration
{
	var $ext_version = '0.1.4';

	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('mchat_enable', true)),
			array('config.add', array('mchat_on_index', true)),
			array('config.add', array('mchat_new_posts', false)),
			array('config.add', array('mchat_new_posts_topic', false)),
			array('config.add', array('mchat_new_posts_reply', false)),
			array('config.add', array('mchat_new_posts_edit', false)),
			array('config.add', array('mchat_new_posts_quote', false)),
			array('config.add', array('mchat_message_top', true)),
			array('config.add', array('mchat_stats_index', false)),
			array('config.add', array('mchat_version', $this->ext_version)),

			// Add permissions
			array('permission.add', array('u_mchat_use')),
			array('permission.add', array('u_mchat_view')),
			array('permission.add', array('u_mchat_edit')),
			array('permission.add', array('u_mchat_delete')),
			array('permission.add', array('u_mchat_ip')),
			array('permission.add', array('u_mchat_pm')),
			array('permission.add', array('u_mchat_like')),
			array('permission.add', array('u_mchat_quote')),
			array('permission.add', array('u_mchat_flood_ignore')),
			array('permission.add', array('u_mchat_archive')),
			array('permission.add', array('u_mchat_bbcode')),
			array('permission.add', array('u_mchat_smilies')),
			array('permission.add', array('u_mchat_urls')),
			array('permission.add', array('a_mchat')),

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
			array('permission.permission_set', array('REGISTERED', 'u_mchat_archive', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_bbcode', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_smilies', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_urls', 'group')),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'mchat_config'	=> array(
					'COLUMNS'	=> array(
						'config_name'		=> array('VCHAR', ''),
						'config_value'		=> array('VCHAR', ''),
					),
					'PRIMARY_KEY'	=> 'config_name',
				),

				$this->table_prefix . 'mchat'	=> array(
					'COLUMNS'	=> array(
						'message_id'		=> array('UINT', NULL, 'auto_increment'),
						'user_id'			=> array('UINT', 0),
						'user_ip'			=> array('VCHAR:40', ''),
						'message'			=> array('MTEXT_UNI', ''),
						'bbcode_bitfield'	=> array('VCHAR', ''),
						'bbcode_uid'		=> array('VCHAR:8', ''),
						'bbcode_options'	=> array('BOOL', '7'),
						'message_time'		=> array('INT:11', 0),
						'forum_id'			=> array('UINT', 0),
						'post_id'			=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),

				$this->table_prefix . 'mchat_sessions'	=> array(
					'COLUMNS'	=> array(
						'user_id'			=> array('UINT', 0),
						'user_lastupdate'	=> array('TIMESTAMP', 0),
						'user_ip'			=> array('VCHAR:40', ''),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),

			'add_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_mchat_index' 		=> array('BOOL', '1'),
					'user_mchat_sound' 		=> array('BOOL', '1'),
					'user_mchat_stats_index' => array('BOOL', '1'),
					'user_mchat_topics' 	=> array('BOOL', '1'),
					'user_mchat_avatars' 	=> array('BOOL', '1'),
					'user_mchat_input_area' => array('BOOL', '1'),
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
				$this->table_prefix . 'mchat_config',
			),

			'drop_columns' => array(
				$this->table_prefix . 'users'	=> array(
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