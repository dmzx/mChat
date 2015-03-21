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
	'MCHAT_ADD'					=> 'Senden',
	'MCHAT_ANNOUNCEMENT'		=> 'Ankündigen',
	'MCHAT_ARCHIVE'				=> 'Archiv',
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini-Chat Archiv',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Alle Nachrichten im mChat löschen',
	'MCHAT_CLEANED'				=> 'Alle Nachrichten wurden erfolgreich gelöscht',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
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
	'MCHAT_NOACCESS'			=> 'Du hast keine Berechtigung im mChat zu schreiben',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Du hast keine Berechtigung das Archiv zu sehen',
	'MCHAT_NOJAVASCRIPT'		=> 'Dein Browser unterstützt kein Javascript oder Javascript ist deaktiviert',
	'MCHAT_NOMESSAGE'			=> 'Keine Nachrichten',
	'MCHAT_NOMESSAGEINPUT'		=> 'Du hast keine Nachricht eingegeben',
	'MCHAT_NOSMILE'				=> 'Keine Smilies gefunden',
	'MCHAT_NOTINSTALLED_USER'	=> 'Der mChat ist nicht installiert. Bitte kontaktiere den Boardgründer.',
	'MCHAT_NOT_INSTALLED'		=> 'Die mChat Datenbankeinträge fehlen.<br />Führe bitte den  %sInstaller%s aus, um die Datenbankänderungen für mChat durchzuführen.',
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
	'MCHAT_NEW_TOPIC'			=> '<strong>Neues Thema</strong>',		
	'MCHAT_NEW_REPLY'			=> '<strong>Neue Antwort</strong>',

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
	// ACP
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Geben Sie die Regeln des Forums hier ein. Jede Regel in einer neuen Zeile. <br /> Sie sind auf 255 Zeichen beschränkt. <br /> <Strong> Diese Mitteilung kann übersetzt werden. </ Strong> (Sie müssen die mchat_lang.php Datei und die Anleitung bearbeiten).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Aktualisiert mChat Konfiguration </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini Chat Konfiguration ist aktuell',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Version:',
	'MCHAT_ENABLE'					=> 'Aktiviere mChat Extension',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Aktiviere oder deaktiviere die Extension global.',
	'MCHAT_AVATARS'					=> 'Avatare anzeigen',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Wenn ja gesetzt ist, wird die veränderte Größe der Benutzeravatare angezeigt',	
	'MCHAT_ON_INDEX'				=> 'mChat auf dem Index',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Ermöglichen die Anzeige des MCHAT auf der Indexseite.',
	'MCHAT_INDEX_HEIGHT'			=> 'Index Seite Höhe',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Die Höhe des Chatfenster in Pixel auf der Indexseite des Forums. <br /> <Em> Sie sind von 50 bis 1000 begrenzt </em>.',
	'MCHAT_LOCATION'				=> 'Position im Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Wähle den Speicherort des Mchat auf der Indexseite.',
	'MCHAT_TOP_OF_FORUM'			=> 'Oben im Forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Unterseite des Forums',
	'MCHAT_REFRESH'					=> 'Auffrischen',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Anzahl der Sekunden, bevor der Chat automatisch aktualisiert wird. <br /> <Em> Sie werden von 5 bis 60 Sekunden begrenzt</em>.',
	'MCHAT_PRUNE'					=> 'Löschen aktivieren',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Stelle auf Ja, um die Löschfunktion zu aktivieren. <br /> <Em> Nur tritt auf, wenn ein Benutzer die benutzerdefinierten oder Archivseiten</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Lösch Nr.',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Die Anzahl der Nachrichten, die im Chat verbleiben.',	
	'MCHAT_MESSAGE_LIMIT'			=> 'Nachrichten Limit',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Die maximale Anzahl von Nachrichten im Chat-Bereich zeigen. <br /> <Em> Empfohlen von 10 bis 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Foren-Übersicht Nachrichtenlimit',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Die maximale Anzahl von Nachrichten im Chat-Bereich auf der Indexseite zeigen. <br /> <Em> Empfohlen von 10 bis 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Archiv Limit',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Die maximale Anzahl der Nachrichten, die pro Seite auf der Archivseite angezeigt werden.<br /> <em>Empfohlen von 25 to 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Intervall Zeit',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Die Anzahl der Sekunden die ein Benutzer muss vor der Veröffentlichung eine andere Nachricht im Chat warten muss.<br /><em>Empfohlen von 5 to 30, setze auf 0 um zu deaktivieren</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Max Nachrichten Länge',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Max Anzahl der Zeichen die pro Nachricht zulässig geschrieben werden können.<br /><em>Empfohlen von 100 bis 500, setze auf 0 um zu deaktivieren</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Eigene Seite',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Erlaube die Verwendung einer eigenen Seite',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Benutzerdefinierte Seitenhöhe',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Die Höhe des Chatfenster in Pixel auf der separaten Mchat Seite.<br /><em>Sie sind von 50 bis 1000 begrenzt</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Datums Format',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Der Syntax ist identisch mit der PHP <a href="http://www.php.net/date">Datum()</a> Funktion.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Eigene…',
	'MCHAT_WHOIS'					=> 'Wer ist hier',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Erlaube die Anzeige der Benutzer, die im Chat sind',
	'MCHAT_WHOIS_REFRESH'			=> 'Wer ist hier auffrischen',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Anzahl der Sek. bevor Wer ist hier aktualisiert wird.<br /><em>Es wird von 30 bis 300 Sekunden begrenzt</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'BBCodes nicht erlauben',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Hier kannst du die BBCodes eingeben, die <strong>nicht</strong> in einer Nachricht verwendet werden<br />Separate BBCodes durch einen vertikalen Balken, zum Beispiel: <br />b|i|u|code|list|list=|flash|quote und/oder einen eigenen BBCode Tag Namen',
	'MCHAT_STATIC_MESSAGE'			=> 'Statistische Nachricht',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Hier kannst du eine statische Meldung definieren, die Benutzern des Chats angezeigt wird.  HTML Code ist erlaubt.<br />Set leeren um die Anzeige zu deaktivieren.  Du bist auf 255 Zeichen beschränkt.<br /><strong>Diese Nachricht kann übersetzt werden.</strong>  (Du musst die mchat_lang.php bearbeiten und lies die Instruktionen).',
	'MCHAT_USER_TIMEOUT'			=> 'User Timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Stelle die Zeit in Sekunden, bis eine Benutzer-Session im Chat endet. Setze 0 für kein Timeout.<br /><em>Du bist mit der Forum Konfigurationseinstellung für Sitzungen, die derzeit auf Sekunden eingestellt ist begrenzt</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Überschreibe Limit an Smilies',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Stelle auf Ja, um die Forensmilie Grenzwerteinstellung für Chat-Nachrichten zu überschreiben ',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Überschreibe mindest Zeichen Grenze',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Setze Ja um mindest Zeichen zu überschreiben und die Einstellungen für Chat-Nachrichten einstellen',
	'MCHAT_NEW_POSTS'				=> 'Anzeige neues Posting',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Auf Ja gesetzt, werden neuen Beiträge aus dem Forum in den Chat Nachricht veröffentlicht<br /><strong>Du musst das Add-on für neue Post-Benachrichtigungen installieren</ strong>(im contrib-Verzeichnis der Erweiterung herunterladen).',
	'MCHAT_MAIN'					=> 'Hauptkonfigurations',
	'MCHAT_STATS'					=> 'Wer ist im mChat',
	'MCHAT_STATS_INDEX'				=> 'Statistik im Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Zeige wer chattet im Statistik-Bereich des Forums',
	'MCHAT_MESSAGES'				=> 'Nachrichten Einstellung',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause bei der Eingabe',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Wenn Ja eingestellt ist, wird der Chat nicht für einen Benutzer während der Eingabe einer Nachricht im geupdatet',

	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'Der mChat Mod benötigt eine Aktualisierung. Bitte informiere einen Administrator das eine Aktualisierung nötig ist.',
	'MCHAT_WRONG_VERSION'	=> 'Die falsche Version des Mods ist installiert. Bitte starte den %sinstaller%s für die neue Version des Mods.',
	'WARNING'					=> 'Warnung',
	'TOO_LONG_DATE'		=> 'Das angegebene Datumsformat ist zu lang.',
	'TOO_SHORT_DATE'		=> 'Das angegebene Datumsformat ist zu kurz.',
	'TOO_SMALL_REFRESH'	=> 'Das Aktualisierungsintervall ist zu kurz.',
	'TOO_LARGE_REFRESH'	=> 'Das Aktualisierungsintervall ist zu lang.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Das Nachrichtenlimit ist zu klein.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Das Nachrichtenlimit ist zu groß.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Der Wert des Archivlimits ist zu klein.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Der Wert des Archivlimits ist zu groß.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Das Flood-Intervall ist zu kurz.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Das Flood-Intervall ist zu lang.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'Der Wert der maximalen Nachrichtenlänge ist zu klein.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'Der Wert der maximalen Nachrichtenlänge ist zu groß.',
	'TOO_SMALL_MAX_WORDS_LNGTH'		=> 'Der Wert der maximalen Wortlänge ist zu groß.',	
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'Der Wert für die maximale Wortlänge ist zu groß.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'Der Wert für die Whois-Aktualisierung ist zu klein.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'Der Wert für die Whois-Aktualisierung ist zu groß.',	
	'TOO_SMALL_INDEX_HEIGHT'	=> 'Der Wert für die Höhe des Index ist zu klein.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'Der Wert für die Höhe des Index ist zu groß.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'Der Wert für die Höhe des Chats auf einer separaten Seite ist zu klein.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'Der Wert für die Höhe des Chats auf einer separaten Seite ist zu groß',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'Der Wert für die Länge der permanenten Nachricht ist zu klein.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'Der Wert für die Länge der permanenten Nachricht ist zu groß.',	
	'TOO_SMALL_TIMEOUT'	=> 'Der Wert für die Zeitüberschreitung eines Benutzers ist zu klein.',
	'TOO_LARGE_TIMEOUT'	=> 'Der Wert für die Zeitüberschreitung eines Benutzers ist zu groß.',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat', 
	
	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat Tabelle löschen',
	'ACP_USER_MCHAT'			=> 'mChat Einstellung',
	'LOG_DELETED_MCHAT'      => '<strong>Lösche mChat Nachricht</strong><br />» %1$en',
	'LOG_EDITED_MCHAT'      => '<strong>Editiere mChat Nachricht</strong><br />» %1$en',	
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'   => 'Characters remaining: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'            => 'Top Poster',
	'MCHAT_NEW_CHAT'            => 'Neue mChat Nachricht!',
	'FONT_COLOR'				=> 'Schriftfarbe',
	'FONT_COLOR_HIDE'			=> 'Schriftfarbe ausblenden',
	'FONT_HUGE'					=> 'Riesig',
	'FONT_LARGE'				=> 'Groß',
	'FONT_NORMAL'				=> 'Normal',
	'FONT_SIZE'					=> 'Schriftgröße',
	'FONT_SMALL'				=> 'Klein',
	'FONT_TINY'					=> 'Tiny',
	'MCHAT_SEND_PM'             => 'Sende private Nachricht',
    'MCHAT_PM'                  => '(PN)',
	'MORE_SMILIES'              => 'Mehr Smilies',
));