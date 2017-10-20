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
	'ACL_U_MCHAT_USE'						=> 'Może używać mChat',
	'ACL_U_MCHAT_VIEW'						=> 'Może zobaczyć mChat',
	'ACL_U_MCHAT_EDIT'						=> 'Może edytować własne wiadomości',
	'ACL_U_MCHAT_DELETE'					=> 'Może usuwać własne wiadomości',
	'ACL_U_MCHAT_MODERATOR_EDIT'			=> 'Może edytować wszystkie wiadomości',
	'ACL_U_MCHAT_MODERATOR_DELETE'			=> 'Może usuwać wszystkie wiadomości',
	'ACL_U_MCHAT_IP'						=> 'Może zobaczyć adresy IP',
	'ACL_U_MCHAT_PM'						=> 'Może używać prywatnych wiadomości',
	'ACL_U_MCHAT_LIKE'						=> 'Może polubić wiadomości',
	'ACL_U_MCHAT_QUOTE'						=> 'Może cytować wiadomości',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Może ignorować limit czasowy wiadomości z rzędu',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Może widzieć archiwum',
	'ACL_U_MCHAT_BBCODE'					=> 'Może używać BBCodes',
	'ACL_U_MCHAT_SMILIES'					=> 'Może używać emotikony',
	'ACL_U_MCHAT_URLS'						=> 'Może umieścić automatycznie przeanalizowany adres URL',

	'ACL_U_MCHAT_AVATARS'					=> 'Może dostosować <em>Pokazuj awatary</em>',
	'ACL_U_MCHAT_CAPITAL_LETTER'			=> 'Może dostosować <em>Capital first letter</em>',
	'ACL_U_MCHAT_CHARACTER_COUNT'			=> 'Może dostosować <em>Pokazuj liczbę znaków</em>',
	'ACL_U_MCHAT_DATE'						=> 'Może dostosować <em>Format daty</em>',
	'ACL_U_MCHAT_INDEX'						=> 'Może dostosować <em>Pokazuj na stronie głównej</em>',
	'ACL_U_MCHAT_INPUT_AREA'				=> 'Może dostosować <em>Typ wprowadzania</em>',
	'ACL_U_MCHAT_LOCATION'					=> 'Może dostosować <em>Lokalizacja mChat na stronie głównej</em>',
	'ACL_U_MCHAT_MESSAGE_TOP'				=> 'Może dostosować <em>Lokalizacja nowych wiadomości</em>',
	'ACL_U_MCHAT_PAUSE_ON_INPUT'			=> 'Może dostosować <em>Wstrzymanie wprowadzania</em>',
	'ACL_U_MCHAT_POSTS'						=> 'Może dostosować <em>Pokazuj nowe posty</em>',
	'ACL_U_MCHAT_RELATIVE_TIME'				=> 'Może dostosować <em>Pokazuj względny czas</em>',
	'ACL_U_MCHAT_SOUND'						=> 'Może dostosować <em>Graj dźwięki</em>',
	'ACL_U_MCHAT_WHOIS_INDEX'				=> 'Może dostosować <em>Pokaż, kto czatuje, poniżej czatu</em>',
	'ACL_U_MCHAT_STATS_INDEX'				=> 'Może dostosować <em>Pokaż, kto czatuje w sekcji statystyk</em>',

	'ACL_A_MCHAT'							=> 'Może zarządzać ustawieniami mChat',
));
