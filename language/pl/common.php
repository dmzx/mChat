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
	'MCHAT_TITLE'					=> 'mChat',
	'MCHAT_TITLE_COUNT'				=> 'mChat [<strong>%1$d</strong>]',

	// Who is chatting
	'MCHAT_WHO_IS_CHATTING'			=> 'Kto czatuje',
	'MCHAT_ONLINE_USERS_TOTAL'		=> array(
		0 => 'Nikt nie czatuje',
		1 => '<strong>%1$d</strong> użytkownik czatuje',
		2 => '<strong>%1$d</strong> użytkowników czatuje',
	),
	'MCHAT_ONLINE_EXPLAIN'			=> 'bazując na użytkownikach aktywnych w ostatniej/ostatnich %1$s',
	'MCHAT_HOURS'					=> array(
		1 => '%1$d godzinie',
		2 => '%1$d godzinach',
	),
	'MCHAT_MINUTES'					=> array(
		1 => '%1$d minucie',
		2 => '%1$d minutach',
	),
	'MCHAT_SECONDS'					=> array(
		1 => '%1$d sekundzie',
		2 => '%1$d sekundach',
	),

	// Post notification messages (%1$s is replaced with a link to the new/edited post, %2$s is replaced with a link to the forum)
	'MCHAT_NEW_POST'				=> 'umieścił/a nowy post: %1$s in %2$s',
	'MCHAT_NEW_POST_DELETED'		=> 'umieścił/a nowy post, który został usunięty',
	'MCHAT_NEW_REPLY'				=> 'umieścił/a odpowiedź: %1$s w %2$s',
	'MCHAT_NEW_REPLY_DELETED'		=> 'umieścił/a odpowiedź, która została usunięta',
	'MCHAT_NEW_QUOTE'				=> 'odpowiedział/a z cytowaniem: %1$s w %2$s',
	'MCHAT_NEW_QUOTE_DELETED'		=> 'umieścił/a odpowiedź, która została usunięta',
	'MCHAT_NEW_EDIT'				=> 'zedytował/a post: %1$s in %2$s',
	'MCHAT_NEW_EDIT_DELETED'		=> 'zedytował/a post, który został usunięty',
	'MCHAT_NEW_LOGIN'				=> 'właśnie się zalogował/a',
));
