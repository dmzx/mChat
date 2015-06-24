<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_module1 extends \phpbb\db\migration\migration
{

	public function update_data()
	{
		return array(
			array('module.add', array('ucp', 'UCP_MAIN', 'UCP_MCHAT_CONFIG')),
			array('module.add', array(
				'ucp', 'UCP_MCHAT_CONFIG',		array(
				'module_basename'	=> '\dmzx\mchat\ucp\ucp_mchat_module',
				'modes'				=> array('configuration'),
				'module_auth'		=> 'acl_u_mchat_use',
			))),
		);
	}
}	