<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_schema_4 extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array(
			'\dmzx\mchat\migrations\mchat_schema_3',
		);
	}

	public function update_schema()
	{
		return array(
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
		);
	}

	public function revert_schema()
	{
		return array(
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