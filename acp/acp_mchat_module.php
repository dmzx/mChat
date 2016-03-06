<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\acp;

class acp_mchat_module
{
	public $u_action;

	public function main($id, $mode)
	{
		global $phpbb_container, $user;

		// Add the ACP lang file
		$user->add_lang_ext('dmzx/mchat', 'mchat_acp');

		// Set template
		$this->tpl_name = 'acp_mchat';
		$this->page_title = 'MCHAT_ACP_TITLE';

		// Get an instance of the ACP controller and display the options
		$controller = $phpbb_container->get('dmzx.mchat.acp.controller');
		$controller->display_options($this->u_action);
	}
}
