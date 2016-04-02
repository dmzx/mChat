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
	// ACP Configuration sections
	'MCHAT_SETTINGS_INDEX'							=> 'Index page settings',
	'MCHAT_SETTINGS_CUSTOM'							=> 'Custom page settings',
	'MCHAT_SETTINGS_ARCHIVE'						=> 'Archive page settings',
	'MCHAT_SETTINGS_POSTS'							=> 'New posts settings',
	'MCHAT_SETTINGS_MESSAGES'						=> 'Message settings',
	'MCHAT_SETTINGS_PRUNE'							=> 'Pruning settings',
	'MCHAT_SETTINGS_STATS'							=> 'Who is chatting settings',

	'MCHAT_GLOBALUSERSETTINGS_EXPLAIN'				=> 'Settings for which a user does <strong>not</strong> have permission to customise are applied as configured below.<br />New user accounts will have initial settings as configured below.<br /><br />Go to the <em>mChat in UCP</em> tab of the user permissions section to adjust customisation permissions.<br />Go to the <em>Preferences</em> form in the <em>user management</em> section to see the status of each user’s settings.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE'			=> 'Overwrite settings for all users',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_EXPLAIN'	=> 'Applies the settings as defined above to <em>all</em> user accounts.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_CONFIRM'	=> 'Confirm overwriting mChat settings for all users',

	'MCHAT_ACP_USER_PREFS_EXPLAIN'					=> 'Below are listed all mChat preferences of the selected user. Settings for which the selected user does not have permission to customise are disabled. These settings can be changed in the <em>Global user settings</em> mChat configuration section.',

	// ACP settings
	'MCHAT_ACP_GLOBALSETTINGS_TITLE'				=> 'mChat Global settings',
	'MCHAT_ACP_GLOBALUSERSETTINGS_TITLE'			=> 'mChat Global user settings',
	'MCHAT_VERSION'									=> 'Version',
	'MCHAT_RULES'									=> 'Rules',
	'MCHAT_RULES_EXPLAIN'							=> 'Enter the rules of the forum here. HTML code is allowed. <em>You are limited to 255 characters.</em><br />This message can be translated: edit the MCHAT_RULES_MESSAGE language key in /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_CONFIG_SAVED'							=> 'mChat configuration has been updated',
	'MCHAT_AVATARS'									=> 'Display avatars',
	'MCHAT_AVATARS_EXPLAIN'							=> 'If set to yes, resized user avatars will be displayed',
	'MCHAT_INDEX'									=> 'Display mChat on the index page',
	'MCHAT_INDEX_HEIGHT'							=> 'Index page height',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'					=> 'The height of the chat box in pixels on the index page.<br /><em>You are limited from 50 to 1000. Default is 250.</em>',
	'MCHAT_TOP_OF_FORUM'							=> 'Top',
	'MCHAT_BOTTOM_OF_FORUM'							=> 'Bottom',
	'MCHAT_REFRESH'									=> 'Refresh interval',
	'MCHAT_REFRESH_EXPLAIN'							=> 'Number of seconds before the chat refreshes.<br /><em>You are limited from 5 to 60 seconds. Default is 10.</em>',
	'MCHAT_LIVE_UPDATES'							=> 'Live updates of edited and deleted messages',
	'MCHAT_LIVE_UPDATES_EXPLAIN'					=> 'When a user edits or deletes messages, the changes are updated live for all others, without them having to refresh the page. Disable this if you experience performance issues.',
	'MCHAT_PRUNE'									=> 'Enable message pruning',
	'MCHAT_PRUNE_EXPLAIN'							=> 'Only occurs if a user views the custom or archive pages.',
	'MCHAT_PRUNE_NUM'								=> 'Number of messages to retain when pruning',
	'MCHAT_NAVBAR_LINK'								=> 'Display link to the custom page in the navbar',
	'MCHAT_MESSAGE_NUM_CUSTOM'						=> 'Initial number of messages to display on the custom page',
	'MCHAT_MESSAGE_NUM_CUSTOM_EXPLAIN'				=> '<em>You are limited from 5 to 50. Default is 10.</em>',
	'MCHAT_MESSAGE_NUM_INDEX'						=> 'Initial number of messages to display on the index page',
	'MCHAT_MESSAGE_NUM_INDEX_EXPLAIN'				=> '<em>You are limited from 5 to 50. Default is 10.</em>',
	'MCHAT_MESSAGE_NUM_ARCHIVE'						=> 'Number of messages to display on the archive page',
	'MCHAT_MESSAGE_NUM_ARCHIVE_EXPLAIN'				=> 'The maximum number of messages to show per page on the archive page.<br /><em>You are limited from 10 to 100. Default is 25.</em>',
	'MCHAT_FLOOD_TIME'								=> 'Flood time',
	'MCHAT_FLOOD_TIME_EXPLAIN'						=> 'The number of seconds a user must wait before posting another message in the chat.<br /><em>You are limited from 5 to 60 seconds. Default is 0. Set to 0 to disable.</em>',
	'MCHAT_EDIT_DELETE_LIMIT'						=> 'Time limit for editing and deleting messages',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'				=> 'Messages older than the specified number of seconds cannot be edited or deleted by the author any more.<br />Users who have <em>edit/delete permission as well as moderator permission are exempt</em> from this time limit.<br />Set to 0 to allow unlimited editing and deleting.',
	'MCHAT_MAX_MESSAGE_LENGTH'						=> 'Maximum message length',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'				=> 'Maximum number of characters allowed per message posted.<br /><em>You are limited from 0 to 1000. Default is 500. Set to 0 to disable.</em>',
	'MCHAT_CUSTOM_PAGE'								=> 'Enable custom Page',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'						=> 'Allow the use of the custom page',
	'MCHAT_CUSTOM_HEIGHT'							=> 'Custom page height',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'					=> 'The height of the chat box in pixels on the custom page.<br /><em>You are limited from 50 to 1000. Default is 350.</em>',
	'MCHAT_BBCODES_DISALLOWED'						=> 'Disallowed bbcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'				=> 'Here you can input the bbcodes that are <strong>not</strong> to be used in a message.<br />Separate bbcodes with a vertical bar, for example: <br />b|i|u|code|list|list=|flash|quote and/or a %1$scustom bbcode tag name%2$s',
	'MCHAT_STATIC_MESSAGE'							=> 'Static message',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'					=> 'Here you can define a static message to display to users of the chat. HTML code is allowed.<br />Set to empty to disable the display. <em>You are limited to 255 characters.</em><br />This message can be translated: edit the MCHAT_STATIC_MESSAGE language key in /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_USER_TIMEOUT'							=> 'User session timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'					=> 'Set the amount of time in seconds until a user session in the chat ends.<br />Set to 0 for no timeout. Careful, the session of a user reading mChat will never expire!<br /><em>You are limited to the %1$sforum config setting for sessions%2$s which is currently set to %3$d seconds</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'					=> 'Override smilie limit',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'			=> 'Set to yes to override the forums smilie limit setting for chat messages',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'					=> 'Override minimum characters limit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'			=> 'Set to yes to override the forums minimum characters setting for chat messages',

	'MCHAT_WHOIS_REFRESH'							=> 'Who is chatting refresh interval',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'					=> 'Number of seconds before who is chatting refreshes.<br /><em>You are limited from 10 to 300 seconds. Default is 60.</em>',
	'MCHAT_SOUND'									=> 'Play sounds for new, edited and deleted messages',
	'MCHAT_PURGE'									=> 'Delete all messages now',
	'MCHAT_PURGE_CONFIRM'							=> 'Confirm deleting all messages',
	'MCHAT_PURGED'									=> 'All mChat messages have been successfully deleted',

	// Error reporting
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'				=> 'The disallowed bbcodes value is too long.',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'					=> 'The custom height value is too small.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'					=> 'The custom height value is too large.',
	'TOO_LONG_MCHAT_DATE'							=> 'The date format you entered is too long.',
	'TOO_SHORT_MCHAT_DATE'							=> 'The date format you entered is too short.',
	'TOO_SMALL_MCHAT_FLOOD_TIME'					=> 'The flood time value is too small.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'					=> 'The flood time value is too large.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'					=> 'The index height value is too small.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'					=> 'The index height value is too large.',
	'TOO_SMALL_MCHAT_MAX_MESSAGE_LNGTH'				=> 'The max message length value is too small.',
	'TOO_LARGE_MCHAT_MAX_MESSAGE_LNGTH'				=> 'The max message length value is too large.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'The number of message to display on the custom page is too small.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'The number of message to display on the custom page is too large.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_INDEX'				=> 'The number of messages to display on the index page is too small.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_INDEX'				=> 'The number of messages to display on the index page is too large.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'The number of message to display on the archive page is too small.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'The number of message to display on the archive page is too large.',
	'TOO_SMALL_MCHAT_REFRESH'						=> 'The refresh value is too small.',
	'TOO_LARGE_MCHAT_REFRESH'						=> 'The refresh value is too large.',
	'TOO_LONG_MCHAT_STATIC_MESSAGE'					=> 'The static message value is too long.',
	'TOO_SMALL_MCHAT_TIMEOUT'						=> 'The user timeout value is too small.',
	'TOO_LARGE_MCHAT_TIMEOUT'						=> 'The user timeout value is too large.',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'					=> 'The whois refresh value is too small.',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'					=> 'The whois refresh value is too large.',
));
