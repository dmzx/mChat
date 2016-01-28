<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
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
	'ACP_MCHAT_CONFIG'						=> 'Configuración',
	'ACP_CAT_MCHAT'							=> 'mChat',
	'ACP_MCHAT_TITLE'						=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'				=> 'Un mini chat (aquí “cuadro de charla”) para su foro',
	'MCHAT_TABLE_DELETED'					=> 'La tabla de mChat ha sido borrada correctamente',
	'MCHAT_TABLE_CREATED'					=> 'La tabla de mChat ha sido creada correctamente',
	'MCHAT_TABLE_UPDATED'					=> 'La tabla de mChat ha sido actualizada correctamente',
	'MCHAT_NOTHING_TO_UPDATE'				=> 'Nada que ver.... Continuar',
	'UCP_CAT_MCHAT'							=> 'Preferencias de mChat',
	'UCP_MCHAT_CONFIG'						=> 'Preferencias de Usuario de mChat',

	// ACP entries
	'ACP_MCHAT_RULES'						=> 'Normas',
	'ACP_MCHAT_RULES_EXPLAIN'				=> 'Introduzca las normas del foro aquí. Cada norma en una nueva línea.<br />Está limitado a 255 caracteres.<br /><strong>Este mensaje puede ser traducido.</strong> (debe editar el archivo mchat_lang.php y leer las instrucciones).',
	'LOG_MCHAT_CONFIG_UPDATE'				=> '<strong>Updated mChat config </strong>',
	'MCHAT_CONFIG_SAVED'					=> 'La configuración de Mini Chat ha sido actualizada',
	'MCHAT_TITLE'							=> 'Mini-Chat',
	'MCHAT_VERSION'							=> 'Versión:',
	'MCHAT_AVATARS'							=> 'Mostrar avatares',
	'MCHAT_AVATARS_EXPLAIN'					=> 'Si se establece en Si, se mostrarán los avatares redimensionados de los usuarios',
	'MCHAT_ON_INDEX'						=> 'mChat en el índice',
	'MCHAT_ON_INDEX_EXPLAIN'				=> 'Permite mostrar el mChat en la página índice.',
	'MCHAT_INDEX_HEIGHT'					=> 'Altura en la página índice',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'			=> 'La altura de la ventana del chat en píxeles en la página índice del foro.<br /><em>Está limitado de 50 a 1000</em>.',
	'MCHAT_LOCATION'						=> 'Ubicación en el foro',
	'MCHAT_LOCATION_EXPLAIN'				=> 'Elija la ubicación del mChat en la página índice.',
	'MCHAT_TOP_OF_FORUM'					=> 'Encima del foro',
	'MCHAT_BOTTOM_OF_FORUM'					=> 'Debajo del foro',
	'MCHAT_REFRESH'							=> 'Refrescar',
	'MCHAT_REFRESH_EXPLAIN'					=> 'Número de segundos antes de que el chat se actualice automáticamente.<br /><em>Está limitado de 5 a 60 segundos</em>.',
	'MCHAT_LIVE_UPDATES'					=> 'Actualizar en tiempo real los mensajes editados y eliminados',
	'MCHAT_LIVE_UPDATES_EXPLAIN'			=> 'Cuando un usuario edita o elimina los mensajes, los cambios se actualizan en vivo para todos los demás, sin que tengan que actualizar la página. Desactive esta opción si experimenta problemas de rendimiento.',
	'MCHAT_PRUNE'							=> 'Habilitar la limpieza (purga)',
	'MCHAT_PRUNE_EXPLAIN'					=> 'Establezca esto en Si, para activar la función de limpieza (purga).<br /><em>Sólo se produce si un usuario visita páginas personalizadas o archivo</em>.',
	'MCHAT_PRUNE_NUM'						=> 'Número de limpieza (purga)',
	'MCHAT_PRUNE_NUM_EXPLAIN'				=> 'El número de mensajes a retener en el chat.',
	'MCHAT_MESSAGE_LIMIT'					=> 'Límite de mensajes',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'			=> 'El número máximo de mensajes que se muestran en el área de chat.<br /><em>Recomendado de 10 a 30</em>.',
	'MCHAT_MESSAGE_NUM'						=> 'Límite de mensajes en la página índice',
	'MCHAT_MESSAGE_NUM_EXPLAIN'				=> 'El número máximo de mensajes que se muestran en el área de chat en la página índice.<br /><em>Recomendado de 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'					=> 'Límite del archivo',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'			=> 'El número máximo de mensajes a mostrar por página en la página del archivo.<br /><em>Recomendado de 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'						=> 'Tiempo de flujo',
	'MCHAT_FLOOD_TIME_EXPLAIN'				=> 'El número de segundos que un usuario debe esperar antes de poder enviar otro mensaje en el chat.<br /><em>Recomendado de 5 a 30, establezca esto en 0 para deshabilitar</em>.',
	'MCHAT_EDIT_DELETE_LIMIT'				=> 'Tiempo límite para la edición de mensajes y su borrado',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'		=> 'Los mensajes que superen el número de segundos especificado, no podrán ser editados o borrados por el autor tras dicho tiempo.<br />Los usuarios que tienen el permiso de editar/borrar, así como <em>permiso de Moderador están exentos</em> de este tiempo límite.<br />Establezca en 0 para permitir la edición y el borrado sin límite.',
	'MCHAT_MAX_MESSAGE_LENGTH'				=> 'Longitud máxima del mensaje',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'		=> 'Número máximo de caracteres permitidos por cada mensaje publicado.<br /><em>Recomendado de 100 a 500, establezca esto en 0 para deshabilitar</em>.',
	'MCHAT_CUSTOM_PAGE'						=> 'Página personalizada',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'				=> 'Permitir el uso de página personalizada',
	'MCHAT_CUSTOM_HEIGHT'					=> 'Altura de la página personalizado',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'			=> 'La altura de la ventana del chat en píxeles en la página separada de mChat.<br /><em>Está límitado de 50 a 1000</em>.',
	'MCHAT_DATE_FORMAT'						=> 'Formato de fecha',
	'MCHAT_DATE_FORMAT_EXPLAIN'				=> 'La sintaxis utilizada es idéntica a la función de PHP <a href="http://www.php.net/date">date()</a>.',
	'MCHAT_CUSTOM_DATEFORMAT'				=> 'Personalizada…',
	'MCHAT_WHOIS'							=> 'Quién es',
	'MCHAT_WHOIS_EXPLAIN'					=> 'Allow a display of users who are chatting',
	'MCHAT_WHOIS_REFRESH'					=> 'Refrescar Quien es',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'			=> 'Number of seconds before whois stats refreshes.<br /><em>Está límitado de 30 a 300 segundos</em>.',
	'MCHAT_BBCODES_DISALLOWED'				=> 'BBCodes deshabilitados',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'		=> 'Aquí puede introducir los BBCodes que <strong>no</strong> se pueden usar en los mensajes.<br />Separar los BBCodes con una barra vertical, por ejemplo: <br />b|i|u|code|list|list=|flash|quote y/o un %snombre de etiqueta de BBCode personalizado%s',
	'MCHAT_STATIC_MESSAGE'					=> 'Mensaje estático',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'			=> 'Aquí puede definir un mensaje estático para mostrar a los usuarios de la chat. Código HTML está permitido.<br />Deje esto en blanco para deshabilitar esto. Está límitado a 255 caracteres.<br /><strong>Este mensaje puede ser traducido.</strong> (debe editar el archivo mchat_lang.php y leer las instrucciones).',
	'MCHAT_USER_TIMEOUT'					=> 'Tiempo de espera del usuario',
	'MCHAT_USER_TIMEOUT_EXPLAIN'			=> 'Establezca la cantidad de tiempo, en segundos, hasta que una sesión de usuario en el chat termina. Se establece en 0 para que no haya tiempo de espera.<br /><em>Está límitado a %sconfiguración de sesiones del foro%s que está actualmente en %s segundos</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Anular límite de emoticonos',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Establezca en Sí, para anular el ajustes del límite de emoticonos en los foros, para mensajes del chat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'			=> 'Anular límite mínimo caracteres',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Establezca en Sí, para anular el ajustes del límite mínimo de caracteres en los foros, para mensajes del chat',
	'MCHAT_NEW_POSTS'						=> 'Habilitar mostrar mensajes',
	'MCHAT_NEW_POSTS_EXPLAIN'				=> 'Establezca en Si, y podrá establecer debajo las opciones de cuál es el mensaje que se mostrará en el área de mensajes del chat.',
	'MCHAT_NEW_POSTS_TOPIC'					=> 'Mostrar mensaje de Nuevo Tema',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'			=> 'Establezca en Sí, para permitir que los nuevos temas del foro puedan ser publicados en el área de mensajes del chat.',
	'MCHAT_NEW_POSTS_REPLY'					=> 'Mostrar mensaje de Nueva Respuesta',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'			=> 'Establezca en Sí, para permitir que las respuestas de mensajes del foro puedan ser publicadas en el área de mensajes del chat.',
	'MCHAT_NEW_POSTS_EDIT'					=> 'Mostrar mensajes editados',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'			=> 'Establezca en Sí, para permitir que los mensajes editados desde el foro sean publicados en el área de mensajes del chat.',
	'MCHAT_NEW_POSTS_QUOTE'					=> 'Mostrar mensajes citados',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'			=> 'Establezca en Sí, para permitir que los mensajes citados del foro sean publicados en el área de mensajes del chat.',
	'MCHAT_MAIN'							=> 'Configuración principal',
	'MCHAT_STATS'							=> 'Quién está chateando',
	'MCHAT_STATS_INDEX'						=> 'Estadísticas en el Índice',
	'MCHAT_STATS_INDEX_EXPLAIN'				=> 'Mostrar quién está chateando en la sección de estadísticas del foro',
	'MCHAT_MESSAGE_TOP'						=> 'Mantener mensaje Debajo / Encima',
	'MCHAT_MESSAGE_TOP_EXPLAIN'				=> 'Esta publicará el mensaje en la parte inferior o superior en el área de mensajes del chat',
	'MCHAT_BOTTOM'							=> 'Debajo',
	'MCHAT_TOP'								=> 'Encima',
	'MCHAT_MESSAGES'						=> 'Ajustes de mensaje',
	'MCHAT_PAUSE_ON_INPUT'					=> 'Pausa en la entrada',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'			=> 'Si se establece en Si, el chat no actualizará automáticamente a un usuario al introducir un mensaje en el área de entrada',

	// Error reporting
	'TOO_LONG_DATE'							=> 'El formato de la fecha que ha escrito es demasiado largo.',
	'TOO_SHORT_DATE'						=> 'El formato de la fecha que ha escrito es demasiado corto.',
	'TOO_SMALL_REFRESH'						=> 'El valor de actualización es demasiado pequeño.',
	'TOO_LARGE_REFRESH'						=> 'El valor de actualización es demasiado grande.',
	'TOO_SMALL_MESSAGE_LIMIT'				=> 'El valor límite de mensajes es demasiado pequeño.',
	'TOO_LARGE_MESSAGE_LIMIT'				=> 'El valor límite de mensajes es demasiado grande.',
	'TOO_SMALL_ARCHIVE_LIMIT'				=> 'El valor límite de archivo es demasiado pequeño.',
	'TOO_LARGE_ARCHIVE_LIMIT'				=> 'El valor límite de archivo es demasiado grande.',
	'TOO_SMALL_FLOOD_TIME'					=> 'El valor de tiempo de flujo es demasiado pequeño.',
	'TOO_LARGE_FLOOD_TIME'					=> 'El valor de tiempo de flujo es demasiado grande.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'			=> 'El valor de longitud máxima de mensaje es demasiado pequeño.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'			=> 'El valor de longitud máxima de mensaje es demasiado grande.',
	'TOO_SMALL_MAX_WORDS_LNGTH'				=> 'El valor de la longitud de palabras máximas es demasiado pequeño.',
	'TOO_LARGE_MAX_WORDS_LNGTH'				=> 'El valor de la longitud de palabras máximas es demasiado grande.',
	'TOO_SMALL_WHOIS_REFRESH'				=> 'El valor de refresco whois es demasiado pequeño.',
	'TOO_LARGE_WHOIS_REFRESH'				=> 'El valor de refresco whois es demasiado grande.',
	'TOO_SMALL_INDEX_HEIGHT'				=> 'El valor de la altura de índice es demasiado pequeño.',
	'TOO_LARGE_INDEX_HEIGHT'				=> 'El valor de la altura de índice es demasiado grande.',
	'TOO_SMALL_CUSTOM_HEIGHT'				=> 'El valor de altura a medida es demasiado pequeña.',
	'TOO_LARGE_CUSTOM_HEIGHT'				=> 'El valor de altura a medida es demasiado grande.',
	'TOO_SHORT_STATIC_MESSAGE'				=> 'El valor de mensaje estático es demasiado corto.',
	'TOO_LONG_STATIC_MESSAGE'				=> 'El valor de mensaje estático es demasiado largo.',
	'TOO_SMALL_TIMEOUT'						=> 'El valor de tiempo de espera del usuario es demasiado pequeño.',
	'TOO_LARGE_TIMEOUT'						=> 'El valor de tiempo de espera del usuario es demasiado grande.',

	// User perms
	'ACL_U_MCHAT_USE'						=> 'Puede usar mChat',
	'ACL_U_MCHAT_VIEW'						=> 'Puede ver mChat',
	'ACL_U_MCHAT_EDIT'						=> 'Puede editar mensajes',
	'ACL_U_MCHAT_DELETE'					=> 'Puede borrar mensajes',
	'ACL_U_MCHAT_IP'						=> 'Puede ver direcciones IP',
	'ACL_U_MCHAT_PM'						=> 'Puede usar mensajes privados',
	'ACL_U_MCHAT_LIKE'						=> 'Puede usar Me Gusta en los mensajes',
	'ACL_U_MCHAT_QUOTE'						=> 'Puede usar citar un mensajee',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Puede ignorar el flujo',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Puede ver el archivo',
	'ACL_U_MCHAT_BBCODE'					=> 'Puede usar BBCode',
	'ACL_U_MCHAT_SMILIES'					=> 'Puede usar emoticonos',
	'ACL_U_MCHAT_URLS'						=> 'Puede publicar URLs',

	// Admin perms
	'ACL_A_MCHAT'							=> 'Puede gestionar los ajustes de mChat',
));
