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
	'ACP_MCHAT_CONFIG'				=> 'Configuración',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Un mini chat (también conocido como “Caja de texto”) de tu foro',
	'MCHAT_TABLE_DELETED'			=> 'La tabla mChat ha sido eliminada',
	'MCHAT_TABLE_CREATED'			=> 'La tabla mChat ha sido creada',
	'MCHAT_TABLE_UPDATED'			=> 'La tabla mChat ha sido actualizada',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Nada que ver... Contunia',
	'UCP_CAT_MCHAT'					=> 'Preferencias de mChat',
	'UCP_MCHAT_CONFIG'				=> 'Preferencias de usuario de mChat',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Normas',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Introduzca las Normas del foro aquí.	Cada normas en una nueva línea.<br />Esto está limitado a 255 caracteres.<br /><strong>Este mensaje puede ser traducido.</strong> (hay que editar el archivo mchat_lang.php y lea las instrucciones).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Actualizada configuración de mChat </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'La configuración de Mini-Chat se ha actualizado',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versión:',
	'MCHAT_ENABLE'					=> 'Habilitar mChat MOD',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Activar o desactivar el mod a nivel global.',
	'MCHAT_AVATARS'					=> 'Mostrar avatars',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Si lo marca como si, los avatars serán mostrados a modo pequeño',
	'MCHAT_ON_INDEX'				=> 'mChat en el Index',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Permitir la visualización de la mChat en la página prncipal.',
	'MCHAT_INDEX_HEIGHT'			=> 'Altura de la página índice',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'La altura del cuadro de charla en pixels en la página índice del foro.<br /><em>Está limitado de 50 a 1000</em>.',
	'MCHAT_LOCATION'				=> 'Ubicación en el Foro',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Elegir la ubicación de mChat en la página prncipal.',
	'MCHAT_TOP_OF_FORUM'			=> 'Inicio del Foro',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Parte inferior del Foro',
	'MCHAT_REFRESH'					=> 'Refrescar',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Número de segundos antes de que el chat se actualice automáticamente. <strong>No ponga menos de 5 segundos</strong>.',
	'MCHAT_PRUNE'					=> 'Habilitar purga',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Se pone en SI para permitir la función purgar.<br /><em>Sólo ocurre si un usuario visita habitualmente las páginas de archivo</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Numero de purga',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'El número de mensajes de retener en el chat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Limite de mensajes',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'El número máximo de mensajes que se muestran en la página principal del foro.<br /><em>Recomendado de 10 a 20</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Límite de mensajes de la página Índice',
	'MCHAT_MESSAGE_NUM_EXPLAIN'		=> 'El número máximo de mensajes a mostrar en el area del Chat en la página índice.<br /><em>Recomendado de 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limite del Archivo',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'El número máximo de mensajes que se muestran en la página de Archivo.<br /> <em>Recomendado de 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Tiempo límite',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'El número de segundos que un usuario debe esperar antes de enviar otro mensaje en el chat.<br /><em>Recomendado de 5 a 30, establece en 0 para deshabilitar</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Máxima longitud del mensaje',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Número máximo de caracteres permitidos por mensaje enviado.<br /><em>Recomendado de 100 a 500, establece en 0 para deshabilitar</em>.',
	'MCHAT_CUSTOM_PAGE'				 => 'Página personalizada',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'				=> 'Permitir el uso de la página personalizada.',
	'MCHAT_CUSTOM_HEIGHT'					=> 'Altura de página personalizada',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'			=> 'La altura del cuadro de charla en pixels en la página por separado de mChat.<br /><em>Está limitado de 50 a 1000</em>.',
	'MCHAT_DATE_FORMAT'						=> 'Formato de fecha',
	'MCHAT_DATE_FORMAT_EXPLAIN'				=> 'La sintaxis usada es idéntica a la versión de ña función PHP <a href="http://www.php.net/date">date()</a>.',
	'MCHAT_CUSTOM_DATEFORMAT'				=> 'Personalizar...',
	'MCHAT_WHOIS'							=> 'Quienes',
	'MCHAT_WHOIS_EXPLAIN'					=> 'Permitir una visualización de los usuarios que están chateando.',
	'MCHAT_WHOIS_REFRESH'					=> 'Actualizar Quienes',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'			=> 'Número de segundos antes de que actualiza las estadísticas Quienes.<br /><strong>No ponga menos de 30 segundos</strong>.',
	'MCHAT_BBCODES_DISALLOWED'				=> 'Deshabilitar BBCodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'		=> 'Aquí puede introducir el tipo de bbcode que <strong>no</strong> se van a utilizar en un mensaje.<br />Separar BBcodes con una barra vertical, por ejemplo: b|u|code',
	'MCHAT_STATIC_MESSAGE'					=> 'Mensaje estatico',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'			=> 'Aquí puede definir un mensaje estatico que se mostrara a los usuarios en el chat.<br />Dejelo vacio para desactivarlo.	Está limitado a 255 caracteres.<br /><strong>Este mensaje puede ser traducido.</strong>	(solo necesita editar el archivo mchat_lang.php y leer las instrucciones).',
	'MCHAT_USER_TIMEOUT'					=> 'Tiempo de espera del usuario',
	'MCHAT_USER_TIMEOUT_EXPLAIN'			=> 'Ajuste una cantidad de tiempo, en segundos, hasta que la sesión del usuario del chat finalice. Ponga 0 para no tener tiempo de espera.<br /><em>Está limitado a %sAjustes de configuración de sesiones del foro%s que actualmente está en %s segundos</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Reemplazar límite de emoticonos',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Poner en Si, para reemplazar el ajuste del limite de emoticonos de los foros para los mensajes del chat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	 	=> 'Reemplazar límite de caracteres minimos',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Poner Si, para sobrescribir los ajustes de caracteres minimos del foro, en los mensajes del chat',
	'MCHAT_NEW_POSTS'						=> 'Mostrar nuevos mensajes',
	'MCHAT_NEW_POSTS_EXPLAIN'				=> 'Poner Si, para permitir nuevos mensajes del foro en el area de mensajes del chat.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Mostrar nuevos mensajes en temas',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Poner Si, para permitir nuevos mensajes en temas del foro en el area de mensajes del chat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Mostrar nuevos mensajes respondidos',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Poner Si, para permitir nuevos mensajes respondidos del foro en el area de mensajes del chat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Mostrar mensajes editados',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Poner Si, para permitir mensajes editados del foro en el area de mensajes del chat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Mostrar mensajes citados',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Poner Si, para permitir mensajes citados del foro en el area de mensajes del chat.',
	'MCHAT_MAIN'					=> 'Configuración principal',
	'MCHAT_STATS'					=> 'Quien esta chateando',
	'MCHAT_STATS_INDEX'				=> 'Estadisticas en el índice',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Muestar quien esta chateando en la sección de estadisticas del foro',
	'MCHAT_MESSAGE_TOP'				=> 'Mantenga el mensaje en la parte inferior/superior',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Esta publicará el mensaje en la parte inferior o superior del área de mensajes del chat.',
	'MCHAT_BOTTOM'					=> 'Abajo',
	'MCHAT_TOP'						=> 'Arriba',
	'MCHAT_MESSAGES'				=> 'Ajustes de mensaje',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pausa en la entrada',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Si pone Si, el chat no se actualizara automaticamente hasta que el usuario introduzca un mensaje',

	// error reporting
	'TOO_LONG_DATE'					=> 'El formato de fecha que ha entrado es demasiado largo.',
	'TOO_SHORT_DATE'				=> 'El formato de fecha que ha introducido es demasiado corto.',
	'TOO_SMALL_REFRESH'				=> 'El valor de refresco es demasiado corto.',
	'TOO_LARGE_REFRESH'				=> 'El valor de refresco es demasiado largo.',
	'TOO_SMALL_MESSAGE_LIMIT'		=> 'El valor límite de mensajes es demasiado corto.',
	'TOO_LARGE_MESSAGE_LIMIT'		=> 'El valor límite de mensajes es demasiado largo.',
	'TOO_SMALL_ARCHIVE_LIMIT'		=> 'El valor límite de archivo es demasiado corto.',
	'TOO_LARGE_ARCHIVE_LIMIT'		=> 'El valor límite de archivo es demasiado largo.',
	'TOO_SMALL_FLOOD_TIME'			=> 'El valor de tiempo limite es demasiado corto.',
	'TOO_LARGE_FLOOD_TIME'			=> 'El valor de tiempo limite es demasiado largo.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'El máximo valor de longitud de cada mensaje demasiado corto.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'El máximo valor de longitud de cada mensaje demasiado largo.',
	'TOO_SMALL_MAX_WORDS_LNGTH'		=> 'El valor máximo de palabras es demasiado corto.',
	'TOO_LARGE_MAX_WORDS_LNGTH' 	=> 'El valor máximo de palabras es demasiado largo.',
	'TOO_SMALL_WHOIS_REFRESH'		=> 'El valor de refresco de whois es demasiado corto.',
	'TOO_LARGE_WHOIS_REFRESH'		=> 'El valor de refresco de whois es demasiado largo.',
	'TOO_SMALL_INDEX_HEIGHT'		=> 'El valor de la altura del índice es demasiado corto.',
	'TOO_LARGE_INDEX_HEIGHT'		=> 'El valor de la altura del índice es demasiado largo.',
	'TOO_SMALL_CUSTOM_HEIGHT'		=> 'El valor de la altura personalizada es demasiado corto.',
	'TOO_LARGE_CUSTOM_HEIGHT'		=> 'El valor de la altura personalizada es demasiado largo.',
	'TOO_SHORT_STATIC_MESSAGE'		=> 'El valor del mensaje estatico es demasiado corto.',
	'TOO_LONG_STATIC_MESSAGE'		=> 'El valor del mensaje estatico es demasiado largo.',
	'TOO_SMALL_TIMEOUT'		 	=> 'El valor de tiempo de espera del usuario es demasiado corto.',
	'TOO_LARGE_TIMEOUT'				=> 'El valor de tiempo de espera del usuario es demasiado largo.',

	// User perms
	'ACL_U_MCHAT_USE'			=> 'Puede usar mChat',
	'ACL_U_MCHAT_VIEW'			=> 'Puede ver mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Puede editar mensajes en mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Puede borrar mensajes en mChat',
	'ACL_U_MCHAT_IP'			=> 'Puede ver direcciones IP en mChat',
	'ACL_U_MCHAT_PM'			=> 'Puede usar mensajes privados en mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Puede usar, me gusta el mensaje en mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Puede citar mensajes en mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Puede ignorar tiempo limite de mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Puede ver el Archivo de mChat',
	'ACL_U_MCHAT_BBCODE'		=> 'Puede usar BBCodes en mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Puede usar emoticonos en mChat',
	'ACL_U_MCHAT_URLS'			=> 'Puede poner URLs en mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Puede gestionar los ajustes de mChat',

));