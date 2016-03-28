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
	'MCHAT_ADD'						=> 'Senden',
	'MCHAT_ARCHIVE'					=> 'Archiv',
	'MCHAT_ARCHIVE_PAGE'			=> 'mChat Archiv',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CUSTOM_BBCODES'			=> 'Eigene BBCodes',
	'MCHAT_DELCONFIRM'				=> 'Nachricht endgültig löschen?',
	'MCHAT_EDIT'					=> 'Ändern',
	'MCHAT_EDITINFO'				=> 'Ändere die Nachricht und klicke auf OK',
	'MCHAT_NEW_CHAT'				=> 'Neue Chat Nachricht!',
	'MCHAT_SEND_PM'					=> 'Sende private Nachricht',
	'MCHAT_LIKE'					=> 'Mir gefällt dieser Beitrag',
	'MCHAT_LIKES'					=> 'gefällt dieser Beitrag',
	'MCHAT_FLOOD'					=> 'Du kannst keine Nachricht so schnell nach Deiner letzten Nachricht schreiben',
	'MCHAT_FOE'						=> 'Die Nachricht wurde von <strong>%1$s</strong> gemacht, der derzeit auf der Ignorieren-Liste steht.',
	'MCHAT_RULES'					=> 'Regeln',
	'MCHAT_WHOIS_USER'				=> 'IP whois für %1$s',
	'MCHAT_MESS_LONG'				=> 'Deine Nachricht ist zu lang.\nBitte kürze Deine Nachricht auf %1$d Zeichen',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'Die separate Seite für mChat ist derzeit nicht aktiviert!',
	'MCHAT_NO_RULES'				=> 'Die mChat Regeln Seite ist derzeit nicht aktiviert!',
	'MCHAT_NOACCESS'				=> 'Du hast keine Berechtigung im mChat zu schreiben',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Du hast keine Berechtigung das Archiv zu sehen',
	'MCHAT_NOJAVASCRIPT'			=> 'Dein Browser unterstützt kein Javascript oder Javascript ist deaktiviert',
	'MCHAT_NOMESSAGE'				=> 'Keine Nachrichten',
	'MCHAT_NOMESSAGEINPUT'			=> 'Du hast keine Nachricht eingegeben',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Pausiert',
	'MCHAT_PERMISSIONS'				=> 'Ändere die Benutzerrechte',
	'MCHAT_REFRESHING'				=> 'Aktualisiere…',
	'MCHAT_REFRESH_NO'				=> 'Automatische Aktualisierung ist ausgeschaltet',
	'MCHAT_REFRESH_YES'				=> 'Automatische Aktualisierung alle <strong>%1$d</strong> Sekunden',
	'MCHAT_RESPOND'					=> 'Antworte dem Benutzer',
	'MCHAT_RESET_QUESTION'			=> 'Den Eingabebereich löschen?',
	'MCHAT_SESSION_ENDS'			=> 'Chat Sitzung endet in %1$s',
	'MCHAT_SESSION_OUT'				=> 'Chat Sitzung ist abgelaufen',
	'MCHAT_SMILES'					=> 'Smilies',
	'MCHAT_TOTALMESSAGES'			=> 'Anzahl aller Nachrichten: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Sound aktivieren',
	'MCHAT_WHO_IS_REFRESH_EXPLAIN'	=> 'Aktualisiert alle <strong>%1$d</strong> Sekunden',
	'MCHAT_MINUTES_AGO'				=> array(
		0 => 'gerade eben',
		1 => 'vor %1$d Minute',
		2 => 'vor %1$d Minuten',
	),

	// These messages are formatted with JavaScript, hence {} and no $d
	'MCHAT_CHARACTER_COUNT'			=> '<strong>{current}</strong> Zeichen',
	'MCHAT_CHARACTER_COUNT_LIMIT'	=> '<strong>{current}</strong> von maximal {max} Zeichen',
	'MCHAT_SESSION_ENDS_JS'			=> 'Chat Session endet in {timeleft}',

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',
));
