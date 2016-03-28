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
	'MCHAT_PREFERENCES'				=> 'mChat Einstellungen',
	'MCHAT_NO_SETTINGS'				=> 'Du bist nicht berechtigt die Einstellungen zu verändern.',

	'MCHAT_INDEX'					=> 'Anzeige auf Index Seite',
	'MCHAT_SOUND'					=> 'Sound abspielen',
	'MCHAT_WHOIS_INDEX'				=> 'Zeige <em>Wer ist im Chat</em> unterhalb des Chats an',
	'MCHAT_STATS_INDEX'				=> 'Zeige <em>Wer ist im Chat</em> in der Statistik an',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Zeige <em>Wer ist im Chat</em> unterhalb von der <em>Wer ist online</em> Bereich auf dem Index an',
	'MCHAT_AVATARS'					=> 'Zeige Avatare',
	'MCHAT_CAPITAL_LETTER'			=> 'Erster Buchstabe ist Großbuchstabe',
	'MCHAT_CHAT_AREA'				=> 'Eingabe Art',
	'MCHAT_INPUT_AREA'				=> 'Eingabe Feld',
	'MCHAT_TEXT_AREA'				=> 'Text Bereich',
	'MCHAT_POSTS'					=> 'Zeige neue Beiträge (momentan alles deaktiviert, kann aber in den Globalen Einstellungen des mChat im ACP aktiviert werden)',
	'MCHAT_CHARACTER_COUNT'			=> 'Zeige Zeichenanzahl',
	'MCHAT_RELATIVE_TIME'			=> 'Zeige relative Zeit für neue Nachrichten an',
	'MCHAT_RELATIVE_TIME_EXPLAIN'	=> 'Zeige "gerade eben", "vor einer Minute" usw. für jede Nachricht an. Setze <em>Nein</em> für eine vollständige Zeitanzeige.',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause wärend der Eingabe',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Während der Eingabe wir der Chat nicht aktualisiert',
	'MCHAT_MESSAGE_TOP'				=> 'Nachricht unten / oben',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Neue Nachrichten erscheinen entweder oben oder unten im Chat.',
	'MCHAT_LOCATION'				=> 'mChat Position auf der Index Seite',
	'MCHAT_BOTTOM'					=> 'Unten',
	'MCHAT_TOP'						=> 'Oben',

	'MCHAT_POSTS_TOPIC'				=> 'Zeige neue Beiträge',
	'MCHAT_POSTS_REPLY'				=> 'Zeige neue Antworten',
	'MCHAT_POSTS_EDIT'				=> 'Zeige editierte Beiträge',
	'MCHAT_POSTS_QUOTE'				=> 'Zeige zitierte Beiträge',

	'MCHAT_DATE_FORMAT'				=> 'Datumsformat',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Der benutzte Syntax ist identisch zur PHP <a href="http://www.php.net/date">date()</a> Funktion.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Benutzer definiert…',
));
