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
			// Adds permissions
		    array('permission.add', array('u_mchat_use')),
			array('permission.add', array('u_mchat_view')),
			array('permission.add', array('u_mchat_edit')),
			array('permission.add', array('u_mchat_delete')),
			array('permission.add', array('u_mchat_ip')),
			array('permission.add', array('u_mchat_flood_ignore')),
			array('permission.add', array('u_mchat_archive')),
			array('permission.add', array('u_mchat_bbcode')),
			array('permission.add', array('u_mchat_smilies')),
			array('permission.add', array('u_mchat_urls')),
			array('permission.add', array('a_mchat')),

			// Set permissions
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_use', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_view', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_edit', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_delete', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_ip', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_flood_ignore', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_archive', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_bbcode', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_smilies', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_urls', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_mchat', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_use', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_view', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_archive', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_bbcode', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_smilies', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_urls', 'group')),
		);
	}
}