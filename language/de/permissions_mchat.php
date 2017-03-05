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
	'ACL_U_MCHAT_USE'						=> 'Kann mChat benutzen',
	'ACL_U_MCHAT_VIEW'						=> 'Kann mChat sehen',
	'ACL_U_MCHAT_EDIT'						=> 'Kann mChat bearbeiten',
	'ACL_U_MCHAT_DELETE'					=> 'Kann mChat Nachricht löschen',
	'ACL_U_MCHAT_IP'						=> 'Kann mChat IP sehen',
	'ACL_U_MCHAT_PM'						=> 'Kann Private Nachricht im mChat verwenden',
	'ACL_U_MCHAT_LIKE'						=> 'Kann "gefällt mir" Nachrichten im mChat verwenden',
	'ACL_U_MCHAT_QUOTE'						=> 'Kann Zitate im mChat verwenden',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Kann den mChat Flood ignorieren',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Kann das mChat Archiv sehen',
	'ACL_U_MCHAT_BBCODE'					=> 'Kann BBCode im mChat verwenden',
	'ACL_U_MCHAT_SMILIES'					=> 'Kann Smilies im mChat verwenden',
	'ACL_U_MCHAT_URLS'						=> 'Kann URLs im mChat posten',

	'ACL_U_MCHAT_AVATARS'					=> 'Kann <em>Zeige Avatare</em> anpassen',
	'ACL_U_MCHAT_CAPITAL_LETTER'			=> 'Kann <em>Erster Buchstabe ist Großbuchstabe</em> anpassen',
	'ACL_U_MCHAT_CHARACTER_COUNT'			=> 'Kann <em>Zeige Zeichenanzahl</em> anpassen',
	'ACL_U_MCHAT_DATE'						=> 'Kann <em>Datumsformat</em> anpassen',
	'ACL_U_MCHAT_INDEX'						=> 'Kann <em>Anzeige auf Index Seite</em> anpassen',
	'ACL_U_MCHAT_INPUT_AREA'				=> 'Kann <em>Eingabe Art</em> anpassen',
	'ACL_U_MCHAT_LOCATION'					=> 'Kann <em>mChat Position auf der Index Seite</em> anpassen',
	'ACL_U_MCHAT_MESSAGE_TOP'				=> 'Kann <em>Nachricht unten / oben</em> anpassen',
	'ACL_U_MCHAT_PAUSE_ON_INPUT'			=> 'Kann <em>Pause wärend der Eingabe</em> anpassen',
	'ACL_U_MCHAT_POSTS'						=> 'Kann <em>Zeige neue Beiträge</em> anpassen',
	'ACL_U_MCHAT_RELATIVE_TIME'				=> 'Kann <em>Zeige relative Zeit</em> anpassen',
	'ACL_U_MCHAT_SOUND'						=> 'Kann <em>Sound abspielen</em> anpassen',
	'ACL_U_MCHAT_WHOIS_INDEX'				=> 'Kann <em>Zeige "Wer chattet" unterhalb des Chats an</em> anpassen',
	'ACL_U_MCHAT_STATS_INDEX'				=> 'Kann <em>Zeige "Wer chattet" in der Statistik an</em> anpassen',

	'ACL_A_MCHAT'							=> 'Kann mChat Einstellungen bearbeiten',
));
