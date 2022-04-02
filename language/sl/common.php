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
	'MCHAT_TITLE'					=> 'mChat',
	'MCHAT_TITLE_COUNT'				=> [
		0 => 'mChat',
		1 => 'mChat [<strong>%1$d</strong>]',
	],
	'MCHAT_NAVBAR_CUSTOM_PAGE'		=> 'mChat stran',
	'MCHAT_NAVBAR_ARCHIVE'			=> 'Arhiv',
	'MCHAT_NAVBAR_RULES'			=> 'Pravila',

	// Who is chatting
	'MCHAT_WHO_IS_CHATTING'			=> 'Kdo klepeta',
	'MCHAT_ONLINE_USERS_TOTAL'		=> [
		0 => 'Nihče ne klepeta',
		1 => '<strong>%1$d</strong> uporabnik klepeta',
		2 => '<strong>%1$d</strong> uporabniki klepetajo',
	],
	'MCHAT_ONLINE_EXPLAIN'			=> 'na podlagi uporabnikov, dejavnih v zadnjih %1$s',
	'MCHAT_HOURS'					=> [
		1 => '%1$d ura',
		2 => '%1$d ure',
	],
	'MCHAT_MINUTES'					=> [
		1 => '%1$d minuta',
		2 => '%1$d minute',
	],
	'MCHAT_SECONDS'					=> [
		1 => '%1$d sekunda',
		2 => '%1$d sekunde',
	],

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',

	// Post notification messages (%1$s is replaced with a link to the new/edited post, %2$s is replaced with a link to the forum)
	'MCHAT_NEW_POST'				=> 'objavil novo temo: %1$s v %2$s',
	'MCHAT_NEW_POST_DELETED'		=> 'objavil novo temo, ki je bila izbrisana',
	'MCHAT_NEW_REPLY'				=> 'objavil odgovor: %1$s v %2$s',
	'MCHAT_NEW_REPLY_DELETED'		=> 'objavil odgovor, ki je bil izbrisan',
	'MCHAT_NEW_QUOTE'				=> 'odgovoril s citatom: %1$s v %2$s',
	'MCHAT_NEW_QUOTE_DELETED'		=> 'objavil odgovor, ki je bil izbrisan',
	'MCHAT_NEW_EDIT'				=> 'uredil objavo: %1$s v %2$s',
	'MCHAT_NEW_EDIT_DELETED'		=> 'uredil objavo, ki je bila izbrisana',
	'MCHAT_NEW_LOGIN'				=> 'pravkar prijavljen',
]);
