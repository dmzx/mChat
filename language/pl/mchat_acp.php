<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
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
	'MCHAT_SETTINGS_INDEX'							=> 'Ustawienia strony głównej',
	'MCHAT_SETTINGS_CUSTOM'							=> 'Ustawienia niestandardowej strony',
	'MCHAT_SETTINGS_ARCHIVE'						=> 'Ustawienia archiwum',
	'MCHAT_SETTINGS_POSTS'							=> 'Ustawienia nowych postów',
	'MCHAT_SETTINGS_MESSAGES'						=> 'Ustawienia wiadomści',
	'MCHAT_SETTINGS_PRUNE'							=> 'Pruning settings (adjustable for founders only)',
	'MCHAT_SETTINGS_STATS'							=> 'Who is chatting settings',

	'MCHAT_GLOBALUSERSETTINGS_EXPLAIN'				=> 'Settings for which a user does <strong>not</strong> have permission to customise are applied as configured below.<br />New user accounts will have initial settings as configured below.<br /><br />Go to the <em>mChat in UCP</em> tab of the user permissions section to adjust customisation permissions.<br />Go to the <em>Preferences</em> form in the <em>user management</em> section to see the status of each user’s settings.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE'			=> 'Nadpisz ustawienia dla wszystkich użytkowników',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_EXPLAIN'	=> 'Applies the settings as defined above to <em>all</em> user accounts.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_CONFIRM'	=> 'Potwierdź nadpisanie ustawień mChat dla wszystkich użytkowników',


	'MCHAT_ACP_USER_PREFS_EXPLAIN'					=> 'Below are listed all mChat preferences of the selected user. Settings for which the selected user does not have permission to customise are disabled. These settings can be changed in the <em>Global user settings</em> mChat configuration section.',

	// ACP settings
	'MCHAT_ACP_CHARACTERS'							=> 'znaków',
	'MCHAT_ACP_MESSAGES'							=> 'wiadomości',
	'MCHAT_ACP_SECONDS'								=> 'sekund',
	'MCHAT_ACP_HOURS'								=> 'godzin',
	'MCHAT_ACP_DAYS'								=> 'dni',
	'MCHAT_ACP_WEEKS'								=> 'tygodni',
	'MCHAT_ACP_GLOBALSETTINGS_TITLE'				=> 'Globalne ustawienia mChat',
	'MCHAT_ACP_GLOBALUSERSETTINGS_TITLE'			=> 'Globalne ustawienia użytkownika mChat',
	'MCHAT_VERSION'									=> 'Wersja',
	'MCHAT_RULES'									=> 'Reguły',
	'MCHAT_RULES_EXPLAIN'							=> 'Wpisz tutaj swoje reguły. Dozwolony jest format HTML. <em>Jesteś ograniczony do 255 znaków.</em><br />This message can be translated: edit the MCHAT_RULES_MESSAGE language key in /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_CONFIG_SAVED'							=> 'Konfiguracja mChat została zaktualizowana',
	'MCHAT_AVATARS'									=> 'Wyświetlaj awatary',
	'MCHAT_AVATARS_EXPLAIN'							=> 'Jeżeli zaznaczone, zostaną wyświetlone przeskalowane awatary użytkowników',
	'MCHAT_INDEX'									=> 'Wyświetlaj mChat na stronie głównej',
	'MCHAT_INDEX_HEIGHT'							=> 'Wysokość',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'					=> 'Wysokość okna czatu na stronie głównej, wyrażona w pikselach.<br /><em>Jesteś ograniczony od 50 do 1000 pikseli. Domyślną wartością jest 250.</em>',
	'MCHAT_TOP_OF_FORUM'							=> 'Na górze',
	'MCHAT_BOTTOM_OF_FORUM'							=> 'Na dole',
	'MCHAT_REFRESH'									=> 'Czas odwieżania',
	'MCHAT_REFRESH_EXPLAIN'							=> 'Liczba sekund - określają, co ile sekund czat będzie odświeżany.<br /><em>Jesteś ograniczony od 5 do 60 sekund. Domyślną wartością jest 10.</em>',
	'MCHAT_LIVE_UPDATES'							=> 'Aktualizacje live dla edytowanych i usuniętych wiadomości',
	'MCHAT_LIVE_UPDATES_EXPLAIN'					=> 'Kiedy użytkownik zedytuje lub usunie wiadomość, zostanie to zaktualizowane dla wszystkich innych osób - bez konieczności odświeżania strony. Wyłącz, jeżeli doświadczasz problemów z wydajnością.',
	'MCHAT_PRUNE'									=> 'Enable message pruning',
	'MCHAT_PRUNE_GC'								=> 'Message prune task interval',
	'MCHAT_PRUNE_GC_EXPLAIN'						=> 'The time in seconds that needs to pass before the next message pruning is triggered. Note: this setting controls <em>when</em> messages are checked if they can be deleted. It does <em>not</em> control <em>which</em> messages are deleted. <em>Default is 86400 = 24 hours.</em>',
	'MCHAT_PRUNE_NUM'								=> 'Messages to retain when pruning',
	'MCHAT_PRUNE_NUM_EXPLAIN'						=> 'When using ’messages’ a fixed number of messages will be kept. When using ’hours’, ’days’ or ’weeks’ all messages older than the specified time period at the time of pruning will be deleted.',
	'MCHAT_PRUNE_NOW'								=> 'Prune messages now',
	'MCHAT_PRUNE_NOW_CONFIRM'						=> 'Confirm pruning messages',
	'MCHAT_PRUNED'									=> '%1$d mChat messages have been pruned',
	'MCHAT_NAVBAR_LINK'								=> 'Pokazuj link do niestandardowej strony na pasku nawigacyjnym.',
	'MCHAT_NAVBAR_LINK_COUNT'						=> 'Pokazuj licznik aktywnych sesji czatu na pasku nawigacyjnym.',
	'MCHAT_MESSAGE_NUM_CUSTOM'						=> 'Całkowita liczba wiadomości wyświetlanych na stronie niestandardowej',
	'MCHAT_MESSAGE_NUM_CUSTOM_EXPLAIN'				=> '<em>Jesteś ograniczony od 5 do 50 wiadomości. Domyślną wartością jest 10.</em>',
	'MCHAT_MESSAGE_NUM_INDEX'						=> 'Całkowita liczba wiadomości wyświetlanych na stronie głównej',
	'MCHAT_MESSAGE_NUM_INDEX_EXPLAIN'				=> '<em>Jesteś ograniczony od 5 do 50 wiadomości. Domyślną wartością jest 10.</em>',
	'MCHAT_MESSAGE_NUM_ARCHIVE'						=> 'Liczba wiadomości wyświetlanych w archiwum.',
	'MCHAT_MESSAGE_NUM_ARCHIVE_EXPLAIN'				=> 'Masymalna liczba wiadomości wyświetlanych w archiwum.<br /><em>Jesteś ograniczony od 10 do 100 wiadomości. Domyślną wartością jest 25.</em>',
	'MCHAT_ARCHIVE_SORT'							=> 'Sortowanie wiadomości',
	'MCHAT_ARCHIVE_SORT_TOP_BOTTOM'					=> 'Zawsze sortuj wiadomości od góry do dołu',
	'MCHAT_ARCHIVE_SORT_BOTTOM_TOP'					=> 'Zawsze sortuj wiadomości od dołu do góry',
	'MCHAT_ARCHIVE_SORT_USER'						=> 'Sort messages depending on the user’s <em>Location of new messages</em> preference',
	'MCHAT_FLOOD_TIME'								=> 'Limit czasowy wiadomości z rzędu',
	'MCHAT_FLOOD_TIME_EXPLAIN'						=> 'Liczba sekund oczekiwania użytkownika na wysłanie następnej wiadomości z rzędu.<br /><em>Jesteś ograniczony od 0 do 60 sekund. Domyślną wartością jest 0. Ustaw 0, aby wyłączyć.</em>',
	'MCHAT_EDIT_DELETE_LIMIT'						=> 'Limit czasu edytowania i usuwania wiadomości',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'				=> 'Wiadomości starsze niż określona liczba sekund nie mogą zostać edytowane lub usunięte przez autora.<br />Użytkownicy, którzy mają <em>uprawnienia do edytowania/usuwania, jak i również moderatorzy</em>, są zwolnieni z tego limitu czasu.<br />Ustaw 0, aby umożliwić nielimitowane edytowanie i usuwanie wiadomości.',
	'MCHAT_MAX_MESSAGE_LENGTH'						=> 'Maksymalna długość wiadomości',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'				=> 'Maksymalna liczba znaków dozwolonych w jednej wiadomości.<br /><em>Jesteś ograniczony od 0 do 1000 znaków. Domyślną wartością jest 500. Ustaw 0, aby wyłączyć.</em>',
	'MCHAT_CUSTOM_PAGE'								=> 'Włącz niestandardową stronę',
	'MCHAT_CUSTOM_HEIGHT'							=> 'Wysokość',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'					=> 'Wysokość okna czatu na stronie niestandardowej, wyrażona w pikselach.<br /><em>Jesteś ograniczony od 50 do 1000 pikseli. Domyślną wartością jest 250.</em>',
	'MCHAT_BBCODES_DISALLOWED'						=> 'Zabronione znaczniki BBCode',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'				=> 'Tutaj możesz umieścić znaczniki BBCode, które <strong>nie mogą</strong> zostać użyte w wiadomości.<br />Oddziel je za pomocą kreski pionowej, np.: <br />b|i|u|code|list|list=|flash|quote lub/i %1$scustom bbcode tag name%2$s',
	'MCHAT_STATIC_MESSAGE'							=> 'Stała wiadomość',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'					=> 'Tutaj możesz określić stałą wiadomość, która ma być wyświetlana dla użytkowników czatu. Dozwolony jest fromat HTML.<br />Pozostaw puste, aby wyłączyć wyświetlanie. <em>Jesteś ograniczony do 255 znaków.</em><br />This message can be translated: edit the MCHAT_STATIC_MESSAGE language key in /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_TIMEOUT'									=> 'Maksymalny czas sesji',
	'MCHAT_TIMEOUT_EXPLAIN'							=> 'Ustaw liczbę sekund, po których zakończy się sesja czatu.<br />Ustaw 0, aby nie sesja nie została zakończona. Bądź ostrożny, ponieważ sesja użytkownika mChat nigdy się nie wygaśnie!<br /><em>Jesteś ograniczony wg %1$sustawień konfiguracji forum dla sesji%2$s, która jest obecnie ustawiona na %3$d sekund</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'					=> 'Znieś limit emotek',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'			=> 'Ustaw tak, aby znieść ustawienia forum limitu emotek dla wiadomości czatu',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'					=> 'Znieś minimalny limit znaków wiadomości',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'			=> 'Ustaw tak, aby znieść ustawienia forum minimalnego limitu znaków dla wiadomości czatu',

	'MCHAT_WHOIS_REFRESH'							=> 'Czas odświeżania <em>kto czatuje</em>',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'					=> 'określają, co ile sekund <em>kto czatuje</em> będzie odświeżany.<br /><em>Jesteś ograniczony od 10 do 300 sekund. Domyślną warością jest 60.</em>',
	'MCHAT_SOUND'									=> 'Play sounds for new, edited and deleted messages',
	'MCHAT_PURGE'									=> 'Delete all messages now',
	'MCHAT_PURGE_CONFIRM'							=> 'Confirm deleting all messages',
	'MCHAT_PURGED'									=> 'All mChat messages have been successfully deleted',

	// '%1$s' contains 'Retain posts' and 'Delete posts' respectively
	'MCHAT_RETAIN_MESSAGES'							=> '%1$s and retain mChat messages',
	'MCHAT_DELETE_MESSAGES'							=> '%1$s and delete mChat messages',

	// Error reporting
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'				=> 'The disallowed bbcodes value is too long.',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'					=> 'Wartość niestandardowej wysokości jest zbyt mała.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'					=> 'Wartość niestandardowej wysokości jest zbyt duża.',
	'TOO_LONG_MCHAT_DATE'							=> 'Format daty jest zbyt długi.',
	'TOO_SHORT_MCHAT_DATE'							=> 'Format daty jest zbyt krótki.',
	'TOO_SMALL_MCHAT_FLOOD_TIME'					=> 'The flood time value is too small.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'					=> 'The flood time value is too large.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'					=> 'Wartość wysokości jest zbyt mała.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'					=> 'Wartość wysokości jest zbyt duża.',
	'TOO_SMALL_MCHAT_MAX_MESSAGE_LNGTH'				=> 'Maksymalna długość wiadomości jest zbyt mała.',
	'TOO_LARGE_MCHAT_MAX_MESSAGE_LNGTH'				=> 'Maksymalna długość wiadomości jest zbyt duża.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'Liczba wiadmości do wyświetlenia na niestandardowej stronie jest zbyt mała.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'Liczba wiadmości do wyświetlenia na niestandardowej stronie jest zbyt duża.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_INDEX'				=> 'Liczba wiadmości do wyświetlenia na stronie głównej jest zbyt mała.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_INDEX'				=> 'Liczba wiadmości do wyświetlenia na stronie głównej jest zbyt duża.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'Liczba wiadmości do wyświetlenia w archiwum jest zbyt mała.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'Liczba wiadmości do wyświetlenia w archiwum jest zbyt duża.',
	'TOO_SMALL_MCHAT_REFRESH'						=> 'Wartość odświeżania jest zbyt mała.',
	'TOO_LARGE_MCHAT_REFRESH'						=> 'Wartość odświeżania jest zbyt duża.',
	'TOO_LONG_MCHAT_STATIC_MESSAGE'					=> 'Stała wiadomość jest zbyt długa',
	'TOO_SMALL_MCHAT_TIMEOUT'						=> 'Wartość maksymalnego czasu sesji użytkownika jest zbyt mała.',
	'TOO_LARGE_MCHAT_TIMEOUT'						=> 'Wartość maksymalnego czasu sesji użytkownika jest zbyt duża.',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'					=> 'Wartość odświeżania <em>kto czatuje</em> jest zbyt mała.',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'					=> 'Wartość odświeżania <em>kto czatuje</em> jest zbyt duża.',

	'MCHAT_30X_REMNANTS'							=> 'Instalacja została przerwana.<br />Pozostały moduły dla mChat MOD dla phpBB 3.0.x w bazie danych. mChat nie działa z nimi prawidłowo.<br />Musisz całkowicie odinstalować mChat MOD przed instalacją rozszerzenia. Konkretnie rzecz mówiąc, moduły z poniższymi ID muszą zostać usunięte z %1$tabeli modułów: %2$s',
));
