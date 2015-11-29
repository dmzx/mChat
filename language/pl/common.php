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

	'MCHAT_TITLE'				=> 'mChat',
	'MCHAT_ADD'					=> 'Wyślij',
	'MCHAT_IN'					=> 'w dziale',
	'MCHAT_IN_SECTION'			=> '',
	'MCHAT_LIKES'				=> 'Lubię ten post',
	'MCHAT_ANNOUNCEMENT'		=> 'Ogłoszenie',
	'MCHAT_ARCHIVE'				=> 'Archiwum',
	'MCHAT_ARCHIVE_PAGE'		=> 'Archiwum mChat',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Wyczyść',
	'MCHAT_CLEANED'				=> 'Wszystkie wiadomości zostały pomyślnie usunięte',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Własne BBCodes',
	'MCHAT_DELALLMESS'			=> 'Usunąć wszystkie wiadomości?',
	'MCHAT_DELCONFIRM'			=> 'Czy potwierdzasz usunięcie?',
	'MCHAT_DELITE'				=> 'Usuń',
	'MCHAT_EDIT'				=> 'Edytuj',
	'MCHAT_EDITINFO'			=> 'Edytuj wiadomość i wciśnij OK',
	'MCHAT_ENABLE'				=> 'Przepraszamy, mChat jest aktualnie niedostępny',
	'MCHAT_ERROR'				=> 'Błąd',
	'MCHAT_FLOOD'				=> 'Nie możesz wysłać kolejnej wiadomośći w tak krótkim czasie',
	'MCHAT_FOE'					=> 'Wiadomośc została wysłana przez użytkownika <strong>%1$s</strong>, który znajduje się na Twojej liście osób ignorowanych.',
	'MCHAT_HELP'				=> 'Regulamin mChat',
	'MCHAT_HIDE_LIST'			=> 'ukryj listę',
	'MCHAT_HOUR'				=> 'godzina ',
	'MCHAT_HOURS'				=> 'godziny ',
	'MCHAT_IP'					=> 'IP',
	'MCHAT_MINUTE'				=> 'minut ',
	'MCHAT_MINUTES'				=> 'minut ',
	'MCHAT_MESS_LONG'			=> 'Twoja wiadomość jest za długa. Proszę ogranicz ją do %s znaków',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'mChat w osobnym oknie jest aktualnie niedostępny!',
	'MCHAT_NO_RULES'			=> 'Regulamin mChat nie jest dostępny!',
	'MCHAT_NOACCESS'			=> 'Nie masz uprawnień do postowania na mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Nie masz uprawnień do przeglądania archiwum',
	'MCHAT_NOJAVASCRIPT'		=> 'Twoja przeglądarka nie wspiera JavaScript albo JavaScript jest wyłączona',
	'MCHAT_NOMESSAGE'			=> 'Nie ma wiadomości',
	'MCHAT_NOMESSAGEINPUT'		=> 'Nie wprowadziłeś wiadomości',
	'MCHAT_NOSMILE'				=> 'Nie znaleziono emotikona',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat nie jest zainstalowany. Proszę skontaktuj się z administratorem.',
	'MCHAT_NOT_INSTALLED'		=> 'mChat nie jest zainstalowany. <br />Proszę uruchom %sinstalator%s, aby dodać rozszerzenie.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_CANCEL'				=> 'Anuluj',
	'MCHAT_PAUSE'				=> 'Wstrzymany',
	'MCHAT_LOAD'				=> 'Wczytuję',
	'MCHAT_PERMISSIONS'			=> 'Zmień uprawnienia użytkownika',
	'MCHAT_REFRESHING'			=> 'Odświeżanie...',
	'MCHAT_REFRESH_NO'			=> 'Automatyczna aktualizacja jest wyłączona',
	'MCHAT_REFRESH_YES'			=> 'Automatycznie aktualizuj co <strong>%d</strong> sekund',
	'MCHAT_RESPOND'				=> 'Odpowiedz użytkownikowi',
	'MCHAT_RESET_QUESTION'		=> 'Wyczyścić wprowadzony tekst?',
	'MCHAT_SESSION_OUT'			=> 'Sesja mChat wygasła',
	'MCHAT_SHOW_LIST'			=> 'Pokaż listę',
	'MCHAT_SECOND'				=> 'sekunda ',
	'MCHAT_SECONDS'				=> 'sekundy ',
	'MCHAT_SESSION_ENDS'		=> 'Sesja mChat zakończona',
	'MCHAT_SMILES'				=> 'Emotikony',
	'MCHAT_TOTALMESSAGES'		=> 'Wszystkie wiadomości <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Włączyć dźwięk?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Aktualnie jest tutaj <strong>%d</strong> czatujących użytkowników ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'Aktualnie <strong>%d</strong> osoba korzysta z mChatu ',
	'MCHAT_NO_CHATTERS'					=> 'Nikt nie czatuje',
	'MCHAT_ONLINE_EXPLAIN'				=> 'Bazuje na użytkownikach aktywnych w ciągu ostatnich %s',
	'WHO_IS_CHATTING'			=> 'Kto czatuje',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Odświeżaj co <strong>%d</strong> sekund',
	'MCHAT_NEW_TOPIC'			=> 'Nowy temat',
	'MCHAT_NEW_REPLY'			=> 'Nowy post',
	'MCHAT_NEW_QUOTE'			=> 'Nowa odpowiedź',
	'MCHAT_NEW_EDIT'			=> 'Edytowano post',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'Ustawienia mChat',
	'DISPLAY_MCHAT' 	=> 'Wyświetl mChat na stronie głównej',
	'SOUND_MCHAT'		=> 'Włącz dźwiek',
	'DISPLAY_STATS_INDEX'	=> 'Wyświetl kto aktualnie czatuje',
	'DISPLAY_NEW_TOPICS'	=> 'Wyświetl nowe tematy/posty w oknie mChat',
	'DISPLAY_AVATARS'	=> 'Wyświetl avatary',
	'CHAT_AREA'		=> 'Typ wprowadzania',
	'CHAT_AREA_EXPLAIN'	=> 'Wybierz jaki typ obszaru wybrać do wprowadzania tekstu: ',
	'INPUT_AREA'		=> 'Pasek',
	'TEXT_AREA'			=> 'Okno',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'Tabela mChat została wyczyszczona',
	'ACP_USER_MCHAT'			=> 'Ustawienia mChat',
	'LOG_DELETED_MCHAT'		=> '<strong>Usunięto wiadomości mChat</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Edytowano wiadomość mChat</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Pozostało znaków: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Najbardziej aktywni użytkownicy mChat',
	'MCHAT_NEW_CHAT'			=> 'Nowa wiadomośc na mChacie!',
	'MCHAT_SEND_PM'			 => 'Wyślij prywatną wiadomość',
	'MCHAT_PM'					=> '(PM)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Lubię tą wiadomość',
));