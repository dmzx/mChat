<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * Slovenian Translation - Marko K.(max, max-ima,...)
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
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

$lang = array_merge($lang, [
	'ACL_U_MCHAT_USE'						=> 'Lahko uporablja mChat',
	'ACL_U_MCHAT_VIEW'						=> 'Lahko si ogleda mChat',
	'ACL_U_MCHAT_EDIT'						=> 'Lahko ureja lastna sporočila',
	'ACL_U_MCHAT_DELETE'					=> 'Lahko izbriše lastna sporočila',
	'ACL_U_MCHAT_MODERATOR_EDIT'			=> 'Lahko ureja sporočila kogar koli',
	'ACL_U_MCHAT_MODERATOR_DELETE'			=> 'Lahko izbriše katera koli sporočila',
	'ACL_U_MCHAT_IP'						=> 'Lahko si ogleda IP naslove',
	'ACL_U_MCHAT_PM'						=> 'Lahko uporabi zasebno sporočilo',
	'ACL_U_MCHAT_LIKE'						=> 'Lahko vidi všeč mi je ikono (zahteva dovoljenje BBCode)',
	'ACL_U_MCHAT_QUOTE'						=> 'Lahko vidi ikona ponudbe (potrebno je dovoljenje BBCode)',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Lahko ne upošteva omejitev ogroženosti',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Lahko si ogleda arhiv',
	'ACL_U_MCHAT_BBCODE'					=> 'Lahko uporablja BBCode',
	'ACL_U_MCHAT_SMILIES'					=> 'Lahko uporablja smeške',
	'ACL_U_MCHAT_URLS'						=> 'Lahko objavi samodejno razčlenjene URL-je',

	'ACL_U_MCHAT_AVATARS'					=> 'Lahko prilagodi <em>Prikaz avatarjev</em>',
	'ACL_U_MCHAT_CAPITAL_LETTER'			=> 'Lahko prilagodi <em>Velike prve črke</em>',
	'ACL_U_MCHAT_CHARACTER_COUNT'			=> 'Lahko prilagodi <em>Prikazno število znakov</em>',
	'ACL_U_MCHAT_DATE'						=> 'Lahko prilagodi <em>Obliko datuma</em>',
	'ACL_U_MCHAT_INDEX'						=> 'Lahko prilagodi <em>Prikaz v indeksu</em>',
	'ACL_U_MCHAT_LOCATION'					=> 'Lahko prilagodi <em>Lokacijo mChat-a na indeksni strani</em>',
	'ACL_U_MCHAT_MESSAGE_TOP'				=> 'Lahko prilagodi <em>Lokacijo novih sporočil klepeta</em>',
	'ACL_U_MCHAT_POSTS'						=> 'Lahko prilagodi <em>Prikaz novih objav</em>',
	'ACL_U_MCHAT_RELATIVE_TIME'				=> 'Lahko prilagodi <em>Relativni čas prikaza</em>',
	'ACL_U_MCHAT_SOUND'						=> 'Lahko prilagodi <em>Predvajaj zvoke</em>',
	'ACL_U_MCHAT_WHOIS_INDEX'				=> 'Lahko prilagodi <em>Prikaži, kdo klepeta pod klepetom</em>',
	'ACL_U_MCHAT_STATS_INDEX'				=> 'Lahko prilagodi <em>Prikaži, kdo klepeta v razdelku s statistiko</em>',

	'ACL_A_MCHAT'							=> 'Lahko upravlja nastavitve mChata',
]);
