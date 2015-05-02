<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\acp;

class acp_mchat_module
{

	public $u_action;

	public function main($id, $mode)
	{
		global $phpbb_container, $request, $user;

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('dmzx.mchat.admin.controller');

		// Requests
		$action = $request->variable('action', '');
		if ($request->is_set_post('add'))
		{
			$action = 'add';
		}

		// Add the wpm ACP lang file
		$user->add_lang_ext('dmzx/mchat', 'info_acp_mchat');

		// Load the display settings handle in the admin controller
		$admin_controller->display_options();

		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'acp_mchat';

		// Set the page title for our ACP page
		$this->page_title = 'MCHAT_TITLE';

		// Make the $u_action url available in the admin controller
		$admin_controller->set_page_url($this->u_action);

	}
}