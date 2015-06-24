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
	'ACP_MCHAT_CONFIG'				=> 'Konfiguration',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Ein Mini-Chat (aka Shoutbox) für dein Forum',
	'MCHAT_TABLE_DELETED'			=> 'Die mChat Tabelle wurde erfolgreich gelöscht',
	'MCHAT_TABLE_CREATED'			=> 'Die mChat Tabelle wurde erfolgreich erstellt',
	'MCHAT_TABLE_UPDATED'			=> 'Die mChat Tabelle wurde erfolgreich upgedated',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Es gibt nichts zu tun....fahre fort',
	'UCP_CAT_MCHAT'					=> 'mChat Präferenzen',
	'UCP_MCHAT_CONFIG'				=> 'mChat Benutzerpräferenzen',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regeln',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Gib deine Regeln hier ein. Jeder Regel in eine neue Zeile.<br />Lass das Feld frei um die Anzeige zu deaktivieren. Das Limit liegt bei 255 Zeichen.<br /><strong>Diese Nachricht kann übersetzt werden.</strong> (editiere hierzu die Datei: mchat_lang.php und lies die Anweisungen).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>mChat-Konfiguration erfolgreich geändert</strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Die mChat-Konfiguration wurde erfolgreich geändert',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Version:',
	'MCHAT_ENABLE'					=> 'mChat MOD aktivieren',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Generelles Aktivieren oder Deaktivieren.',
	'MCHAT_AVATARS'					=> 'Avatare anzeigen',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Wenn JA eingestellt ist, werden Avatare angezeigt',
	'MCHAT_ON_INDEX'				=> 'mChat im Index',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Erlaube die mChat Anzeige auf der Startseite.',
	'MCHAT_INDEX_HEIGHT'			=> 'Seitenhöhe im Index',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Die Höhe der Chat Box in Pixeln auf der Index-Seite des Forums.<br /><em>Du kannst nur von 50 bis 1000 Pixel einstellen</em>.',
	'MCHAT_LOCATION'				=> 'Platzierung im Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Wähle die Position von mChat auf der Startseite.',
	'MCHAT_TOP_OF_FORUM'			=> 'Oberhalb des Forums',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Unterhalb des Forums',
	'MCHAT_REFRESH'					=> 'Aktualisieren',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Die Anzahl Sekunden, bis sich der mChat automatisch aktualisiert. <strong>Nicht unter 5 Sekunden einstellen.</strong>.',
	'MCHAT_PRUNE'					=> 'Automatisches Löschen erlauben',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Stelle JA ein, um die automatische Löschfunktion zu aktivieren.<br /><em>Hat nur Auswirkung, wenn ein Benutzer die separate Seite oder das Archiv betrachtet.</em.',
	'MCHAT_PRUNE_NUM'				=> 'Anzahl verbleibender Nachrichten nach dem automatischem Löschen',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Die Anzahl der Nachrichten, die nach dem Löschen im Chat verbleiben.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Nachrichtenlimit',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Die maximale Anzahl der Nachrichten, die auf der Hauptseite des Forums angezeigt werden soll.<br /><em>Empfohlen sind zwischen 10 und 20</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Nachrichtengrenze',
	'MCHAT_MESSAGE_NUM_EXPLAIN'		=> 'Die maximale Anzahl von Nachrichten im Chat-Bereich die auf der Indexseite angezeigt werden. <br /> <Em> Empfohlen von 10 bis 50 </ em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Archivlimit',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Die maximale Anzahl Nachrichten pro Seite im Archiv.<br /> <em>Empfohlen sind 25 bis 50</e.',
	'MCHAT_FLOOD_TIME'				=> 'Flood-Intervall',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Die Zeit in Sekunden, die ein Benutzer warten muß, bis er eine neue Nachricht im mChat absenden kann.<br /><em>Empfohlen sind 5 bis 30, stelle 0 ein, um die Funktion zu deaktivieren</.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Maximale Nachrichtenlänge',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Die maximal erlaubte Anzahl von Zeichen pro Nachricht.<br /><em>Empfohlen sind 100 bis 500, stelle 0 ein, um die Funktion zu deaktivieren</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Eigenständige Seite',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Erlaubt die Benutzung des Chats auf einer eigenständigen Seite.',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Höhe der eigenen mChat Seite',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Die Höhe der Chat-Box in Pixeln auf der eigenen mChat Seite.<br /><em>Du kannst nur von 50 bis 1000 Pixel einstellen</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Datums-Format',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Die Syntax entspricht der der date()-Funktion von PHP <a href="http://www.php.net/date">date()</a>',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Eigenes…',
	'MCHAT_WHOIS'					=> 'Whois',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Erlaubt es die Benutzer anzuzeigen, die sich gerade auf der mChat-Seite befinden.',
	'MCHAT_WHOIS_REFRESH'			=> 'Whois aktualisieren',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Die Anzahl Sekunden, bis die Whois-anzeige aktualisiert wird.<br /><strong>Nicht unter 30 Sekunden einstellen!</strong>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Nicht erlaubte BBcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Hier kann man BBcodes eintragen, die <strong>nicht</strong> in einer Nachricht verwendet werden dürfen.<br />BBcodes mit einem senkrechten Strich trennen, beispielsweise: b|u|code',
	'MCHAT_STATIC_MESSAGE'			=> 'Permanente Nachricht in der Chatbox',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Hier kannst du eine permanente Nachricht für die Benutzer des mChats eingeben.<br />Lass es frei um keine Nachricht anzuzeigen. Deine Nachricht kann 255 Zeichen umfassen.<br /><strong>Diese Nachricht kann auch übersetzt werden.</strong>	(Editiere hierzu die Datei mchat_lang.php file und lies die Anweisungen.).',
	'MCHAT_USER_TIMEOUT'			=> 'Zeitüberschreitung für Benutzer',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Stelle einen Wert für die Zeitüberschreitung in Sekunden ein, nach der die Sitzung für einen Benutzer im mChat endet. Stelle 0 ein für kein Timeout Limit.<br /><em>Das Limit ist das Selbe, wie in deinen %sForum Einstellungen für Sitzungen%s. Derzeit beträgt dieser Wert %s Sekunden.</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Smilielimit überschreiben?',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Falls JA eingestellt ist, wird das eingestellte Limit im Forum für Smilies im mChat aufgehoben.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Minimale Anzahl von Zeichen aufheben?',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Falls ja eingestellt ist, wird das Limit für die minimale Anzahl an Zeichen für mChat-Nachrichten aufgehoben.',
	'MCHAT_NEW_POSTS'				=> 'Zeige aktivierte Beiträge an',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Stelle auf Ja, und setze unter den Optionen, welche Nachricht im Chat-Nachrichtenbereich angezeigt werden können..',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Zeige New Topic Beiträge an',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Stelle auf Ja, damit neue Themen und Beiträge aus dem Forum im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Zeige neue Antworten in Beiträgen an',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Stelle auf Ja, damit beantwortete Beiträge aus dem Forum im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Zeige editierte Beiträge an',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Stelle auf Ja, damit bearbeitete Beiträge aus dem Forum	im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Zeige zitierte Beiträge an',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Stelle auf Ja, damit die zitierten Beiträge aus dem Forum im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_MAIN'					=> 'Hauptkonfiguration',
	'MCHAT_STATS'					=> 'Wer ist im mChat?',
	'MCHAT_STATS_INDEX'			=> 'Anzeige auf dem Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Zeigt auf dem Index an wer im Mini-Chat ist.',
	'MCHAT_MESSAGE_TOP'				=> 'Nachricht unten / oben',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Hier kannst Du einstellen, ob der Nachrichtenbereich oben oder unten angezeigt werden soll.',
	'MCHAT_BOTTOM'					=> 'Unten',
	'MCHAT_TOP'						=> 'Oben',
	'MCHAT_MESSAGES'				=> 'Nachrichten-Einstellungen',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Den Chat während einer Nachrichteneingabe nicht aktualisieren',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Falls JA eingestellt ist, ist das automatische Aktualisieren während der Eingabe einer Nachricht deaktiviert.',

	// error reporting
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

	// User perms
	'ACL_U_MCHAT_USE'			=> 'Kann mChat benutzen',
	'ACL_U_MCHAT_VIEW'			=> 'Kann mChat sehen',
	'ACL_U_MCHAT_EDIT'			=> 'Kann mChat bearbeiten',
	'ACL_U_MCHAT_DELETE'		=> 'Kann mChat Nachricht löschen',
	'ACL_U_MCHAT_IP'			=> 'Kann mChat IP sehen',
	'ACL_U_MCHAT_PM'			=> 'Kann Private Nachricht im mChat verwenden',
	'ACL_U_MCHAT_LIKE'			=> 'Kann "gefällt mir" Nachrichten im mChat verwenden',
	'ACL_U_MCHAT_QUOTE'			=> 'Kann Zitate im mChat verwenden',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Kann den mChat Flood ignorieren',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Kann das mChat Archiv sehen',
	'ACL_U_MCHAT_BBCODE'		=> 'Kann BBCode im mChat verwenden',
	'ACL_U_MCHAT_SMILIES'		=> 'Kann Smilies im mChat verwenden',
	'ACL_U_MCHAT_URLS'			=> 'Kann Url im mChat posten',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Kann mChat Einstellung managen',

));