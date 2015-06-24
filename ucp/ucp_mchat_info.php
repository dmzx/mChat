<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\ucp;

class ucp_mchat_info
{
	function module()
	{
		return array(
			'filename'	=> '\dmzx\mchat\ucp\ucp_mchat_module',
			'title'		=> 'UCP_MCHAT_CONFIG',
			'version'	=> '1.3.8',
			'modes'		=> array(
				'configuration'	=> array(
					'title' => 'UCP_MCHAT_CONFIG',
					'auth' => 'ext_dmzx/mchat && acl_u_mchat_use',
					'cat' => array('UCP_MCHAT_CONFIG')),
			),
		);
	}
}