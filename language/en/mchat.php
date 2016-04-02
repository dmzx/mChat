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
	'MCHAT_ADD'						=> 'Send',
	'MCHAT_ARCHIVE'					=> 'Archive',
	'MCHAT_ARCHIVE_PAGE'			=> 'mChat Archive',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CUSTOM_BBCODES'			=> 'Custom BBCodes',
	'MCHAT_DELCONFIRM'				=> 'Do you confirm removal?',
	'MCHAT_EDIT'					=> 'Edit',
	'MCHAT_EDITINFO'				=> 'Edit the message and click OK',
	'MCHAT_NEW_CHAT'				=> 'New chat message!',
	'MCHAT_SEND_PM'					=> 'Send private message',
	'MCHAT_LIKE'					=> 'Like this post',
	'MCHAT_LIKES'					=> 'likes this post',
	'MCHAT_FLOOD'					=> 'You can not post another message so soon after your last',
	'MCHAT_FOE'						=> 'This message was made by <strong>%1$s</strong> who is currently on your ignore list.',
	'MCHAT_RULES'					=> 'Rules',
	'MCHAT_WHOIS_USER'				=> 'IP whois for %1$s',
	'MCHAT_MESS_LONG'				=> 'Your message is too long. Please limit it to %1$d characters',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'The mChat custom page is not activated at this time!',
	'MCHAT_NO_RULES'				=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'				=> 'You don’t have permission to post in the chat',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'You don’t have permission to view the archive',
	'MCHAT_NOJAVASCRIPT'			=> 'Your browser does not support JavaScript or JavaScript is disabled',
	'MCHAT_NOMESSAGE'				=> 'No messages',
	'MCHAT_NOMESSAGEINPUT'			=> 'You have not entered a message',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Paused',
	'MCHAT_PERMISSIONS'				=> 'Change user’s permissions',
	'MCHAT_REFRESHING'				=> 'Refreshing…',
	'MCHAT_REFRESH_NO'				=> 'Update is off',
	'MCHAT_REFRESH_YES'				=> 'Updates every <strong>%1$d</strong> seconds',
	'MCHAT_RESPOND'					=> 'Respond to user',
	'MCHAT_SESSION_ENDS'			=> 'Chat session ends in %1$s',
	'MCHAT_SESSION_OUT'				=> 'Chat session has expired',
	'MCHAT_SMILES'					=> 'Smilies',
	'MCHAT_TOTALMESSAGES'			=> 'Total messages: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Play sound',
	'MCHAT_COLLAPSE_TITLE'			=> 'Toggle visibility of mChat',
	'MCHAT_WHO_IS_REFRESH_EXPLAIN'	=> 'Refreshes every <strong>%1$d</strong> seconds',
	'MCHAT_MINUTES_AGO'				=> array(
		0 => 'just now',
		1 => '%1$d minute ago',
		2 => '%1$d minutes ago',
	),

	// These messages are formatted with JavaScript, hence {} and no $d
	'MCHAT_CHARACTER_COUNT'			=> '<strong>{current}</strong> characters',
	'MCHAT_CHARACTER_COUNT_LIMIT'	=> '<strong>{current}</strong> out of {max} characters',
	'MCHAT_SESSION_ENDS_JS'			=> 'Chat session ends in {timeleft}',

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',
));
