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
	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('mchat_enable', true)),
			array('config.add', array('mchat_on_index', true)),
			array('config.add', array('mchat_new_posts', false)),
			array('config.add', array('mchat_stats_index', false)),
			array('config.add', array('mchat_version','0.0.3')),
		);
	}
}