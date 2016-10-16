<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
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
		$user->add_lang_ext('dmzx/mchat', array('mchat_acp', 'mchat_ucp'));

		// Set template
		$this->tpl_name = 'acp_mchat_' . strtolower($mode);
		$this->page_title = 'MCHAT_ACP_' . strtoupper($mode) . '_TITLE';

		// Get an instance of the ACP controller and display the options
		$controller = $phpbb_container->get('dmzx.mchat.acp.controller');
		$controller->$mode($this->u_action);
	}
}
