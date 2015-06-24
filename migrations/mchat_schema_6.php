<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class mchat_schema_6 extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array(
			'\dmzx\mchat\migrations\mchat_schema_5',
		);
	}

	public function update_data()
	{
		return array(
			array('module.add', array('acp', 'ACP_CAT_USERS', array(
				'module_basename'	=> 'users',
				'module_enabled'	=> 1,
				'module_display'	=> 0,
				'module_langname'	=> 'ACP_USER_MCHAT',
				'module_mode'		=> 'mchat',
				'module_auth'		=> 'acl_a_user',
				),
			),
			// First, lets add a new category named UCP_CAT_MCHAT
			array('ucp', false, 'UCP_CAT_MCHAT'),

			// next let's add our module
			array('ucp', 'UCP_CAT_MCHAT', array(
					'module_basename'	=> 'mchat',
					'modes'				=> array('configuration'),
					'module_auth'		=> 'u_mchat_use',
				),
			),

		),
		);
	}
}