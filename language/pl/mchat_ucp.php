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
	'MCHAT_PREFERENCES'				=> 'Preferencje mChat',
	'MCHAT_NO_SETTINGS'				=> 'Nie masz uprawnień do dokonywania zmian',

	'MCHAT_INDEX'					=> 'Pokaż na stronie głównej',
	'MCHAT_SOUND'					=> 'Odtwarzaj dźwięki',
	'MCHAT_WHOIS_INDEX'				=> 'Wyświetlaj <em>Who is chatting</em> pod czatem',
	'MCHAT_STATS_INDEX'				=> 'Wyświetlaj <em>Who is chatting</em> w sekcji statystyk',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Wyświetlaj who is chatting pod sekcją <em>Who is online</em> na stronie głównej.',
	'MCHAT_AVATARS'					=> 'Wyświetlaj awatary',
	'MCHAT_CAPITAL_LETTER'			=> 'Zmieniaj pierwszą literę w wiadomości na wielką.',
	'MCHAT_CHAT_AREA'				=> 'Typ wejścia',
	'MCHAT_INPUT_AREA'				=> 'Pole tekstowe',
	'MCHAT_TEXT_AREA'				=> 'Obszar tekstowy',
	'MCHAT_POSTS'					=> 'Wyświetlaj nowe posty (currently all disabled, can be enabled in the mChat Global Settings section in the ACP)',
	'MCHAT_DISPLAY_CHARACTER_COUNT'	=> 'Wyświetlaj liczbę znaków podczas pisania wiadomości',
	'MCHAT_RELATIVE_TIME'			=> 'Pokazuj względy czas dla nowych wiadomości',
	'MCHAT_RELATIVE_TIME_EXPLAIN'	=> 'Wyświetlaj “właśnie teraz”, “1 minutę temu” i tym podobne dla każdej wiadomości. Zaznaczenie <em>Nie</em> oznacza wyświetlanie pełnej daty.',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Wstrzymuj podczas wpisywania wiadomości',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Nie aktualizuj mChat podczas wpisywania wiadomości',
	'MCHAT_MESSAGE_TOP'				=> 'Lokalizacja nowych wiadomości czatu',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Nowe wiadomości pojawią się na górze lub na dole czatu.',
	'MCHAT_LOCATION'				=> 'Lokalizacja na stronie głównej',
	'MCHAT_BOTTOM'					=> 'Na dole',
	'MCHAT_TOP'						=> 'Na górze',

	'MCHAT_POSTS_TOPIC'				=> 'Wyświetlaj nowe tematy',
	'MCHAT_POSTS_REPLY'				=> 'Wyświetlaj nowe odpowiedzi',
	'MCHAT_POSTS_EDIT'				=> 'Wyświetlaj edytowane posty',
	'MCHAT_POSTS_QUOTE'				=> 'Wyświetlaj zacytowane posty',
	'MCHAT_POSTS_LOGIN'				=> 'Wyświetlaj nazwy użytkowników',

	'MCHAT_DATE_FORMAT'				=> 'Format daty',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Użyta składnia jest identyczna do funkcji <a href="http://www.php.net/date">date()</a> w PHP.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Niestandardowy…',
));
