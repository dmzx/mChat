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
			),
			'add_tables'	=> array(
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
						'forum_id'          => array('UINT', 0),
			            'post_id'           => array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),
			),
			
			'add_columns'	=> array(
				$this->table_prefix . 'users'			=> array(
					'user_mchat_index' => array('BOOL', '1'),
					'user_mchat_sound' => array('BOOL', '1'),
					'user_mchat_stats_index' => array('BOOL', '1'),
					'user_mchat_topics' => array('BOOL', '1'),
					'user_mchat_avatars' => array('BOOL', '1'),
					'user_mchat_input_area' => array('BOOL', '1'),
				),
			),
			'add_tables'	=> array(
				$this->table_prefix . 'mchat_sessions'	=> array(
					'COLUMNS'	=> array(
						'user_id'			=> array('UINT', 0),
						'user_lastupdate'	=> array('TIMESTAMP', 0),
						'user_ip'			=> array('VCHAR:40', ''),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'mchat_config',
				$this->table_prefix . 'mchat',
				$this->table_prefix . 'mchat_sessions',
			),
		);
	}
}
