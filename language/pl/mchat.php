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
	'MCHAT_ADD'						=> 'Wyślij',
	'MCHAT_ARCHIVE'					=> 'Archwium',
	'MCHAT_ARCHIVE_PAGE'			=> 'Archiwum mChat',
	'MCHAT_CUSTOM_PAGE'				=> 'mChat',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CUSTOM_BBCODES'			=> 'Własne BBCodes',
	'MCHAT_DELCONFIRM'				=> 'Czy jesteś pewny, że chcesz usunąć tę wiadomość?',
	'MCHAT_EDIT'					=> 'Edytuj',
	'MCHAT_EDITINFO'				=> 'Edytuj wiadomość poniżej',
	'MCHAT_NEW_CHAT'				=> 'Nowa wiadomość!',
	'MCHAT_SEND_PM'					=> 'Wyślij prywatną wiadomość',
	'MCHAT_LIKE'					=> 'Polub tę wiadomość',
	'MCHAT_LIKES'					=> 'lubi tę wiadomość',
	'MCHAT_FLOOD'					=> 'Nie możesz wysłać kolejnej wiadomości po zbyt krótkim czasie',
	'MCHAT_FOE'						=> 'Ta wiadomość została wysłana przez użytkownika <strong>%1$s</strong>, który jest obecnie na Twojej liście zignorowanych',
	'MCHAT_RULES'					=> 'Zasady',
	'MCHAT_WHOIS_USER'				=> 'Adres IP dla %1$s',
	'MCHAT_MESS_LONG'				=> 'Twoja wiadomość jest zbyt długa. Proszę skrócić ją do %1$d znaków.',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'Niestandardowa strona mChat nie jest obecnie aktywna.',
	'MCHAT_NO_RULES'				=> 'Strona z zasadami mChat nie jest obecnie aktywna.',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Nie masz odpowiednich uprawnień, aby przejrzeć wiadomości znajdujące się w archiwum.',
	'MCHAT_NOJAVASCRIPT'			=> 'Proszę aktywować JavaScript, aby używać mChat.',
	'MCHAT_NOMESSAGE'				=> 'Brak wiadomości',
	'MCHAT_NOMESSAGEINPUT'			=> 'Nie wysłano wiadomości',
	'MCHAT_MESSAGE_DELETED'			=> 'Ta wiadomosć została usunięta',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Zatrzymano',
	'MCHAT_PERMISSIONS'				=> 'Zmień uprawnienia użytkownika',
	'MCHAT_REFRESHING'				=> 'Odświeżanie…',
	'MCHAT_REFRESH_NO'				=> 'Aktualizowanie jest wyłączone',
	'MCHAT_REFRESH_YES'				=> 'Aktualizowany co <strong>%1$d</strong> sekund',
	'MCHAT_RESPOND'					=> 'Odpowiedz na wiadomość użytkownika',
	'MCHAT_SESSION_ENDS'			=> 'Sesja czatu zakończy się w %1$s',
	'MCHAT_SESSION_OUT'				=> 'Sesja czatu wygasła',
	'MCHAT_SMILES'					=> 'Uśmieszki',
	'MCHAT_TOTALMESSAGES'			=> 'Wiadomości ogółem: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Odtwarzaj dźwięki',
	'MCHAT_COLLAPSE_TITLE'			=> 'Przełącz widoczność mChat',
	'MCHAT_WHO_IS_REFRESH_EXPLAIN'	=> 'Odświeżanie co każde <strong>%1$d</strong> sekund',
	'MCHAT_MINUTES_AGO'				=> array(
		0 => 'właśnie teraz',
		1 => '%1$d minutę temu',
		2 => '%1$d minuty temu',
		5 => '%1$d minut temu',
	),

	// These messages are formatted with JavaScript, hence {} and no %d
	'MCHAT_CHARACTER_COUNT'			=> '<strong>{current}</strong> znaków',
	'MCHAT_CHARACTER_COUNT_LIMIT'	=> '<strong>{current}</strong> do {max} znaków',
	'MCHAT_SESSION_ENDS_JS'			=> 'Sesja czatu zakończy się za {timeleft}',
	'MCHAT_MENTION'					=> ' @{username} ',

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',
));
