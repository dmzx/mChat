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
	'MCHAT_ADD'					=> 'Senden',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> 'Abschnitt',
	'MCHAT_LIKES'				=> 'Mag diesen Beitrag',
	'MCHAT_ANNOUNCEMENT'		=> 'Ankündigen',
	'MCHAT_ARCHIVE'				=> 'Archiv',
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini-Chat Archiv',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Alle Nachrichten im mChat löschen',
	'MCHAT_CLEANED'				=> 'Alle Nachrichten wurden erfolgreich gelöscht',
	'MCHAT_CLEAR_INPUT'			=> 'Zurücksetzen',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Eigene BBCodes',
	'MCHAT_DELALLMESS'			=> 'Alle Nachrichten löschen?',
	'MCHAT_DELCONFIRM'			=> 'Nachricht endgültig löschen?',
	'MCHAT_DELITE'				=> 'Löschen',
	'MCHAT_EDIT'				=> 'Bearbeiten',
	'MCHAT_EDITINFO'			=> 'Bearbeite die Nachricht und klick auf OK',
	'MCHAT_ENABLE'				=> 'Entschuldigung, aber der mChat ist momentan nicht verfügbar',
	'MCHAT_ERROR'				=> 'Fehler',
	'MCHAT_FLOOD'				=> 'Du kannst keine Nachricht so schnell nach deiner letzten Nachricht schreiben',
	'MCHAT_FOE'					=> 'Die Nachricht wurde von <strong>% 1 $ s </ strong> gemacht, der derzeit auf der Ignorieren-Liste steht.',
	'MCHAT_HELP'				=> 'mChat Regeln',
	'MCHAT_HIDE_LIST'			=> 'Verstecke Liste',
	'MCHAT_HOUR'				=> 'Stunde ',
	'MCHAT_HOURS'				=> 'Stunden',
	'MCHAT_IP'					=> 'IP whois für',
	'MCHAT_MINUTE'				=> 'Minute ',
	'MCHAT_MINUTES'				=> 'Minuten ',
	'MCHAT_MESS_LONG'			=> 'Deine Nachricht ist zu lang.\nBitte kürze deine Nachricht auf %s Zeichen',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'Die separate Seite für mChat ist derzeit nicht aktiviert!',
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'			=> 'Du hast keine Berechtigung im mChat zu schreiben',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Du hast keine Berechtigung das Archiv zu sehen',
	'MCHAT_NOJAVASCRIPT'		=> 'Dein Browser unterstützt kein Javascript oder Javascript ist deaktiviert',
	'MCHAT_NOMESSAGE'			=> 'Keine Nachrichten',
	'MCHAT_NOMESSAGEINPUT'		=> 'Du hast keine Nachricht eingegeben',
	'MCHAT_NOSMILE'				=> 'Keine Smilies gefunden',
	'MCHAT_NOTINSTALLED_USER'	=> 'Der mChat ist nicht installiert. Bitte kontaktiere den Boardgründer.',
	'MCHAT_NOT_INSTALLED'		=> 'Die mChat Datenbankeinträge fehlen.<br />Führe bitte den	%sInstaller%s aus, um die Datenbankänderungen für mChat durchzuführen.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Pausiert',
	'MCHAT_LOAD'				=> 'Wird geladen',
	'MCHAT_PERMISSIONS'			=> 'Ändere die Benutzerrechte',
	'MCHAT_REFRESHING'			=> 'Aktualisiere...',
	'MCHAT_REFRESH_NO'			=> 'Automatische Aktualisierung ist ausgeschaltet',
	'MCHAT_REFRESH_YES'			=> 'Automatische Aktualisierung alle <strong>%d</strong> Sekunden',
	'MCHAT_RESPOND'				=> 'Antworte dem Benutzer',
	'MCHAT_RESET_QUESTION'		=> 'Lösche den Eingabebereich?',
	'MCHAT_SESSION_OUT'			=> 'mChat Sitzung ist abgelaufen',
	'MCHAT_SHOW_LIST'			=> 'Zeige Liste',
	'MCHAT_SECOND'				=> 'Sekunde ',
	'MCHAT_SECONDS'				=> 'Sekunden ',
	'MCHAT_SESSION_ENDS'		=> 'Deine mChat-Sitzung endet in',
	'MCHAT_SMILES'				=> 'Smilies',
	'MCHAT_TOTALMESSAGES'		=> 'Nachrichten insgesamt: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Sound aktivieren?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Insgesamt sind <strong>%d</strong> Benutzer im mChat ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'Insgesamt ist <strong>%d</strong> Benutzer im mChat ',
	'MCHAT_NO_CHATTERS'					=> 'Derzeit sind keine Benutzer im mChat',
	'MCHAT_ONLINE_EXPLAIN'				=> '(basierend auf den aktiven Besuchern der letzten %s)',
	'WHO_IS_CHATTING'			=> 'Wer ist im mChat',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Aktualisieren alle <strong>%d</strong> Sekunden',
	'MCHAT_NEW_TOPIC'			=> 'Erstelle ein neues Thema',
	'MCHAT_NEW_REPLY'			=> 'Erstelle eine neue Antwort',
	'MCHAT_NEW_QUOTE'			=> 'Antworte mit einem Zitat',
	'MCHAT_NEW_EDIT'			=> 'Bearbeite',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat Einstellung',
	'DISPLAY_MCHAT' 	=> 'mChat auf der Indexseite anzeigen',
	'SOUND_MCHAT'		=> 'Aktiviere Sound für mChat',
	'DISPLAY_STATS_INDEX'	=> 'Zeige die "Wer ist im mChat" Statistik auf der Indexseite an',
	'DISPLAY_NEW_TOPICS'	=> 'Zeige neue Beiträge im mChat an',
	'DISPLAY_AVATARS'	=> 'Zeige Avatare im mChat an',
	'CHAT_AREA'		=> 'Chat Umgebung',
	'CHAT_AREA_EXPLAIN'	=> 'Wähle welche Art von Umgebung für die Eingabe mit einem Chat: <br /> Ein Textbereich oder <br /> einem Eingangsbereich',
	'INPUT_AREA'		=> 'Eingangsbereich',
	'TEXT_AREA'			=> 'Textbereich',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat Tabelle löschen',
	'ACP_USER_MCHAT'			=> 'mChat Einstellung',
	'LOG_DELETED_MCHAT'		=> '<strong>Lösche mChat Nachricht</strong><br />» %1$en',
	'LOG_EDITED_MCHAT'		=> '<strong>Editiere mChat Nachricht</strong><br />» %1$en',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Zeichen übrig: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Poster',
	'MCHAT_NEW_CHAT'			=> 'Neue mChat Nachricht!',
	'MCHAT_SEND_PM'			 => 'Sende private Nachricht',
	'MCHAT_PM'					=> '(PN)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'mir gefällt dieser Beitrag',
));
