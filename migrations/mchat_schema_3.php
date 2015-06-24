<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_schema_3 extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array(
			'\dmzx\mchat\migrations\mchat_schema_2',
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'insert_sample_data'))),
		);
	}

	public function insert_sample_data()
	{
		global $user;

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
					'config_value'	=> '0',
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
					'config_value'	=> '1',
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