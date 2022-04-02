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
	'MCHAT_PREFERENCES'				=> 'Nastavitve mChata',
	'MCHAT_NO_SETTINGS'				=> 'Niste pooblaščeni za prilagajanje nastavitev.',

	'MCHAT_INDEX'					=> 'Prikaz na indeksni strani',
	'MCHAT_SOUND'					=> 'Omogoči zvok',
	'MCHAT_WHOIS_INDEX'				=> 'Pod klepetom prikažite <em>Kdo klepeta</em>',
	'MCHAT_STATS_INDEX'				=> 'Prikaži <em>Kdo klepeta</em> v razdelku s statistiko',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Prikaže, kdo klepeta pod razdelkom <em>Kdo je na spletu</em> na strani indeksa.',
	'MCHAT_AVATARS'					=> 'Prikaži avatarje',
	'MCHAT_CAPITAL_LETTER'			=> 'Velika prva črka v vaših sporočilih',
	'MCHAT_POSTS'					=> 'Prikaži nove objave (trenutno vse onemogočene, omogočite jih lahko v razdelku Globalne nastavitve mChat v ACP)',
	'MCHAT_DISPLAY_CHARACTER_COUNT'	=> 'Prikaz števila znakov med tipkanjem sporočila',
	'MCHAT_RELATIVE_TIME'			=> 'Prikaži relativni čas za nova sporočila',
	'MCHAT_RELATIVE_TIME_EXPLAIN'	=> 'Prikaže “pravkar”, “pred 1 minuto” in tako naprej za vsako sporočilo. Če želite vedno prikazati polni datum, nastavite na <em>Ne</em>.',
	'MCHAT_MESSAGE_TOP'				=> 'Lokacija novih klepetalnih sporočil',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Nova sporočila bodo prikazana na vrhu ali na dnu klepeta.',
	'MCHAT_LOCATION'				=> 'Lokacija na indeksni strani',
	'MCHAT_BOTTOM'					=> 'Spodaj',
	'MCHAT_TOP'						=> 'Zgoraj',

	'MCHAT_POSTS_TOPIC'				=> 'Prikaži nove teme',
	'MCHAT_POSTS_REPLY'				=> 'Prikaži nove odgovore',
	'MCHAT_POSTS_EDIT'				=> 'Prikaži urejene objave',
	'MCHAT_POSTS_QUOTE'				=> 'Prikaži citirane objave',
	'MCHAT_POSTS_LOGIN'				=> 'Prikaži uporabniške prijave',

	'MCHAT_DATE_FORMAT'				=> 'Format datuma',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Uporabljena sintaksa je identična funkciji PHP <a href="http://www.php.net/date">date()</a>.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Po meri…',
]);
