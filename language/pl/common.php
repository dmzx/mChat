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
	'MCHAT_ADD'					=> 'Wyślij',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> 'section',
	'MCHAT_LIKES'				=> 'Likes this post',
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
	'MCHAT_MINUTE'				=> 'minut ',
	'MCHAT_MINUTES'				=> 'minut ',
	'MCHAT_MESS_LONG'			=> 'Twoja wiadomość jest za długa.\Proszę ogranicz ją do %s znaków',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'mChat w osobnym oknie jest aktualnie niedostępny!',
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'			=> 'Nie masz uprawnień do postowania na mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Nie masz uprawnień do przeglądania archiwum',
	'MCHAT_NOJAVASCRIPT'		=> 'Twoja przeglądarka nie wspiera JavaScript albo JavaScript jest wyłączona',
	'MCHAT_NOMESSAGE'			=> 'Nie ma wiadomości',
	'MCHAT_NOMESSAGEINPUT'		=> 'Nie wprowadziłeś wiadomości',
	'MCHAT_NOSMILE'				=> 'Nie znaleziono emotikona',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat nie jest zainstalowany.	Proszę skontaktuj się z administratorem.',
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
	'MCHAT_NEW_TOPIC'			=> 'Made A New Topic',
	'MCHAT_NEW_REPLY'			=> 'Made A New Reply',
	'MCHAT_NEW_QUOTE'			=> 'Replied with a Quote',
	'MCHAT_NEW_EDIT'			=> 'Made A Edit',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat Preferences',
	'DISPLAY_MCHAT' 	=> 'Wyświetlaj mChat na stronie głównej',
	'SOUND_MCHAT'		=> 'Włącz dźwięk mChatu',
	'DISPLAY_STATS_INDEX'	=> 'Wyświetlaj kto czatuje w statystykach strony głównej',
	'DISPLAY_NEW_TOPICS'	=> 'Wyświetlaj nowe tematy na mChacie',
	'DISPLAY_AVATARS'	=> 'Wyświetlaj avatary na mChacie',
	'CHAT_AREA'		=> 'Typ wprowadzania',
	'CHAT_AREA_EXPLAIN'	=> 'Wybierz jaki typ obszaru wybrać do wprowadzania tekstu:<br />A text area or<br />an input area',
	'INPUT_AREA'		=> 'Pasek',
	'TEXT_AREA'			=> 'Okno',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'Tabela mChat została wyczyszczona',
	'ACP_USER_MCHAT'			=> 'mChat Ustawienia',
	'LOG_DELETED_MCHAT'		=> '<strong>Usuń wiadomości mChat</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Edytuj wiadomość mChat</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Pozostało znaków: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammerzy',
	'MCHAT_NEW_CHAT'			=> 'Nowa wiadomośc na mChacie!',
	'MCHAT_SEND_PM'			 => 'Wyślij prywatną wiadomość',
	'MCHAT_PM'					=> '(PM)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Like This Post',
));