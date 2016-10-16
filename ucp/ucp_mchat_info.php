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

class ucp_mchat_info
{
	function module()
	{
		global $config;

		return array(
			'filename'	=> '\dmzx\mchat\ucp\ucp_mchat_module',
			'title'		=> 'UCP_MCHAT_CONFIG',
			'version'	=> $config['mchat_version'],
			'modes'		=> array(
				'configuration'	=> array(
					'title' => 'UCP_MCHAT_CONFIG',
					'auth'	=> 'ext_dmzx/mchat && acl_u_mchat_view',
					'cat'	=> array('UCP_MCHAT_CONFIG'),
				),
			),
		);
	}
}
