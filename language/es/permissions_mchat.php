<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @Spanish Translation - ThE KuKa - http://www.phpbb-es.com
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
	'ACL_U_MCHAT_USE'						=> 'Puede usar mChat',
	'ACL_U_MCHAT_VIEW'						=> 'Puede ver mChat',
	'ACL_U_MCHAT_EDIT'						=> 'Puede editar mensajes',
	'ACL_U_MCHAT_DELETE'					=> 'Puede borrar mensajes',
	'ACL_U_MCHAT_IP'						=> 'Puede ver direcciones IP',
	'ACL_U_MCHAT_PM'						=> 'Puede usar mensajes privados',
	'ACL_U_MCHAT_LIKE'						=> 'Puede usar Me Gusta en los mensajes',
	'ACL_U_MCHAT_QUOTE'						=> 'Puede usar citar un mensajee',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Puede ignorar el límite de flujo',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Puede ver el archivo',
	'ACL_U_MCHAT_BBCODE'					=> 'Puede usar BBCode',
	'ACL_U_MCHAT_SMILIES'					=> 'Puede usar emoticonos',
	'ACL_U_MCHAT_URLS'						=> 'Puede publicar URLs',

	'ACL_U_MCHAT_AVATARS'					=> 'Puede personalizar <em>Mostrar Avatares</em>',
	'ACL_U_MCHAT_CAPITAL_LETTER'			=> 'Puede personalizar <em>Primera letra en mayúscula</em>',
	'ACL_U_MCHAT_CHARACTER_COUNT'			=> 'Puede personalizar <em>Mostrar número de caracteres</em>',
	'ACL_U_MCHAT_DATE'						=> 'Puede personalizar <em>Formato de Fecha</em>',
	'ACL_U_MCHAT_INDEX'						=> 'Puede personalizar <em>Mostrar en el índice</em>',
	'ACL_U_MCHAT_INPUT_AREA'				=> 'Puede personalizar <em>Tipo de Entrada</em>',
	'ACL_U_MCHAT_LOCATION'					=> 'Puede personalizar <em>Ubicación de mChat en la página índice</em>',
	'ACL_U_MCHAT_MESSAGE_TOP'				=> 'Puede personalizar <em>Ubicación de nuevos mensajes del Chat</em>',
	'ACL_U_MCHAT_PAUSE_ON_INPUT'			=> 'Puede personalizar <em>Pausa en la Entrada</em>',
	'ACL_U_MCHAT_POSTS'						=> 'Puede personalizar <em>Mostrar nuevo mensaje</em>',
	'ACL_U_MCHAT_RELATIVE_TIME'				=> 'Puede personalizar <em>Mostrar tiempo relativo</em>',
	'ACL_U_MCHAT_SOUND'						=> 'Puede personalizar <em>Reproducir Sonidos</em>',
	'ACL_U_MCHAT_WHOIS_INDEX'				=> 'Puede personalizar <em>Mostrar quién está chateando debajo del Chat</em>',
	'ACL_U_MCHAT_STATS_INDEX'				=> 'Puede personalizar <em>Mostrar quién está chateando en la sección de estadísticas</em>',

	'ACL_A_MCHAT'							=> 'Puede gestionar los ajustes de mChat',
));
