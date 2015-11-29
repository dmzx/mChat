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
	'ACP_MCHAT_CONFIG'				=> 'Ustawienia',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'mChat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'mChat dla Twojego forum',
	'MCHAT_TABLE_DELETED'			=> 'Tabela mChat została pomyślnie usunięta',
	'MCHAT_TABLE_CREATED'			=> 'Tabela mChat została pomyślnie stworzona',
	'MCHAT_TABLE_UPDATED'			=> 'mChat został pomyślnie zaktualizowany',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Nie ma nic do zrobienia... kontynuuj',
	'UCP_CAT_MCHAT'					=> 'Ustawienia mChat',
	'UCP_MCHAT_CONFIG'				=> 'Preferencje użytkownika',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regulamin',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Tutaj wprowadź regulamin mChat. Każdy podpunkt w oddzielnej lini.<br />Limit wprowadzonych znaków 255.<br />',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Aktualizuj konfigurację mChat</strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Zaktualizowano konfigurację mChat',
	'MCHAT_TITLE'					=> 'mChat',
	'MCHAT_VERSION'					=> 'Wersja:',
	'MCHAT_ENABLE'					=> 'Włącz rozszerzenie mChat',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Włącz lub wyłącz rozszerzenie globalnie.',
	'MCHAT_AVATARS'					=> 'Wyświetlaj avatary',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Zaznacz TAK, aby wyświetlać miniaturki avatarów.',
	'MCHAT_ON_INDEX'				=> 'mChat na stronie głównej forum',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Zezwól na wyświetlanie mChat na stronie głównej forum.',
	'MCHAT_INDEX_HEIGHT'			=> 'Wysokość mChat na stronie głównej forum',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Wysokość okna rozmowy w pikselach na stronie głównej forum.<br /><em>Limit wynosi od 50 do 1000</em>.',
	'MCHAT_LOCATION'				=> 'Lokalizacja na forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Wybierz lokalizację mChat na stronie głównej forum.',
	'MCHAT_TOP_OF_FORUM'			=> 'Góra',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Dół',
	'MCHAT_REFRESH'					=> 'Odśwież',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Po ilu sekundach nastąpi automatyczne odświeżanie.<br /><em>Limit wynosi od 5 do 60 sekund</em>.',
	'MCHAT_PRUNE'					=> 'Włacz automatyczne usuwanie wiadomości mChat',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Jeśli zaznaczono TAK, wiadomości będą automatycznie usuwane z archiwum.',
	'MCHAT_PRUNE_NUM'				=> 'Limit zachowanych wiadomości w archiwum',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Wpisz liczbę',
	'MCHAT_MESSAGE_LIMIT'			=> 'Limit wiadomości',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Maksymalna ilość wiadomości wyświetlana na stronie głównej mChat.<br /><em>Rekomendowane od 10 do 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limit wiadomości na stronie głównej forum',
	'MCHAT_MESSAGE_NUM_EXPLAIN'		=> 'Maksymalna ilość wiadomości wyświetlana w mChat na stronie głównej forum.<br /><em>Rekomendowane od 10 do 30</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limit Archiwum',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Maksymalna ilość wiadomości wyświetlana na jednej stronie archiwum.<br /> <em>Rekomendowane od 25 do 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Czas blokady antyspamowej',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Ilość sekund jaką musi odczekać użytkownik, aby wysłać następną wiadomość.<br /><em>Rekomendowane od 5 do 30, ustaw 0 aby wyłączyć limit</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Maksymalna długośc wiadomości',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Maksymalna ilość znaków jaką można użyć w jednej wiadomości.<br /><em>Rekomendowane od 100 do 500, ustaw 0 aby wyłączyć limit</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Strona główna mChat',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Zewól na używanie strony głównej mChat',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Wysokość strony głównej mChat',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Wysokość okna rozmowy w pikselach na osobnej stronie mChat.<br /><em>Limit wynosi od 50 do 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Format Daty',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Użyta składnia jest taka sama jak w <a href="http://www.php.net/date">PHP</a>.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Niestandardowa…',
	'MCHAT_WHOIS'					=> 'Kto aktualnie czatuje',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Pozwala na wyświetlanie użytkowników, którzy aktualnie korzystają z mChat',
	'MCHAT_WHOIS_REFRESH'			=> 'Odświeżanie czatujących użytkowników',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Po ilu sekundach nastąpi automatyczne odświeżanie czatujących użytkowników.<br /><em>Limit wynosi od 30 do 300 sekund</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Niedozwolone BBCodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Tutaj umieść BBCodes, których nie można używać w wiadomościach.<br />Oddziel BBCodes pionową kreską, na przykład: <br />b|i|u|code|list|list=|flash|quote',
	'MCHAT_STATIC_MESSAGE'			=> 'Ogłoszenie',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Tutaj możesz umieścić ogłoszenie, które wyświetli się użytkownikom mChat.	Kod HTML jest dozwolony.<br />Zostaw puste, aby wyłączyć wyświetlanie.	Limit znaków to 255.<br /></strong>',
	'MCHAT_USER_TIMEOUT'			=> 'Limit czasu dla użytkownika',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Ustaw czas w sekundach do zakończenia sesji użytkownika. Ustaw 0, aby wyłączyć.<br /><em>Limit znajdziesz %stutaj%s, aktualnie jest ustawione na %s sekund</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Limit emotikon',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Zaznacz TAK, aby włączyć limit emotikon używanych w wiadomościach mChat.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Limit znaków',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Zaznacz TAK, aby włączyć limit znaków używanych w wiadomościach mChat.',
	'MCHAT_NEW_POSTS'				=> 'Włącz wyświetlanie postów',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Zaznacz TAK i wybierz opcje poniżej, aby wyświetlić nowe posty lub tematy w mChat.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Pokaż nowe tematy',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Zaznacz TAK, aby pokazywać nowe tematy w mChat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Pokaż nowe posty',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Zaznacz TAK, aby pokazać nowe posty w mChat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Pokaż edytowane posty',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Zaznacz TAK, aby pokazać edytowane posty w mChat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Pokaż cytowane posty',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Zaznacz TAK, aby pokazać cytowane posty w mChat.',
	'MCHAT_MAIN'					=> 'Główne ustawienia',
	'MCHAT_STATS'					=> 'Kto czatuje?',
	'MCHAT_STATS_INDEX'				=> 'Statystyki mChat',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Pokaż statystyki użytkowników mChat.',
	'MCHAT_MESSAGE_TOP'				=> 'Nowa wiadomość na górze/dole czatu',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Nowa wiadomość zostanie dodana na górze albo dole mChat.',
	'MCHAT_BOTTOM'					=> 'Góra',
	'MCHAT_TOP'						=> 'Dół',
	'MCHAT_MESSAGES'				=> 'Ustawienia wiadomości',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Automatyczna aktualizacja podczas pisania wiadomości',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Zaznacz TAK, aby automatycznie aktualizować mChat, gdy użytkownik pisze wiadomość.',

	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'Rozszerzenie mChat musi zostać zaktualizowane. Proszę skontaktuj się z administratorem.',
	'MCHAT_WRONG_VERSION'	=> 'Zainstalowano złą wersję rozszerzenia. Proszę uruchom %instalator%s aby zainstalować nową wersję rozszerzenia.',
	'WARNING'	=> 'Warning',
	'TOO_LONG_DATE'		=> 'Format daty, który wpisałeś jest za długi.',
	'TOO_SHORT_DATE'	=> 'Format daty, który wpisałeś jest za krótki.',
	'TOO_SMALL_REFRESH'	=> 'Ustawiona wartość odświeżania jest za mała.',
	'TOO_LARGE_REFRESH'	=> 'Ustawiona wartość odświeżania jest za duża.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Ustawiona wartość limitu wiadomości jest za mała.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Ustawiona wartość limitu wiadomości jest za duża.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Ustawiona wartość limitu archiwum jest za mała.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Ustawiona wartość limitu archiwum jest za duża.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Ustawiona wartość limitu antyspamowego jest za mała.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Ustawiona wartość limitu antyspamowego jest za duża.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'Ustawiona wartość długości wiadomości jest za mała.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'Ustawiona wartość długości wiadomości jest za duża.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'Ustawiona wartość długości słowa jest za mała.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'Ustawiona wartość długości słowa jest za duża.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'Ustawiona wartość odświeżania osób czatujących jest za mała.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'Ustawiona wartość odświeżania osób czatujących jest za duża.',
	'TOO_SMALL_INDEX_HEIGHT'	=> 'Ustawiona wartość wysokości mChat na stronie głównej jest za mała.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'Ustawiona wartość wysokości mChat na stronie głównej jest za duża.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'Ustawiona wartość wysokości strony niestandardowej mChat jest za mała.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'Ustawiona wartość wysokości strony niestandardowej mChat jest za duża.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'Ustawiona wartość limitu czasu dla użytkownika jest za mała.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'Ustawiona wartość limitu czasu dla użytkownika jest za duża.',
	'TOO_SMALL_TIMEOUT'	=> 'Ustawiona wartość ogłoszenia jest za mała.',
	'TOO_LARGE_TIMEOUT'	=> 'Ustawiona wartość ogłoszenia jest za duża.',

		// User perms
	'ACL_U_MCHAT_USE'			=> 'Może używać mChat',
	'ACL_U_MCHAT_VIEW'			=> 'Może przeglądać mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Może edytować wiadomości mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Może usuwać wiadomości mChat',
	'ACL_U_MCHAT_IP'			=> 'Może sprawdzać adres IP użytkownika mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Może polubić wiadomość mChat',
	'ACL_U_MCHAT_PM'			=> 'Może napisać prywatną wiadomość do użytkownika mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Może cytować wiadomość z mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Może ignorować mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Może przeglądać archiwum mChat',
	'ACL_U_MCHAT_BBCODE'		=> 'Może używać BBCode mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Może używać emotikony mChat',
	'ACL_U_MCHAT_URLS'			=> 'Może wprowadzać adresy url mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> array('lang' => 'Może zarządzać ustawieniami mChat', 'cat' => 'permissions'), // Using a phpBB category here

));
