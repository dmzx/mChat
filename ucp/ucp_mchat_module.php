<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\ucp;

class ucp_mchat_module
{
	public $u_action;

	public function main($id, $mode)
	{
		global $phpbb_container, $user;

		// Add the UCP lang file
		$user->add_lang_ext('dmzx/mchat', 'mchat_ucp');

		// Set template
		$this->tpl_name = 'ucp_mchat';
		$this->page_title = 'UCP_MCHAT_CONFIG';

		// Get an instance of the UCP controller and display the options
		$controller = $phpbb_container->get('dmzx.mchat.ucp.controller');
		$controller->$mode($this->u_action);
	}
}
