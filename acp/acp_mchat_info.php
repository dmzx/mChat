<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\acp;

class acp_mchat_info
{
	function module()
	{
		return array(
			'filename'	=> '\dmzx\mchat\acp\acp_mchat_module',
			'title'		=> 'ACP_CAT_MCHAT',
			'modes'		=> array(
				'configuration'		=> array(
					'title' => 'ACP_MCHAT_CONFIG',
					'auth' => 'ext_dmzx/mchat && acl_a_mchat',
					'cat' => array('ACP_CAT_MCHAT')
				),
			),
		);
	}
}