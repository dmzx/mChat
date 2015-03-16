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

// Adding new category
$lang['permission_cat']['mchat'] = 'mChat';

// Adding the permissions
$lang = array_merge($lang, array(

	'MCHAT_TITLE'				=> 'Mini-Chat',
	'MCHAT_ADD'					=> 'Send',
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
	'MCHAT_NOACCESS'			=> 'You don’t have permission to post in the mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'You don’t have permission to view the archive',
	'MCHAT_NOJAVASCRIPT'		=> 'Your browser does not support JavaScript or JavaScript is disabled',
	'MCHAT_NOMESSAGE'			=> 'No messages',
	'MCHAT_NOMESSAGEINPUT'		=> 'You have not entered a message',
	'MCHAT_NOSMILE'				=> 'Smilies not found',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat is not installed.  Please notify the board founder.',
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
	'MCHAT_NEW_TOPIC'			=> '<strong>New Topic</strong>',
	'MCHAT_NEW_REPLY'			=> '<strong>New Reply</strong>',

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
	// ACP
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Enter the rules of the forum here.  Each rule on a new line.<br />You are limited to 255 characters.<br /><strong>This message can be translated.</strong> (you must edit the mchat_lang.php file and read the instructions).',
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
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Here you can define a static message to display to users of the chat.  HTML code is allowed.<br />Set to empty to disable the display.  You are limited to 255 characters.<br /><strong>This message can be translated.</strong>  (you must edit the mchat_lang.php file and read the instructions).',
	'MCHAT_USER_TIMEOUT'			=> 'User Timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Set the amount of time, in seconds, until a users session in the chat ends. Set to 0 for no timeout.<br /><em>You are limited to the %sforum config setting for sessions%s which is currently set to %s seconds</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Override smilie limit',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Set to yes to override the forums smilie limit setting for chat messages',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Override minimum characters limit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Set to yes to override the forums minimum characters setting for chat messages',
	'MCHAT_NEW_POSTS'				=> 'Display New Posts',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Set to yes to allow new posts from the forum to be posted into the chat message area<br /><strong>You must have the add-on for new post notifications installed</strong> (within the contrib directory of the extension download).',
	'MCHAT_MAIN'					=> 'Main Configuration',
	'MCHAT_STATS'					=> 'Whois Chatting',
	'MCHAT_STATS_INDEX'				=> 'Stats on Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Show who is chatting with in the stats section of the forum',
	'MCHAT_MESSAGES'				=> 'Message Settings',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause on input',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'If set Yes, then the chat will not autoupdate upon a user entering a message in the input area',

	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'The mChat extension needs updating.  Please have a forum founder visit this section to run the installer.',
	'MCHAT_WRONG_VERSION'	=> 'The wrong version of the extension is installed.  Please run the %sinstaller%s for the new version of the modification.',
	'WARNING'	=> 'Warning',
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
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat', //Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat Table was pruned',
	'ACP_USER_MCHAT'			=> 'mChat Settings',
	'LOG_DELETED_MCHAT'	  => '<strong>Deleted mChat message</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'	  => '<strong>Edited mChat message</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'   => 'Characters remaining: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> 'New Chat Message!',
	'FONT_COLOR'				=> 'Font colour',
	'FONT_COLOR_HIDE'			=> 'Hide font colour',
	'FONT_HUGE'					=> 'Huge',
	'FONT_LARGE'				=> 'Large',
	'FONT_NORMAL'				=> 'Normal',
	'FONT_SIZE'					=> 'Font size',
	'FONT_SMALL'				=> 'Small',
	'FONT_TINY'					=> 'Tiny',
	'MCHAT_SEND_PM'			 => 'Send Private Message',
	'MCHAT_PM'				  => '(PM)',
	'MORE_SMILIES'			  => 'More Smilies',
));