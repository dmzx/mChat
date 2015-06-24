<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE!
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

// Adding the permissions
$lang = array_merge($lang, array(

	'MCHAT_TITLE'				=> 'Mini-Chat',
	'MCHAT_ADD'					=> 'Send',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> 'section',
	'MCHAT_LIKES'				=> 'Likes this post',
	'MCHAT_ANNOUNCEMENT'		=> 'Announcement',
	'MCHAT_ARCHIVE'				=> 'Archive',
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini-Chat Archive',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Purge',
	'MCHAT_CLEANED'				=> 'All messages have been successfully removed',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Custom BBCodes',
	'MCHAT_DELALLMESS'			=> 'Remove all messages?',
	'MCHAT_DELCONFIRM'			=> 'Do you confirm removal?',
	'MCHAT_DELITE'				=> 'Delete',
	'MCHAT_EDIT'				=> 'Edit',
	'MCHAT_EDITINFO'			=> 'Edit the message and click OK',
	'MCHAT_ENABLE'				=> 'Sorry, the Mini-Chat is currently unavailable',
	'MCHAT_ERROR'				=> 'Error',
	'MCHAT_FLOOD'				=> 'You can not post another message so soon after your last',
	'MCHAT_FOE'					=> 'This message was made by <strong>%1$s</strong> who is currently on your ignore list.',
	'MCHAT_HELP'				=> 'mChat Rules',
	'MCHAT_HIDE_LIST'			=> 'Hide List',
	'MCHAT_HOUR'				=> 'hour ',
	'MCHAT_HOURS'				=> 'hours',
	'MCHAT_IP'					=> 'IP whois for',
	'MCHAT_MINUTE'				=> 'minute ',
	'MCHAT_MINUTES'				=> 'minutes ',
	'MCHAT_MESS_LONG'			=> 'Your message is too long.\nPlease limit it to %s characters',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'The mChat custom page is not activated at this time!',
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'			=> 'You don’t have permission to post in the mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'You don’t have permission to view the archive',
	'MCHAT_NOJAVASCRIPT'		=> 'Your browser does not support JavaScript or JavaScript is disabled',
	'MCHAT_NOMESSAGE'			=> 'No messages',
	'MCHAT_NOMESSAGEINPUT'		=> 'You have not entered a message',
	'MCHAT_NOSMILE'				=> 'Smilies not found',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat is not installed.	Please notify the board founder.',
	'MCHAT_NOT_INSTALLED'		=> 'mChat database entries are missing.<br />Please run the %sinstaller%s to make the database changes for the modification.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Paused',
	'MCHAT_LOAD'				=> 'Loading',
	'MCHAT_PERMISSIONS'			=> 'Change users permissions',
	'MCHAT_REFRESHING'			=> 'Refreshing...',
	'MCHAT_REFRESH_NO'			=> 'Autoupdate is off',
	'MCHAT_REFRESH_YES'			=> 'Autoupdate every <strong>%d</strong> seconds',
	'MCHAT_RESPOND'				=> 'Respond to user',
	'MCHAT_RESET_QUESTION'		=> 'Clear the input area?',
	'MCHAT_SESSION_OUT'			=> 'Chat session has expired',
	'MCHAT_SHOW_LIST'			=> 'Show List',
	'MCHAT_SECOND'				=> 'second ',
	'MCHAT_SECONDS'				=> 'seconds ',
	'MCHAT_SESSION_ENDS'		=> 'Chat session ends in',
	'MCHAT_SMILES'				=> 'Smilies',
	'MCHAT_TOTALMESSAGES'		=> 'Total messages: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Use sound?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'In total there are <strong>%d</strong> users chatting ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'In total there is <strong>%d</strong> user chatting ',
	'MCHAT_NO_CHATTERS'					=> 'No one is chatting',
	'MCHAT_ONLINE_EXPLAIN'				=> 'based on users active over the past %s',
	'WHO_IS_CHATTING'			=> 'Who is chatting',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Refreshes every <strong>%d</strong> seconds',
	'MCHAT_NEW_TOPIC'			=> 'Made A New Topic',
	'MCHAT_NEW_REPLY'			=> 'Made A New Reply',
	'MCHAT_NEW_QUOTE'			=> 'Replied with a Quote',
	'MCHAT_NEW_EDIT'			=> 'Made A Edit',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat Preferences',
	'DISPLAY_MCHAT' 	=> 'Display mChat on Index',
	'SOUND_MCHAT'		=> 'Enable mChat sound',
	'DISPLAY_STATS_INDEX'	=> 'Display the Who is Chatting stats on index page',
	'DISPLAY_NEW_TOPICS'	=> 'Display new topics in the chat',
	'DISPLAY_AVATARS'	=> 'Display avatars in the chat',
	'CHAT_AREA'		=> 'Input type',
	'CHAT_AREA_EXPLAIN'	=> 'Choose which type of area to use to input a chat:<br />A text area or<br />an input area',
	'INPUT_AREA'		=> 'Input area',
	'TEXT_AREA'			=> 'Text area',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat Table was pruned',
	'ACP_USER_MCHAT'			=> 'mChat Settings',
	'LOG_DELETED_MCHAT'		=> '<strong>Deleted mChat message</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Edited mChat message</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Characters remaining: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> 'New Chat Message!',
	'MCHAT_SEND_PM'			 => 'Send Private Message',
	'MCHAT_PM'					=> '(PM)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Like This Post',
	));