<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\migrations;

class acp_config extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('mchat_enable', true)),
			array('config.add', array('mchat_on_index', true)),
			array('config.add', array('mchat_new_posts', false)),
			array('config.add', array('mchat_new_posts_topic', false)),
			array('config.add', array('mchat_new_posts_reply', false)),
			array('config.add', array('mchat_new_posts_edit', false)),
			array('config.add', array('mchat_new_posts_quote', false)),
			array('config.add', array('mchat_message_top', true)),
			array('config.add', array('mchat_stats_index', false)),
			array('config.add', array('mchat_version', '0.0.13')),
			array('config.add', array('mchat_refresh', '10')),
			array('config.add', array('mchat_message_limit', '10')),
			array('config.add', array('mchat_archive_limit', '25')),
			array('config.add', array('mchat_flood_time', '20')),
			array('config.add', array('mchat_max_message_length', '500')),
			array('config.add', array('mchat_custom_page', '1')),
			array('config.add', array('mchat_date', 'D M d, Y g:i a')),
			array('config.add', array('mchat_whois', '1')),
			array('config.add', array('mchat_bbcode_disallowed', '')),
			array('config.add', array('mchat_prune_enable', '0')),
			array('config.add', array('mchat_prune_num', '0')),
			array('config.add', array('mchat_location', '1')),
			array('config.add', array('mchat_whois_refresh', '30')),
			array('config.add', array('mchat_static_message', '')),
			array('config.add', array('mchat_index_height', '250')),
			array('config.add', array('mchat_custom_height', '350')),
			array('config.add', array('mchat_override_min_post_chars', '0')),
			array('config.add', array('mchat_timeout', '0')),
			array('config.add', array('mchat_override_smilie_limit', '0')),
			array('config.add', array('mchat_pause_on_input', '0')),
			array('config.add', array('mchat_rules', '')),
			array('config.add', array('mchat_avatars', '0')),
			array('config.add', array('mchat_message_num', '10')),
		);
	}
}