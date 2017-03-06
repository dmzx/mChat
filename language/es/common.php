<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @Spanish Translation - ThE KuKa - http://www.phpbb-es.com
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

	// Who is chatting
	'MCHAT_WHO_IS_CHATTING'			=> 'Quién está chateando',
	'MCHAT_ONLINE_USERS_TOTAL'		=> array(
		0 => 'Nadie está chateando',
		1 => 'En total hay <strong>%1$d</strong> usuario chateando',
		2 => 'En total hay <strong>%1$d</strong> usuarios chateando',
	),
	'MCHAT_ONLINE_EXPLAIN'			=> 'basado en usuarios activos en los últimos %1$s',
	'MCHAT_HOURS'					=> array(
		1 => '%1$d hora',
		2 => '%1$d horas',
	),
	'MCHAT_MINUTES'					=> array(
		1 => '%1$d minuto',
		2 => '%1$d minutos',
	),
	'MCHAT_SECONDS'					=> array(
		1 => '%1$d segundo',
		2 => '%1$d segundos',
	),

	// Post notification messages (%1$s is replaced with a link to the new/edited post, %2$s is replaced with a link to the forum)
	'MCHAT_NEW_POST'				=> 'Nuevo tema publicado: %1$s en %2$s',
	'MCHAT_NEW_REPLY'				=> 'Respuesta publicada: %1$s en %2$s',
	'MCHAT_NEW_QUOTE'				=> 'Respuesta con cita: %1$s en %2$s',
	'MCHAT_NEW_EDIT'				=> 'Mensaje editado: %1$s en %2$s',
));
