<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_module extends \phpbb\db\migration\migration
{

	public function update_data()
	{
		return array(
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_CAT_MCHAT')),
			array('module.add', array(
				'acp', 'ACP_CAT_MCHAT', array(
				'module_basename'	=> '\dmzx\mchat\acp\acp_mchat_module',
				'modes'				=> array('configuration'),
				'module_auth'		=> 'a_mchat',
				),
			)),
		);
	}
}