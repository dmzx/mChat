<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_schema_2 extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array(
			'\dmzx\mchat\migrations\mchat_schema',
		);
	}
	public function update_schema()
	{
		return array(
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
						'forum_id'			=> array('UINT', 0),
						'post_id'			=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'mchat',
			),
		);
	}
}