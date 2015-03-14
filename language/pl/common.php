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
	'MCHAT_ADD'					=> 'Wyślij',
	'MCHAT_ANNOUNCEMENT'		=> 'Ogłoszenie',
	'MCHAT_ARCHIVE'				=> 'Archiwum',	
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini-Chat Archiwum',	
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Wyczyść',
	'MCHAT_CLEANED'				=> 'Wszystkie wiadomości zostały pomyślnie usunięte',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Custom BBCodes',
	'MCHAT_DELALLMESS'			=> 'Usunąć wszystkie wiadomości ?',
	'MCHAT_DELCONFIRM'			=> 'Czy potwierdzasz usunięcie?',
	'MCHAT_DELITE'				=> 'Usuń',
	'MCHAT_EDIT'				=> 'Edytuj',
	'MCHAT_EDITINFO'			=> 'Edytuj wiadomość i wciśnij OK',
	'MCHAT_ENABLE'				=> 'Przepraszamy, Mini-Chat jest aktualnie niedostępny',	
	'MCHAT_ERROR'				=> 'Błąd',	
	'MCHAT_FLOOD'				=> 'Nie możesz wysłać kolejnej wiadomośći w tak krótkim czasie',	
	'MCHAT_FOE'					=> 'Wiadomośc została wysłana przez użytkownika <strong>%1$s</strong> który znajduje się na Twojej liście osób ignorowanych.',
	'MCHAT_HELP'				=> 'mChat Reguamin',
	'MCHAT_HIDE_LIST'			=> 'ukryj listę',	
	'MCHAT_HOUR'				=> 'godzina ',
	'MCHAT_HOURS'				=> 'godziny',
	'MCHAT_IP'					=> 'IP',
	
	'MCHAT_MINUTE'				=> 'minuta ',
	'MCHAT_MINUTES'				=> 'minuty ',
	'MCHAT_MESS_LONG'			=> 'Twoja wiadomość jest za długa.\Proszę ogranicz ją do %s characters',	
	'MCHAT_NO_CUSTOM_PAGE'		=> 'mChat w osobnym oknie jest aktualnie niedostępny!',	
	'MCHAT_NOACCESS'			=> 'Nie masz uprawnień do postowania na mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Nie masz uprawnień do przeglądania archiwum',	
	'MCHAT_NOJAVASCRIPT'		=> 'Twoja przeglądarka nie wspiera JavaScript albo JavaScript jest wyłączona',		
	'MCHAT_NOMESSAGE'			=> 'Nie ma wiadomości',
	'MCHAT_NOMESSAGEINPUT'		=> 'Nie wprowadziłeś wiadomości',
	'MCHAT_NOSMILE'				=> 'Nie znaleziono emotikona',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat nie jest zainstalowany.  Proszę skontaktuj się z administratorem.',
	'MCHAT_NOT_INSTALLED'		=> 'W bazie danych mChat brakuje.<br />Proszę uruchom %sinstalator%s aby wprowadzić zmiany w bazie danych rozszerzenia.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Wstrzymany',
	'MCHAT_LOAD'				=> 'Wczytuję',      
	'MCHAT_PERMISSIONS'			=> 'Zmień uprawnienia użytkownika',
	'MCHAT_REFRESHING'			=> 'Odświeżanie...',
	'MCHAT_REFRESH_NO'			=> 'Auto-aktualizacja jest wyłączona',
	'MCHAT_REFRESH_YES'			=> 'Automatycznie-aktualizuj co <strong>%d</strong> sekund',
	'MCHAT_RESPOND'				=> 'Odpowiedz użytkownikowi',
	'MCHAT_RESET_QUESTION'		=> 'Wyczyściuć tabelę wprowadzania tekstu ?',
	'MCHAT_SESSION_OUT'			=> 'Sesja mChat wygasła',	
	'MCHAT_SHOW_LIST'			=> 'Pokaż listę',
	'MCHAT_SECOND'				=> 'sekunda ',
	'MCHAT_SECONDS'				=> 'sekundy ',
	'MCHAT_SESSION_ENDS'		=> 'Sesja mChat zakończona w',
	'MCHAT_SMILES'				=> 'Emotikony',

	'MCHAT_TOTALMESSAGES'		=> 'Wszystkie wiadomości <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Włączyć dźwięk ?',
	

	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Aktualnie jest tutaj <strong>%d</strong> czatujących użytkowników ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'Aktualnie <strong>%d</strong> osoba korzysta z mChatu ',
	'MCHAT_NO_CHATTERS'					=> 'Nikt nie czatuje',
	'MCHAT_ONLINE_EXPLAIN'				=> 'Bazuje na użytkownikach aktywnych w ciągu ostatnich %s',
	
	'WHO_IS_CHATTING'			=> 'Kto czatuje',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Odświeżaj co <strong>%d</strong> sekund',
	'MCHAT_NEW_TOPIC'			=> '<strong>Nowy Temat</strong>',		
	'MCHAT_NEW_REPLY'			=> '<strong>Nowa Odpowiedź</strong>',	
	
	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat Preferences',
	
	'DISPLAY_MCHAT' 	=> 'Wyświetlaj mChat na stronie głównej',
	'SOUND_MCHAT'		=> 'Włącz dźwięk mChatu',
	'DISPLAY_STATS_INDEX'	=> 'Wyświetlaj kto czatuje w statystykach strony głównej',
	'DISPLAY_NEW_TOPICS'	=> 'Wyświetlaj nowe tematy na chacie',
	'DISPLAY_AVATARS'	=> 'Wyświetlaj avatary na chacie',
	'CHAT_AREA'		=> 'Typ wprowadzania',
	'CHAT_AREA_EXPLAIN'	=> 'Wybierz jaki typ obszaru wybrać do wprowadzania tekstu:<br />A text area or<br />an input area',
	'INPUT_AREA'		=> 'Obszar wprowadzania',
	'TEXT_AREA'			=> 'Obszar tekstu',	
	// ACP
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Tutaj wprowadź regulamin mChat.  Każdy podpunkt w oddzielnej lini.<br />Limit znaków wynosi 255.<br />',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Aktualizuj konfigurację mChat </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Zaktuaizowano konfigurację mChat',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Wersja:',
	'MCHAT_ENABLE'					=> 'Włącz rozszerzenie mChat',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Włącz lub wyłącz rozszerzenie globalnie.',
	'MCHAT_AVATARS'					=> 'Wyświetlaj avatary',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Zaznacz TAK aby wyświetlać miniaturki avatarów',	
	'MCHAT_ON_INDEX'				=> 'mChat na stronie głównej',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Zezwól na wyświetlanie mChat na stronie głównej.',
	'MCHAT_INDEX_HEIGHT'			=> 'Wysokość na stronie głównej',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Wysokość okna rozmowy w pikselach na głównej stronie.<br /><em>Limit wynosi od 50 do 1000</em>.',
	'MCHAT_LOCATION'				=> 'Lokalizacja na forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Wybierz lokalizację mChat na stronie głównej.',
	'MCHAT_TOP_OF_FORUM'			=> 'Góra',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Dół',
	'MCHAT_REFRESH'					=> 'Odśwież',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Po ilu sekundach nastąpi automatyczne odświeżanie.<br /><em>Limit wynosi od 5 do 60 sekund</em>.',
	'MCHAT_PRUNE'					=> 'Włącz opcję wyczyszczenia wiadomości',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Jeśli zaznaczono tak, opcja wyczyszczenia wiadomości będzie dostępna.<br /><em>Tylko wtedy, jeśli użytkownik wyświetli stronę niestandardową lub archiwum</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Ilość wyczyszczonych wiadomości',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Wpisz liczbę.',	
	'MCHAT_MESSAGE_LIMIT'			=> 'Limit wiadomości',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Maksymalna ilość wiadomości wyświetlana w oknie mChat.<br /><em>Rekomendowane od 10 do 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limit wiadomości na stronie głównej',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Maksymalna ilość wiadomości wyświetlana w mChat na stronie głównej.<br /><em>Rekomendowane od 10 do 30</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limit Archiwum',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Maksymalna ilość wiadomości wyświetlana na jednej stronie archiwum.<br /> <em>Rekomendowane od 25 do 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Czas blokady antyspamowej',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Ilość sekund jaką musi odczekać użytkownik, aby wysłać następną wiadomość.<br /><em>Rekomendowane od 5 do 30, ustaw 0 aby wyłączyć limit</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Maksymalna długośc wiadomości',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Maksymalna ilość znaków jaką można użyć w jednej wiadomości.<br /><em>Rekomendowane od 100 do 500, ustaw 0 aby wyłączyć limit</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Strona niestandardowa',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Zewól na używanie strony niestandardowej',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Wysokość strony niestandardowej',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Wysokość okna rozmowy w pikselach na on osobnej stronie mChat.<br /><em>Limit wynosi od 50 do 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Format Daty',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Użyta składnia jest taka sama jak w PHP <a href="http://www.php.net/date">date()</a> function.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Niestandardowa…',
	'MCHAT_WHOIS'					=> 'Kto aktualnie czatuje',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Pozwala na wyświetlanie użytkowników, którzy aktualnie korzystają z mChat',
	'MCHAT_WHOIS_REFRESH'			=> 'Odświeżanie czatujących użytkowników',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Po ilu sekundach nastąpi automatyczne odświeżanie czatujących użytkowników.<br /><em>Limit wynosi od 30 do 300 sekund</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Niedozwolone bbcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Tutaj umieść bbcodes których nie będzie można używać w wiadomościach.<br />Oddzielne bbcodes z pionową kreską, na przykład: <br />b|i|u|code|list|list=|flash|quote i/lub %wybierz z tych%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Ogłoszenie',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Tutaj możesz umieścić ogłoszenie które wyświetli się osobą czatującym.  kod HTML jest dozwolony.<br />Zostaw puste aby wyłączyć wyświetlanie.  Limit wynosi max 255 znaków.<br /></strong>',
	'MCHAT_USER_TIMEOUT'			=> 'Limit czasu dla użytkownika',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Ustaw czas w sekundach do zakończenia sesji użytkownika. Ustaw 0 sby wyłączyć.<br /><em>Limit znajdziesz tutaj %sforum konfiguracja ustawień dla sessji%s aktualnie jest ustawione na %s sekund</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Limit emotikon',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Zaznacz TAK aby włączyć limit emotikon używanych w wiadmościach mChat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Limit znaków',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Zaznacz TAK aby włączyć limit znaków używanych w wiadomościach mChat',
	'MCHAT_NEW_POSTS'				=> 'Wyświetlaj nowe posty',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Zaznacz TAK aby powiadamiać na mChacie o nowych postach na forum<br /><strong>Wymaga zainstalowania dodatkowego rozszerzenia, powiadamiającego o nowych postach</strong>',
	'MCHAT_MAIN'					=> 'Główne ustawienia',
	'MCHAT_STATS'					=> 'Kto czatuje ?',
	'MCHAT_STATS_INDEX'				=> 'Statystyki na stronie głównej',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Pokaż kto korysta z mChat w dziale statystyki na forum',
	'MCHAT_MESSAGES'				=> 'Ustawienia wiadomości',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Auto-aktuaizacja podczas pisania wiadomości',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Zaznacz TAK aby nie auto-aktualizować mChatu gdy użytkownik pisze wiadomość',
	
	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'Rozszerzenie mChat musi zostać zaktualizowane.  Proszę skontaktuj się z administratorem.',
	'MCHAT_WRONG_VERSION'	=> 'Zainstalowano złą wersję rozszerzenia.  Proszę uruchom %instalator%s aby zainstalować nową wersję rozszerzenia.',
	'WARNING'	=> 'Warning',
	'TOO_LONG_DATE'		=> 'Format day który wpisałeś jest za długi.',
	'TOO_SHORT_DATE'	=> 'Format day który wpisałeś jest za krótki.',
	'TOO_SMALL_REFRESH'	=> 'Ustawiona wartość odświeżania jest za mała.',
	'TOO_LARGE_REFRESH'	=> 'Ustawiona wartość odświeżania jest za duża.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Ustawiona wartośc limitu wiadomości jest za mała.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Ustawiona wartośc limitu wiadomości jest za duża.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Ustawiona wartość limitu archiwum jest za mała.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Ustawiona wartość limitu archiwum jest za duża.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Ustawiona wartośc limitu antyspamowego jest za mała.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Ustawiona wartośc limitu antyspamowego jest za duża.',
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
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat', //Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'Tabela mChat została wyczyszczona',
	'ACP_USER_MCHAT'			=> 'mChat Ustawienia',
	'LOG_DELETED_MCHAT'      => '<strong>Usuń wiadomości mChat</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'      => '<strong>Edytuj wiadomość mChat</strong><br />» %1$s',	
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'   => 'Pozostało znaków: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'            => 'Top Spammerzy',
	'MCHAT_NEW_CHAT'            => 'Nowa wiadomośc na chacie!',
	'FONT_COLOR'				=> 'Kolor czcionki',
	'FONT_COLOR_HIDE'			=> 'Ukryj kolor czcionki',
	'FONT_HUGE'					=> 'Ogromne',
	'FONT_LARGE'				=> 'Duże',
	'FONT_NORMAL'				=> 'Normalne',
	'FONT_SIZE'					=> 'Rozmiar czcionki',
	'FONT_SMALL'				=> 'Mały',
	'FONT_TINY'					=> 'Malutki',
	'MCHAT_SEND_PM'             => 'Wyślij prywatną wiadomość',
    'MCHAT_PM'                  => '(PM)',
	'MORE_SMILIES'              => 'Więcej emotikon',
));