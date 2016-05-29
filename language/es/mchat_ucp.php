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
	'MCHAT_PREFERENCES'				=> 'Preferencias de mChat',
	'MCHAT_NO_SETTINGS'				=> 'No está autorizado a personalizar ningún ajuste.',

	'MCHAT_INDEX'					=> 'Mostrar en la página índice',
	'MCHAT_SOUND'					=> 'Habilitar sonido',
	'MCHAT_WHOIS_INDEX'				=> 'Mostrar <em>Quién está chateando</em> debajo del chat',
	'MCHAT_STATS_INDEX'				=> 'Mostrar <em>Quién está chateando</em> en la sección de estadísticas',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Mostrar quién está chateando en la sección de estadísticas del foro',
	'MCHAT_AVATARS'					=> 'Mostrar avatares',
	'MCHAT_CAPITAL_LETTER'			=> 'Mayúscula para la primera letra en sus mensajes',
	'MCHAT_CHAT_AREA'				=> 'Tipo de entrada',
	'MCHAT_INPUT_AREA'				=> 'Área de entrada (Input)',
	'MCHAT_TEXT_AREA'				=> 'Área de texto (Textarea)',
	'MCHAT_POSTS'					=> 'Mostrar nuevos mensajes (actualmente todo desactivado, puede activarlo en la sección de Ajustes Globales de mChats en el PCA)',
	'MCHAT_CHARACTER_COUNT'			=> 'Mostrar número de caracteres cuando se escribe un mensaje',
	'MCHAT_RELATIVE_TIME'			=> 'Mostrar el tiempo relativo para los nuevos mensajes',
	'MCHAT_RELATIVE_TIME_EXPLAIN'	=> 'Mostrar “justo ahora”, “hace 1 minuto” y así sucesivamente para cada mensaje. Establezca en <em>No</em> para mostrar siempre la fecha completa.',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pausa en la entrada',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'El chat no se actualizará automáticamente cuando un usuario este introduciendo un mensaje en el área de entrada',
	'MCHAT_MESSAGE_TOP'				=> 'Mantener mensaje Debajo / Encima',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Esto publicará el mensaje en la parte inferior o superior en el área de mensajes del chat',
	'MCHAT_LOCATION'				=> 'Ubicación en la página índice',
	'MCHAT_BOTTOM'					=> 'Debajo',
	'MCHAT_TOP'						=> 'Encima',

	'MCHAT_POSTS_TOPIC'				=> 'Mostrar nuevos temas',
	'MCHAT_POSTS_REPLY'				=> 'Mostrar nuevas respuestas',
	'MCHAT_POSTS_EDIT'				=> 'Mostrar mensajes editados',
	'MCHAT_POSTS_QUOTE'				=> 'Mostrar mensajes citado',

	'MCHAT_DATE_FORMAT'				=> 'Formato de fecha',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'La sintaxis usada es idéntica a la función de PHP <a href="http://www.php.net/date">date()</a> .',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Personalizado…',
));
