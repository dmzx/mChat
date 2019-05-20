<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2018 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\migrations;

use phpbb\db\migration\migration;

class mchat_2_1_3_rc1 extends migration
{
	public static function depends_on()
	{
		return [
			'\dmzx\mchat\migrations\mchat_2_1_2',
		];
	}

	public function update_data()
	{
		return [
            ['config.update', ['mchat_version', '2.1.3-rc1']],

			['config.add', ['mchat_footer', 0]],
			['config.add', ['mchat_message_num_footer', 10]],

			['permission.add', ['u_mchat_footer', true]],
			['permission.permission_set', ['REGISTERED', 'u_mchat_footer', 'group']],
		];
	}

	public function update_schema()
	{
		return [
			'add_columns' => [
				$this->table_prefix . 'users' => [
					'user_mchat_footer'				=> ['BOOL', 0]
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_columns' => [
				$this->table_prefix . 'users' => [
					'user_mchat_footer'
				],
			],
		];
	}
}
