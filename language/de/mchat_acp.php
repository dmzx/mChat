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
	'MCHAT_SETTINGS_INDEX'					=> 'Index Seite Einstellungen',
	'MCHAT_SETTINGS_CUSTOM'					=> 'Benutzer Seite Einstellungen',
	'MCHAT_SETTINGS_ARCHIVE'				=> 'Archiv Seite Einstellungen',
	'MCHAT_SETTINGS_POSTS'					=> 'Neue Beiträge Einstellungen',
	'MCHAT_SETTINGS_MESSAGES'				=> 'Nachrichten Einstellungen',
	'MCHAT_SETTINGS_PRUNE'					=> 'Bereinigungseinstellungen',
	'MCHAT_SETTINGS_STATS'					=> 'Wer ist im Chat Einstellungen',

	'MCHAT_GLOBALUSERSETTINGS_EXPLAIN'		=> 'Einstellungen, für die ein Benutzer <strong>keine</ strong> Berechtigung hat sie anzupassen, sind wie folgt vordefiniert.<br />Gehe auf die <em> mChat im UCP </ em> Registerkarte des Berechtigungen Bereichs --> Benutzerrechte --> Benutzer-Berechtigungen um die Einstellungen anzupassen.<br />Gehe auf die <em>Effektive Berechtigungen</em> Seite im Berechtigungen Bereich --> Benutzer-Berechtigungen anzeigen --> Benutzer anzeigen --> um den Status der mChat Berechtigungen anzuzeigen.',

	// ACP settings
	'MCHAT_ACP_GLOBALSETTINGS_TITLE'		=> 'mChat Globale Einstellungen',
	'MCHAT_ACP_GLOBALUSERSETTINGS_TITLE'	=> 'mChat Globale Benutzer Einstellungen',
	'MCHAT_VERSION'							=> 'Version',
	'MCHAT_RULES'							=> 'Regeln',
	'MCHAT_RULES_EXPLAIN'					=> 'Gib Deine Regeln hier ein. Jede Regel in eine neue Zeile.<br />Lass das Feld frei um die Anzeige zu deaktivieren. Das Limit liegt bei 255 Zeichen.<br /><strong>Diese Nachricht kann übersetzt werden.</strong> (editiere hierzu die Datei: /ext/dmzx/mchat/language/XX/mchat.php und passe die Variable MCHAT_RULES_MESSAGE an).',
	'MCHAT_CONFIG_SAVED'					=> 'mChat-Konfiguration erfolgreich aktualisiert',
	'MCHAT_AVATARS'							=> 'Zeige Avatare',
	'MCHAT_AVATARS_EXPLAIN'					=> 'Wenn ja gesetzt ist, werden in der Größe angepasste Benutzer Avatare angezeigt.',
	'MCHAT_INDEX'							=> 'Ermöglicht die Anzeige des mChat auf der Indexseite',
	'MCHAT_INDEX_HEIGHT'					=> 'Index Seiten Höhe',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'			=> 'Die Höhe der Chat Box in Pixeln auf der Index-Seite des Forums.<br /><em>Du kannst nur von 50 bis 1000 Pixel einstellen. Standardwert ist 250</em>.',
	'MCHAT_TOP_OF_FORUM'					=> 'Oben',
	'MCHAT_BOTTOM_OF_FORUM'					=> 'Unten',
	'MCHAT_REFRESH'							=> 'Automatische Aktualisierung',
	'MCHAT_REFRESH_EXPLAIN'					=> 'Anzahl der Sekunden, bevor Chat automatisch aktualisiert wird.<br /><em>Ist zwischen 5 bis 60 Sekunden begrenzt. Standardwert ist 10</em>.',
	'MCHAT_LIVE_UPDATES'					=> 'Live Updates von bearbeiteten und gelöschten Nachrichten',
	'MCHAT_LIVE_UPDATES_EXPLAIN'			=> 'Wenn ein Benutzer Nachrichten bearbeitet oder löscht, werden die Änderungen für alle anderen live aktualisiert, ohne dass sich die Seite neu lädt. Deaktiviere diese Option, wenn Leistungsprobleme auftreten.',
	'MCHAT_PRUNE'							=> 'Automatische Bereinigung erlauben',
	'MCHAT_PRUNE_EXPLAIN'					=> 'Hat nur Auswirkung, wenn ein Benutzer die separate Seite oder das Archiv betrachtet.',
	'MCHAT_PRUNE_NUM'						=> 'Anzahl verbleibender Nachrichten nach dem automatischem Bereinigen',
	'MCHAT_NAVBAR_LINK'						=> 'Zeige einen Link zur separaten Seite in der Navigation an',
	'MCHAT_MESSAGE_NUM_CUSTOM'				=> 'Anzahl der Nachrichten die auf der separaten Seite angezeigt werden soll',
	'MCHAT_MESSAGE_NUM_CUSTOM_EXPLAIN'		=> '<em>Begrenzt zwischen 5 bis 50. Standardwert ist 10.</em>',
	'MCHAT_MESSAGE_NUM_INDEX'				=> 'Anzahl der Nachrichten die auf der Index Seite angezeigt werden soll',
	'MCHAT_MESSAGE_NUM_INDEX_EXPLAIN'		=> '<em>Begrenzt zwischen 5 bis 50. Standardwert ist 10.</em>',
	'MCHAT_MESSAGE_NUM_ARCHIVE'				=> 'Anzahl der Nachrichten die auf einer Archiv Seite dargestellt werden soll',
	'MCHAT_MESSAGE_NUM_ARCHIVE_EXPLAIN'		=> 'Die maximale Anzahl Nachrichten pro Seite im Archiv.<br /><em>Empfohlen sind 10 bis 100. Standardwert ist 25</em>',
	'MCHAT_FLOOD_TIME'						=> 'Flood-Intervall',
	'MCHAT_FLOOD_TIME_EXPLAIN'				=> 'Die Zeit in Sekunden, die ein Benutzer warten muß, bis er eine neue Nachricht im mChat absenden kann.<br /><em>Empfohlen sind 5 bis 30. Standarwert ist 0. Stelle 0 ein, um die Funktion zu deaktivieren</em>',
	'MCHAT_EDIT_DELETE_LIMIT'				=> 'Frist für die Bearbeitung und das Löschen von Nachrichten',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'		=> 'Nachrichten, die älter als die angegebene Anzahl von Sekunden können vom Autor nicht mehr bearbeitet oder gelöscht werden.<br />Benutzer, die <em>bearbeiten/löschen</em> dürfen sind von dieser Frist ausgenommen. <br />Bei 0 wird unbegrenztes Bearbeiten und Löschen ermöglicht.',
	'MCHAT_MAX_MESSAGE_LENGTH'				=> 'Maximale Nachrichtenlänge',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'		=> 'Die maximal erlaubte Anzahl von Zeichen pro Nachricht.<br /><em>Empfohlen sind 100 bis 1000. Standardwert ist 500. Stelle 0 ein, um die Funktion zu deaktivieren</em>.',
	'MCHAT_CUSTOM_PAGE'						=> 'Separate Seite',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'				=> 'Erlaubt die Benutzung des Chats auf einer separaten Seite.',
	'MCHAT_CUSTOM_HEIGHT'					=> 'Höhe der separaten Seite',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'			=> 'Die Höhe der Chat-Box in Pixeln auf der separaten mChat Seite.<br /><em>Du kannst nur von 50 bis 1000 Pixel einstellen. Standardwert ist 350</em>.',
	'MCHAT_BBCODES_DISALLOWED'				=> 'Nicht erlaubte BBcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'		=> 'Hier kann man BBcodes eintragen, die <strong>nicht</strong> in einer Nachricht verwendet werden dürfen.<br />BBcodes mit einem senkrechten Strich trennen, beispielsweise:<br />b|i|u|code|list|list=|flash|quote und/oder einem %1$sBenutzer definierten bbcode Code Namen%2$s',
	'MCHAT_STATIC_MESSAGE'					=> 'Permanente Nachricht in der Chatbox',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'			=> 'Hier kannst du eine permanente Nachricht für die Benutzer des mChats eingeben.<br />Lass es frei um keine Nachricht anzuzeigen. Deine Nachricht kann 255 Zeichen umfassen.<br /><strong>Diese Nachricht kann auch übersetzt werden.</strong> (Editiere hierzu die Datei /ext/dmzx/mchat/language/XX/mchat.php und passe die Variable MCHAT_STATIC_MESSAGE an)',
	'MCHAT_USER_TIMEOUT'					=> 'Zeitüberschreitung für Benutzer',
	'MCHAT_USER_TIMEOUT_EXPLAIN'			=> 'Stelle einen Wert für die Zeitüberschreitung in Sekunden ein, nach der die Sitzung für einen Benutzer im mChat endet. Stelle 0 ein für kein Timeout Limit.<br /><em>Das Limit ist das Selbe, wie in Deinen %1$sForum Einstellungen für Sitzungen%2$s. Derzeit beträgt dieser Wert %3$s Sekunden.</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Smilie Limit überschreiben?',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Falls JA eingestellt ist, wird das im Forum eingestellte Limit für Smilies im mChat aufgehoben.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'			=> 'Minimale Anzahl von Zeichen aufheben?',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Falls ja eingestellt ist, wird das Limit für die minimale Anzahl an Zeichen für mChat-Nachrichten aufgehoben.',

	'MCHAT_WHOIS_REFRESH'					=> 'Whois aktualisieren',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'			=> 'Die Anzahl Sekunden, bis die Whois-Anzeige aktualisiert wird.<br /><em>Du kannst nur zwischen 10 und 300 Sekunden einstellen. Standardwert ist 60.</em>',
	'MCHAT_SOUND'							=> 'Spiele Sounds für neue, geänderte und gelöschte Nachrichten',
	'MCHAT_PURGE'							=> 'Lösche alle Nachrichten',
	'MCHAT_PURGE_CONFIRM'					=> 'Bitte bestätige, dass Du alle Nachrichten endgültig löschen möchtest',
	'MCHAT_PURGED'							=> 'Alle mChat Nachrichten wurden erfolgreich gelöscht',

	// Error reporting
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'		=> 'Die Anzahl der verbotenen BBCodes ist zu groß',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'			=> 'Der Wert für die Höhe des Chats auf einer separaten Seite ist zu klein.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'			=> 'Der Wert für die Höhe des Chats auf einer separaten Seite ist zu groß',
	'TOO_LONG_MCHAT_DATE'					=> 'Das angegebene Datumsformat ist zu lang.',
	'TOO_SHORT_MCHAT_DATE'					=> 'Das angegebene Datumsformat ist zu kurz.',
	'TOO_SMALL_MCHAT_FLOOD_TIME'			=> 'Das Flood-Intervall ist zu kurz.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'			=> 'Das Flood-Intervall ist zu lang.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'			=> 'Der Wert für die Höhe des Index ist zu klein.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'			=> 'Der Wert für die Höhe des Index ist zu groß.',
	'TOO_SMALL_MCHAT_MAX_MESSAGE_LNGTH'		=> 'Der Wert der maximalen Nachrichtenlänge ist zu klein.',
	'TOO_LARGE_MCHAT_MAX_MESSAGE_LNGTH'		=> 'Der Wert der maximalen Nachrichtenlänge ist zu groß.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_CUSTOM'	=> 'Die Anzahl der Nachrichten die auf der separaten Seite angezeigt werden soll ist zu klein',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_CUSTOM'	=> 'Die Anzahl der Nachrichten die auf der separaten Seite angezeigt werden soll ist zu groß',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_INDEX'		=> 'Die Anzahl der Nachrichten die auf der Index Seite angezeigt werden soll ist zu klein',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_INDEX'		=> 'Die Anzahl der Nachrichten die auf der Index Seite angezeigt werden soll ist zu groß',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_ARCHIVE'	=> 'Die Anzahl der Nachrichten die auf einer Archiv Seite dargestellt werden soll ist zu klein',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_ARCHIVE'	=> 'Die Anzahl der Nachrichten die auf einer Archiv Seite dargestellt werden soll ist zu groß',
	'TOO_SMALL_MCHAT_REFRESH'				=> 'Der Wert für die automatische Aktualisierung ist zu klein',
	'TOO_LARGE_MCHAT_REFRESH'				=> 'Der Wert für die automatische Aktualisierung ist zu groß',
	'TOO_LONG_MCHAT_STATIC_MESSAGE'			=> 'Die Permanente Nachricht in der Chatbox ist zu lang',
	'TOO_SMALL_MCHAT_TIMEOUT'				=> 'Der Wert für die Zeitüberschreitung für Benutzer ist zu klein',
	'TOO_LARGE_MCHAT_TIMEOUT'				=> 'Der Wert für die Zeitüberschreitung für Benutzer ist zu groß',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'			=> 'Der Wert für die Whois Aktualisierung ist zu klein',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'			=> 'Der Wert für die Whois Aktualisierung ist zu groß',
));
