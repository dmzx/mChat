<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, array(
	'MCHAT_TITLE'					=> 'mChat',

	// Who is chatting
	'MCHAT_WHO_IS_CHATTING'			=> 'Who is chatting',
	'MCHAT_ONLINE_USERS_TOTAL'		=> array(
		0 => 'No one is chatting',
		1 => 'There is <strong>%1$d</strong> user chatting',
		2 => 'There are <strong>%1$d</strong> users chatting',
	),
	'MCHAT_ONLINE_EXPLAIN'			=> 'based on users active over the past %1$s',
	'MCHAT_HOURS'					=> array(
		1 => '%1$d hour',
		2 => '%1$d hours',
	),
	'MCHAT_MINUTES'					=> array(
		1 => '%1$d minute',
		2 => '%1$d minutes',
	),
	'MCHAT_SECONDS'					=> array(
		1 => '%1$d second',
		2 => '%1$d seconds',
	),

	// Post notification messages (%1$s is replaced with a link to the new/edited post, %2$s is replaced with a link to the forum)
	'MCHAT_NEW_POST'				=> 'Posted a new topic: %1$s in %2$s',
	'MCHAT_NEW_REPLY'				=> 'Posted a reply: %1$s in %2$s',
	'MCHAT_NEW_QUOTE'				=> 'Replied with a quote: %1$s in %2$s',
	'MCHAT_NEW_EDIT'				=> 'Edited a post: %1$s in %2$s',

));
