<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * Nederlandse vertaling @ Solidjeuh <http://www.froddelpower.be> 
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
	'MCHAT_WHO_IS_CHATTING'			=> 'Wie is aan het chatten',
	'MCHAT_ONLINE_USERS_TOTAL'		=> array(
		0 => 'Niemand is aan het chatten',
		1 => '<strong>%1$d</strong> gebruiker is aan het chatten',
		2 => '<strong>%1$d</strong> gebruikers zijn aan het chatten',
	),
	'MCHAT_ONLINE_EXPLAIN'			=> 'Gebaseerd op gebruikers activiteiten de laatste %1$s',
	'MCHAT_HOURS'					=> array(
		1 => '%1$d uur',
		2 => '%1$d uren',
	),
	'MCHAT_MINUTES'					=> array(
		1 => '%1$d minuut',
		2 => '%1$d minuten',
	),
	'MCHAT_SECONDS'					=> array(
		1 => '%1$d seconde',
		2 => '%1$d seconden',
	),

	// Post notification messages (%1$s is replaced with a link to the new/edited post, %2$s is replaced with a link to the forum)
	'MCHAT_NEW_POST'				=> 'poste een nieuwe topic in: %1$s in %2$s',
	'MCHAT_NEW_POST_DELETED'		=> 'poste een nieuwe topic dat werd verwijderd',
	'MCHAT_NEW_REPLY'				=> 'poste een reactie: %1$s in %2$s',
	'MCHAT_NEW_REPLY_DELETED'		=> 'poste een reactie dat werd verwijderd',
	'MCHAT_NEW_QUOTE'				=> 'antwoorde met een citaat: %1$s in %2$s',
	'MCHAT_NEW_QUOTE_DELETED'		=> 'poste een reactie dat werd verwijderd',
	'MCHAT_NEW_EDIT'				=> 'bewerkte een post: %1$s in %2$s',
	'MCHAT_NEW_EDIT_DELETED'		=> 'bewerkte een post dat werd verwijderd',
	'MCHAT_NEW_LOGIN'				=> 'heeft zich net aangemeld',
));
