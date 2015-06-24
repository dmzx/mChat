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
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, array(

	// UMIL stuff
	'ACP_MCHAT_CONFIG'				=> 'Configuration',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'A mini chat (aka “shout box”) for your forum',
	'MCHAT_TABLE_DELETED'			=> 'The mChat table was successfully deleted',
	'MCHAT_TABLE_CREATED'			=> 'The mChat table was successfully created',
	'MCHAT_TABLE_UPDATED'			=> 'The mChat table was successfully updated',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Nothing to do....continuing',
	'UCP_CAT_MCHAT'					=> 'mChat Prefs',
	'UCP_MCHAT_CONFIG'				=> 'User mChat Prefs',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Rules',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Enter the rules of the forum here.	Each rule on a new line.<br />You are limited to 255 characters.<br /><strong>This message can be translated.</strong> (you must edit the mchat_lang.php file and read the instructions).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Updated mChat config </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini Chat configuration has been updated',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Version:',
	'MCHAT_ENABLE'					=> 'Enable mChat Extension',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Enable or disable the extension globally.',
	'MCHAT_AVATARS'					=> 'Display avatars',
	'MCHAT_AVATARS_EXPLAIN'			=> 'If set yes, resized user avatars will be displayed',
	'MCHAT_ON_INDEX'				=> 'mChat On Index',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Allow the display of the mChat on the index page.',
	'MCHAT_INDEX_HEIGHT'			=> 'Index Page Height',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'The height of the chat box in pixels on the index page of the forum.<br /><em>You are limited from 50 to 1000</em>.',
	'MCHAT_LOCATION'				=> 'Location on Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Choose the location of the mChat on the index page.',
	'MCHAT_TOP_OF_FORUM'			=> 'Top of Forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Bottom of Forum',
	'MCHAT_REFRESH'					=> 'Refresh',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Number of seconds before chat automatically refreshes.<br /><em>You are limited from 5 to 60 seconds</em>.',
	'MCHAT_PRUNE'					=> 'Enable Prune',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Set to yes to enable the prune feature.<br /><em>Only occurs if a user views the custom or archive pages</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Prune Number',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'The number of messages to retain in the chat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Message limit',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'The maximum number of messages to show in the chat area.<br /><em>Recommended from 10 to 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Index page message limit',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'The maximum number of messages to show in the chat area on the index page.<br /><em>Recommended from 10 to 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Archive limit',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'The maximum number of messages to show per page on the archive page.<br /> <em>Recommended from 25 to 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Flood time',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'The number of seconds a user must wait before posting another message in the chat.<br /><em>Recommended 5 to 30, set to 0 to disable</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Max message length',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Max number of characters allowed per message posted.<br /><em>Recommended from 100 to 500, set to 0 to disable</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Custom Page',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Allow the use of the custom page',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Custom Page Height',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'The height of the chat box in pixels on the seperate mChat page.<br /><em>You are limited from 50 to 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Date format',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'The syntax used is identical to the PHP <a href="http://www.php.net/date">date()</a> function.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Custom…',
	'MCHAT_WHOIS'					=> 'Whois',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Allow a display of users who are chatting',
	'MCHAT_WHOIS_REFRESH'			=> 'Whois refresh',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Number of seconds before whois stats refreshes.<br /><em>You are limited from 30 to 300 seconds</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Disallowed bbcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Here you can input the bbcodes that are <strong>not</strong> to be used in a message.<br />Separate bbcodes with a vertical bar, for example: <br />b|i|u|code|list|list=|flash|quote and/or a %scustom bbcode tag name%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Static Message',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Here you can define a static message to display to users of the chat.	HTML code is allowed.<br />Set to empty to disable the display.	You are limited to 255 characters.<br /><strong>This message can be translated.</strong>	(you must edit the mchat_lang.php file and read the instructions).',
	'MCHAT_USER_TIMEOUT'			=> 'User Timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Set the amount of time, in seconds, until a users session in the chat ends. Set to 0 for no timeout.<br /><em>You are limited to the %sforum config setting for sessions%s which is currently set to %s seconds</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Override smilie limit',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Set to yes to override the forums smilie limit setting for chat messages',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Override minimum characters limit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Set to yes to override the forums minimum characters setting for chat messages',
	'MCHAT_NEW_POSTS'				=> 'Enable Posts Display',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Set to yes and you can set below the options what message to display in the chat message area.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Display New Topic Posts',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Set to yes to allow new topic posts from the forum to be posted into the chat message area.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Display New Replied Posts',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Set to yes to allow replied posts from the forum to be posted into the chat message area.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Display Edited Posts',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Set to yes to allow edited posts from the forum to be posted into the chat message area.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Display Quoted Posts',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Set to yes to allow quoted posts from the forum to be posted into the chat message area.',
	'MCHAT_MAIN'					=> 'Main Configuration',
	'MCHAT_STATS'					=> 'Whois Chatting',
	'MCHAT_STATS_INDEX'				=> 'Stats on Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Show who is chatting with in the stats section of the forum',
	'MCHAT_MESSAGE_TOP'				=> 'Keep message on Bottom / Top',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'This will post the message bottom or top in the chat message area.',
	'MCHAT_BOTTOM'					=> 'Bottom',
	'MCHAT_TOP'						=> 'Top',
	'MCHAT_MESSAGES'				=> 'Message Settings',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause on input',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'If set Yes, then the chat will not autoupdate upon a user entering a message in the input area',

	// error reporting
	'TOO_LONG_DATE'		=> 'The date format you entered is too long.',
	'TOO_SHORT_DATE'	=> 'The date format you entered is too short.',
	'TOO_SMALL_REFRESH'	=> 'The refresh value is too small.',
	'TOO_LARGE_REFRESH'	=> 'The refresh value is too large.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'The message limit value is too small.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'The message limit value is too large.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'The archive limit value is too small.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'The archive limit value is too large.',
	'TOO_SMALL_FLOOD_TIME'	=> 'The flood time value is too small.',
	'TOO_LARGE_FLOOD_TIME'	=> 'The flood time value is too large.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'The max message length value is too small.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'The max message length value is too large.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'The max words length value is too small.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'The max words length value is too large.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'The whois refresh value is too small.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'The whois refresh value is too large.',
	'TOO_SMALL_INDEX_HEIGHT'	=> 'The index height value is too small.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'The index height value is too large.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'The custom height value is too small.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'The custom height value is too large.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'The static message value is too short.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'The static message value is too long.',
	'TOO_SMALL_TIMEOUT'	=> 'The user timeout value is too small.',
	'TOO_LARGE_TIMEOUT'	=> 'The user timeout value is too large.',

	// User perms
	'ACL_U_MCHAT_USE'			=> 'Can use mChat',
	'ACL_U_MCHAT_VIEW'			=> 'Can view mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Can edit mChat messages',
	'ACL_U_MCHAT_DELETE'		=> 'Can delete mChat messages',
	'ACL_U_MCHAT_IP'			=> 'Can use view mChat IP addresses',
	'ACL_U_MCHAT_PM'			=> 'Can use private message in mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Can use like message in mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Can use quote message in mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Can ignore mChat flood mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Can view the Archive mChat',
	'ACL_U_MCHAT_BBCODE'		=> 'Can use bbcode in mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Can use smilies in mChat',
	'ACL_U_MCHAT_URLS'			=> 'Can post urls in mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Can manage mChat settings',

));