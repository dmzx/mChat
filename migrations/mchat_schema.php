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
			array(
				'custom', 
				array(
					array(
						$this,
						'insert_sample_data'
					)
				)
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
	
	public function insert_sample_data()
	{
		// Define sample rule data
		$sample_data = array(
			array(
				'config_name' 	=> 'refresh',
					'config_value'	=> '10',
				),
				array(			
					'config_name' 	=> 'message_limit',
					'config_value'	=> '10',
				),
				array(			
					'config_name' 	=> 'archive_limit',
					'config_value'	=> '25',
				),
				array(			
					'config_name' 	=> 'flood_time',
					'config_value'	=> '20',
				),
				array(			
					'config_name' 	=> 'max_message_lngth',
					'config_value'	=> '500',
				),
				array(			
					'config_name' 	=> 'custom_page',
					'config_value'	=> '1',
				),
				array(			
					'config_name' 	=> 'date',
					'config_value'	=> 'D M d, Y g:i a',
				),
				array(			
					'config_name' 	=> 'whois',
					'config_value'	=> '1',
				),	
				array(			
					'config_name' 	=> 'bbcode_disallowed',
					'config_value'	=> '',
			    ),
				array(			
					'config_name' 	=> 'prune_enable',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'prune_num',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'location',
					'config_value'	=> '1',
				),
				array(			
					'config_name' 	=> 'whois_refresh',
					'config_value'	=> '30',
				),
				array(			
					'config_name' 	=> 'static_message',
					'config_value'	=> '',
				),
				array(			
					'config_name' 	=> 'index_height',
					'config_value'	=> '250',
				),
				array(			
					'config_name' 	=> 'custom_height',
					'config_value'	=> '350',
				),
				array(			
					'config_name' 	=> 'override_min_post_chars',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'timeout',
					'config_value'	=> '0',
				),
				array(
					'config_name'	=> 'override_smilie_limit',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'pause_on_input',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'rules',
					'config_value'	=> '',
				),
				array(			
					'config_name' 	=> 'avatars',
					'config_value'	=> '0',
				),
				array(			
					'config_name' 	=> 'message_num',
					'config_value'	=> '10',
				),
		);

		// Insert sample PM data
		$this->db->sql_multi_insert($this->table_prefix . 'mchat_config', $sample_data);
	}
}
