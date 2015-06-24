<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net / Estonian translation by phpBBeesti.com 05/2015
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
	'ACP_MCHAT_CONFIG'				=> 'Seadistus',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-jututuba',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Mini jututuba (aka “shoutbox”) foorumile',
	'MCHAT_TABLE_DELETED'			=> 'mChat tabel on edukalt kustutatud',
	'MCHAT_TABLE_CREATED'			=> 'mChat tabel on edukalt loodud',
	'MCHAT_TABLE_UPDATED'			=> 'mChat tabel on edukalt uuendatud',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Pole midagi teha....jätkan',
	'UCP_CAT_MCHAT'					=> 'mChat seaded',
	'UCP_MCHAT_CONFIG'				=> 'Liikme mChat seaded',
	// ACP entries => AJP lehekülg
	'ACP_MCHAT_RULES'				=> 'Reeglid',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Sisesta siia oma foorumi jututoa reeglid.<br />Oled piiratud kirjutama kuni 255 sümbolit.<br />Kui soovid keelata selle funktsiooni, siis jäta see väli tühjaks.<br /><strong>Seda sõnumit on võimalik tõlkida.</strong> (Pead muutma faili mchat_lang.php ja loe juhendit).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>mChat konfiguratsioon uuendatud </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini-Jututoa konfiguratsioon on uuendatud',
	'MCHAT_TITLE'					=> 'Mini-jututuba',
	'MCHAT_VERSION'					=> 'Versioon:',
	'MCHAT_ENABLE'					=> 'Luba mChat laiendus',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Luba või keela antud laiendus.',
	'MCHAT_AVATARS'					=> 'Näita avatare',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Kui valitud jah, siis liikmete avatare näidatakse',
	'MCHAT_ON_INDEX'				=> 'mChat esilehel',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Luba näidatata mChat jututuba foorumi esilehel.',
	'MCHAT_INDEX_HEIGHT'			=> 'Esilehe kõrgus',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'mChat jututoa kasti kõrgus pikslites foorumi esilehel.<br /><em>Sa oled piiratud 50 kuni 1000</em>.',
	'MCHAT_LOCATION'				=> 'Asukoht foorumil',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Vali mChat jututuba asukoht foorumi esilehel.',
	'MCHAT_TOP_OF_FORUM'			=> 'Üleval',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'All',
	'MCHAT_REFRESH'					=> 'Värskenda',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Kui mitme sekundi tagant jututuba automaatselt värskendab sõnumeid.<br /><em>Sa oled piiratud 5 kuni 60 sekundiga</em>.',
	'MCHAT_PRUNE'					=> 'Luba kärped',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Seadista jah, kui soovid lubada kärpimise funktsiooni.<br />',
	'MCHAT_PRUNE_NUM'				=> 'Kärpimise number',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Sõnumite arv, mille peaks jututuppa alles jätma.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Sõnumite limiit',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Maksimaalne sõnumite arv, mida näidatakse jututoas.<br /><em>Soovituslik arv on 10 kuni 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Esilehe sõnumite limiit',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Maksimaalne sõnumite arv, mida näidatakse esilehel jututoas.<br /><em>Soovituslik arv on 10 kuni 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Arhiivi limiit',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Maksimaalne sõnumite arv lehekülje kohta, mida näidatake arhiivis.<br /> <em>Soovituslik arv on 25 kuni 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Postitamise intervalli aeg',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Sisesta sekundite arv, mil kasutaja peab enne ootama kui ta saab sisestada järgmist sõnumit jututoas.<br /><em>Soovituslik piirang on 5 kuni 30, kui soovid keelata selle funktsiooni, siis sisesta väärtuseks 0</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Maksimaalne sõnumi pikkus',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Maksimaalne sõnumi pikkus sümbolites, mis on lubatud ühele postitusele jututoas.<br /><em>Soovituslik piirang on 100 kuni 500 sümbolit, kui soovid keelata selle funktsiooni, siis sisesta väärtuseks 0</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Kohandatud lehekülg',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Luba kasutada kohandatud lehekülge',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Kohandatud lehekülje kõrgus',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Jututoa kõrgus pikslites.<br /><em>Oled piiratud vahemikuga 50 kuni 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Kuupäeva formaat',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Süntaks mis on sarnane PHP <a href="http://www.php.net/date">date()</a> funktsiooniga.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Kohandatud…',
	'MCHAT_WHOIS'					=> 'Kes on',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Luba näidata kasutajaid, kes on jututoas',
	'MCHAT_WHOIS_REFRESH'			=> 'Kes on värskendus',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Sekundid, millal "Kes on" statistikat värskendatakse.<br /><em>Oled piiratud vahemikuga 30 kuni 300 sekundit</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Keelatud BBkoodid',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Siia saad sisestada need BBkoodid, mis <strong>EI OLE</strong> lubatud kasutada sõnumites.<br />Eralda BBkoodid vertikaalse ribaga, näiteks: <br />b|i|u|code|list|list=|flash|quote ja/või %skohandatud BBkoodi märgendi nimi%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Staatiline sõnum',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Siia saad sisestada staatilise sõnumi, mida näidatakse kasutajatele jututoas. HTML kood on lubatud.<br />Kui soovid keelata selle funktsiooni, siis jäta see väli tühjaks. Sa oled piiratud kirjutama teksti kuni 255 sümbolini.<br /><strong>Seda sõnumit on võimalik tõlkida.</strong> (pead muutma mchat_lang.php faili, ning loe juhendit).',
	'MCHAT_USER_TIMEOUT'			=> 'Kasutaja session aegub',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Seadista aeg sekundites, mil kasutaja session jututoas aegub. Kui soovid selle funktsiooni keelata seadista väärtuseks 0.<br /><em>Sa oled piiratud %sfoorumi seadete sessiooniga%s, mis hetkel on seadistatud %s sekundi peale</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Kirjuta üle emotikonide limiit',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Vali jah, kui soovid foorumi emotikoni limmiidi mini-jututoa sõnumites üle kirjutada',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Kirjuta üle sümbolite limiit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Vali jah, kui soovid kirjutada üle foorumi miinimum sümbolite arvu mini-jututoa sõnumites',
	'MCHAT_NEW_POSTS'				=> 'Luba näidata postitusi',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Vali jah, kui soovid seadistada, milliseid postitusi foorumites soovid näidata mini-jututoas.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Näita uusi teemasi',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Vali jah, kui soovid näidata uusi teemasi foorumites mini-jututoas.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Näita uusi vastuseid',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Vali jah, kui soovid näidata uusi vastuseid foorumites teemades mini-jututoas.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Näita muudetud postitusi',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Vali jah, kui soovid näidata uusi muudetuid postitusi foorumites mini-jututoas.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Näita tsiteeritud postitusi',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Vali jah, kui soovid näidata uusi tsiteerituid postitusi foorumites mini-jututoas.',
	'MCHAT_MAIN'					=> 'Üldine seadistus',
	'MCHAT_STATS'					=> '"Kes on jututoas"',
	'MCHAT_STATS_INDEX'				=> 'Statistika esilehel',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Näita kes on jututoas statistikat',
	'MCHAT_MESSAGE_TOP'				=> 'Postita sõnumit üles või alla',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'See seadistus määrab, kas sõnumit postitatakse üles või alla jututoas.',
	'MCHAT_BOTTOM'					=> 'Üles',
	'MCHAT_TOP'						=> 'Alla',
	'MCHAT_MESSAGES'				=> 'Sõnumi seaded',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Sõnumi sisestamisel paus',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Valik jah määrab, kas jututoa sõnumeid värskendatakse ajal, mil kasutaja sisestab uut sõnumit tekstiväljal',

	// error reporting => Vigade teavitus
	'TOO_LONG_DATE'		=> 'Kuupäeva formaat mille oled sisestanud on liiga pikk.',
	'TOO_SHORT_DATE'	=> 'Kuupäeva formaat mille oled sisestanud on liiga lühike.',
	'TOO_SMALL_REFRESH'	=> 'Värskendamise väärtus on liiga väike.',
	'TOO_LARGE_REFRESH'	=> 'Värskendamise väärtus on liiga suur.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Sõnumi limiidi väärtus on liiga väike.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Sõnumi limiidi väärtus on liiga suur.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Arhiivi limiidi väärtus on liiga väike.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Arhiivi limiidi väärtus on liiga suur.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Postitamise intervalli aeg on liiga väike.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Postitamise intervalli aeg on liiga suur.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'Maksimaalse sõnumi pikkuse väärtus on liiga väike.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'Maksimaalse sõnumi pikkuse väärtus on liiga suur.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'Maksimaalse sõnade arvu pikkuse väärtus on liiga väike.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'Maksimaalse sõnade arvu pikkuse väärtus on liiga suur.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'Kes on värskenduse väärtus on liiga väike.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'Kes on värskenduse väärtus on liiga suur.',
	'TOO_SMALL_INDEX_HEIGHT'	=> 'Esilehe kõrguse väärtus on liiga väike.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'Esilehe kõrguse väärtus on liiga suur.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'Kohandatud kõrguse väärtus on liiga väike.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'Kohandatud kõrguse väärtus on liiga suur.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'Staatiline sõnum on liiga lühike.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'Staatiline sõnum on liiga pikk.',
	'TOO_SMALL_TIMEOUT'	=> 'Kasutaja sessiooni aeg on liiga väike.',
	'TOO_LARGE_TIMEOUT'	=> 'Kasutaja sessiooni aeg on liiga suur.',

	// User perms => Kasutaja õigused
	'ACL_U_MCHAT_USE'			=> 'Saab kasutada mChat jututuba',
	'ACL_U_MCHAT_VIEW'			=> 'Saab vaadata mChat jututuba',
	'ACL_U_MCHAT_EDIT'			=> 'Saab muuta mChat jututoas sõnumeid',
	'ACL_U_MCHAT_DELETE'		=> 'Saab kustutada mChat jututoas sõnumeid',
	'ACL_U_MCHAT_IP'			=> 'Saab vaadata mChat jututoas IP aadresse',
	'ACL_U_MCHAT_PM'			=> 'Saab kasutada mChat jututoas privaatsõnumi funktsiooni',
	'ACL_U_MCHAT_LIKE'			=> 'Saab kasutada like message in mchat',
	'ACL_U_MCHAT_QUOTE'			=> 'Saab kasutada tsiteerimist mChat jututoas',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Saab eirata postituste intervalli mChat jututoas',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Saab vaadata arhiivi mChat jututoas',
	'ACL_U_MCHAT_BBCODE'		=> 'Saab kasutada BBkoode mChat jututoas',
	'ACL_U_MCHAT_SMILIES'		=> 'Saab kasutada emotikone mChat jututoas',
	'ACL_U_MCHAT_URLS'			=> 'Saab postitada URL\'e mChat jututoas',

	// Admin perms => Administraatori õigused
	'ACL_A_MCHAT'				=> 'Saab hallata mChat seadeid',

));