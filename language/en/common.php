<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
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

$lang = array_merge($lang, array(
	'MCHAT_TITLE'					=> 'mChat',
	'MCHAT_ADD'						=> 'Send',
	'MCHAT_ANNOUNCEMENT'			=> 'Announcement',
	'MCHAT_ARCHIVE'					=> 'Archive',
	'MCHAT_ARCHIVE_PAGE'			=> 'mChat Archive',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CUSTOM_BBCODES'			=> 'Custom BBCodes',
	'MCHAT_DELCONFIRM'				=> 'Do you confirm removal?',
	'MCHAT_EDIT'					=> 'Edit',
	'MCHAT_EDITINFO'				=> 'Edit the message and click OK',
	'MCHAT_FLOOD'					=> 'You can not post another message so soon after your last',
	'MCHAT_FOE'						=> 'This message was made by <strong>%1$s</strong> who is currently on your ignore list.',
	'MCHAT_RULES'					=> 'Rules',
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
	'MCHAT_WHOIS_USER'				=> 'IP whois for %1$s',
	'MCHAT_MESS_LONG'				=> 'Your message is too long. Please limit it to %1$d characters',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'The mChat custom page is not activated at this time!',
	'MCHAT_NO_RULES'				=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'				=> 'You don’t have permission to post in the mChat',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'You don’t have permission to view the archive',
	'MCHAT_NOJAVASCRIPT'			=> 'Your browser does not support JavaScript or JavaScript is disabled',
	'MCHAT_NOMESSAGE'				=> 'No messages',
	'MCHAT_NOMESSAGEINPUT'			=> 'You have not entered a message',
	'MCHAT_NOSMILE'					=> 'Smilies not found',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Paused',
	'MCHAT_PERMISSIONS'				=> 'Change user’s permissions',
	'MCHAT_REFRESHING'				=> 'Refreshing...',
	'MCHAT_REFRESH_NO'				=> 'Update is off',
	'MCHAT_REFRESH_YES'				=> 'Updates every <strong>%1$d</strong> seconds',
	'MCHAT_RESPOND'					=> 'Respond to user',
	'MCHAT_RESET_QUESTION'			=> 'Clear the input area?',
	'MCHAT_SESSION_OUT'				=> 'Chat session has expired',

	'MCHAT_SESSION_ENDS'			=> 'Chat session ends in',
	'MCHAT_SMILES'					=> 'Smilies',
	'MCHAT_TOTALMESSAGES'			=> 'Total messages: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Use sound',
	'MCHAT_ONLINE_USERS_TOTAL'		=> array(
		0 => 'No one is chatting',
		1 => 'In total there is <strong>%1$d</strong> user chatting',
		2 => 'In total there are <strong>%1$d</strong> users chatting',
	),
	'MCHAT_ONLINE_EXPLAIN'			=> 'based on users active over the past %1$s',
	'WHO_IS_CHATTING'				=> 'Who is chatting',
	'WHO_IS_REFRESH_EXPLAIN'		=> 'Refreshes every <strong>%d</strong> seconds',
	'MCHAT_NEW_POST'				=> 'Posted a new topic: %1$s in %2$s',
	'MCHAT_NEW_REPLY'				=> 'Posted a reply: %1$s in %2$s',
	'MCHAT_NEW_QUOTE'				=> 'Replied with a quote: %1$s in %2$s',
	'MCHAT_NEW_EDIT'				=> 'Edited a post: %1$s in %2$s',

	// UCP
	'UCP_PROFILE_MCHAT'				=> 'mChat preferences',
	'DISPLAY_MCHAT'					=> 'Display mChat on index',
	'SOUND_MCHAT'					=> 'Enable mChat sound',
	'DISPLAY_STATS_INDEX'			=> 'Display who is chatting on index',
	'DISPLAY_NEW_TOPICS'			=> 'Display new topics in the chat',
	'DISPLAY_AVATARS'				=> 'Display avatars in the chat',
	'CHAT_AREA'						=> 'Input type',
	'CHAT_AREA_EXPLAIN'				=> 'The type of area to use for writing messages',
	'INPUT_AREA'					=> 'Input area',
	'TEXT_AREA'						=> 'Text area',
	'UCP_CAT_MCHAT'					=> 'mChat',
	'UCP_MCHAT_CONFIG'				=> 'mChat',

	// Preferences
	'LOG_MCHAT_TABLE_PRUNED'		=> 'mChat messages were pruned',
	'ACP_USER_MCHAT'				=> 'mChat settings',
	'LOG_DELETED_MCHAT'				=> '<strong>Deleted mChat message</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Edited mChat message</strong><br />» %1$s',
	'MCHAT_NEW_CHAT'				=> 'New chat message!',
	'MCHAT_SEND_PM'					=> 'Send private message',
	'MCHAT_LIKE'					=> 'Like this post',
	'MCHAT_LIKES'					=> 'Likes this post',

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',
));
