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
	// ACP configuration sections
	'MCHAT_SETTINGS_INDEX'							=> 'Ajustes de la página índice',
	'MCHAT_SETTINGS_CUSTOM'							=> 'Ajustes de la pagina personalizada',
	'MCHAT_SETTINGS_ARCHIVE'						=> 'Ajustes de la página de archivo',
	'MCHAT_SETTINGS_POSTS'							=> 'Ajustes de nuevos mensajes',
	'MCHAT_SETTINGS_MESSAGES'						=> 'Ajustes de mensajes',
	'MCHAT_SETTINGS_PRUNE'							=> 'Ajustes de limpieza',
	'MCHAT_SETTINGS_STATS'							=> 'Ajustes de quién está chateando',

	'MCHAT_GLOBALUSERSETTINGS_EXPLAIN'				=> 'Ajustes para el que un usuario hace <strong>no</strong> tiene permiso para personalizar se aplican como se ha configurado a continuación.<br />Las nuevas cuentas de usuario tendrán ajustes iniciales como se ha configurado a continuación.<br /><br />Vaya a la pestaña de <em>mChat en el PCU</em> de la sección de permisos de usuario para ajustar los permisos de personalización.<br />Vaya al formulario de <em>Preferencias</em> en la sección de la sección de <em>gestión de usuario</em> para ver el estado de configuración de cada usuario.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE'			=> 'Sobreescribir los ajustes de todos los usuarios',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_EXPLAIN'	=> 'Se aplica la configuración definida anteriormente a <em>todas</em> las cuentas de usuarios.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_CONFIRM'	=> 'Confirmar la sobrescritura de los ajustes de mChat para todos los usuarios',

	'MCHAT_ACP_USER_PREFS_EXPLAIN'					=> 'A continuación se enumeran todas las preferencias de mChat del usuario seleccionado. Los ajustes para el cual el usuario seleccionado no tiene permiso para personalizar, están desactivados. Estos ajustes se pueden modificar en los <em>Ajustes Globales del Usuario</em> en la sección de configuración de mChat.',

	// ACP settings
	'MCHAT_ACP_GLOBALSETTINGS_TITLE'				=> 'Ajustes Globales de mChat',
	'MCHAT_ACP_GLOBALUSERSETTINGS_TITLE'			=> 'Ajustes Globales de Usuario de mChat',
	'MCHAT_VERSION'									=> 'Versión',
	'MCHAT_RULES'									=> 'Normas',
	'MCHAT_RULES_EXPLAIN'							=> 'Introduzca las normas del foro aquí. Cada norma en una nueva línea. Código HTML está permitido.<br />Está limitado a 255 caracteres.<br /><strong>Este mensaje puede ser traducido: edite la variable de lenguage MCHAT_RULES_MESSAGE en /ext/dmzx/mchat/language/XX/common.php.',
	'MCHAT_CONFIG_SAVED'							=> 'La configuración de Mini Chat ha sido actualizada',
	'MCHAT_AVATARS'									=> 'Mostrar avatares',
	'MCHAT_AVATARS_EXPLAIN'							=> 'Si se establece en Si, se mostrarán los avatares redimensionados de los usuarios',
	'MCHAT_INDEX'									=> 'Mostrar mChat en la página índice',
	'MCHAT_INDEX_HEIGHT'							=> 'Altura en la página índice',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'					=> 'La altura de la ventana del chat en píxeles en la página índice del foro.<br /><em>Está limitado de 50 a 1000</em>.',
	'MCHAT_TOP_OF_FORUM'							=> 'Encima del foro',
	'MCHAT_BOTTOM_OF_FORUM'							=> 'Debajo del foro',
	'MCHAT_REFRESH'									=> 'Refrescar',
	'MCHAT_REFRESH_EXPLAIN'							=> 'Número de segundos antes de que el chat se actualice automáticamente.<br /><em>Está limitado de 5 a 60 segundos</em>.',
	'MCHAT_LIVE_UPDATES'							=> 'Actualizar en tiempo real los mensajes editados y eliminados',
	'MCHAT_LIVE_UPDATES_EXPLAIN'					=> 'Cuando un usuario edita o elimina los mensajes, los cambios se actualizan en vivo para todos los demás, sin que tengan que actualizar la página. Desactive esta opción si experimenta problemas de rendimiento.',
	'MCHAT_PRUNE'									=> 'Habilitar la limpieza (purga)',
	'MCHAT_PRUNE_EXPLAIN'							=> 'Sólo se produce si un usuario visita páginas personalizadas o archivo.',
	'MCHAT_PRUNE_NUM'								=> 'Número de limpieza (purga)',
	'MCHAT_NAVBAR_LINK'								=> 'Mostrar enlace en página personalizada en la barra de navegación',
	'MCHAT_MESSAGE_NUM_CUSTOM'						=> 'Número de mensajes inicial a mostrar en la página personalizada',
	'MCHAT_MESSAGE_NUM_CUSTOM_EXPLAIN'				=> '<em>Está limitado de 5 a 50. Por defecto es 10.</em>',
	'MCHAT_MESSAGE_NUM_INDEX'						=> 'Número de mensajes inicial a mostrar en la página índice',
	'MCHAT_MESSAGE_NUM_INDEX_EXPLAIN'				=> '<em>Está limitado de 5 a 50. Por defecto es 10.</em>',
	'MCHAT_MESSAGE_NUM_ARCHIVE'						=> 'Número de mensajes a mostrar en la página de archivo',
	'MCHAT_MESSAGE_NUM_ARCHIVE_EXPLAIN'				=> 'Número máximo de mensajes que se muestran por página en la página de archivo.<br /><em>Está limitado de 10 a 100. Por defecto es 25.</em>',
	'MCHAT_FLOOD_TIME'								=> 'Tiempo de flujo',
	'MCHAT_FLOOD_TIME_EXPLAIN'						=> 'El número de segundos que un usuario debe esperar antes de poder enviar otro mensaje en el chat.<br /><em>Recomendado de 5 a 30, establezca esto en 0 para deshabilitar</em>.',
	'MCHAT_EDIT_DELETE_LIMIT'						=> 'Tiempo límite para la edición de mensajes y su borrado',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'				=> 'Los mensajes que superen el número de segundos especificado, no podrán ser editados o borrados por el autor tras dicho tiempo.<br />Los usuarios que tienen el permiso de editar/borrar, así como <em>permiso de Moderador están exentos</em> de este tiempo límite.<br />Establezca en 0 para permitir la edición y el borrado sin límite.',
	'MCHAT_MAX_MESSAGE_LENGTH'						=> 'Longitud máxima del mensaje',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'				=> 'Número máximo de caracteres permitidos por cada mensaje publicado.<br /><em>Recomendado de 100 a 500, establezca esto en 0 para deshabilitar</em>.',
	'MCHAT_CUSTOM_PAGE'								=> 'Página personalizada',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'						=> 'Permitir el uso de página personalizada',
	'MCHAT_CUSTOM_HEIGHT'							=> 'Altura de la página personalizado',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'					=> 'La altura de la ventana del chat en píxeles en la página separada de mChat.<br /><em>Está límitado de 50 a 1000</em>.',
	'MCHAT_BBCODES_DISALLOWED'						=> 'BBCodes deshabilitados',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'				=> 'Aquí puede introducir los BBCodes que <strong>no</strong> se pueden usar en los mensajes.<br />Separar los BBCodes con una barra vertical, por ejemplo: <br />b|i|u|code|list|list=|flash|quote y/o un %snombre de etiqueta de BBCode personalizado%s',
	'MCHAT_STATIC_MESSAGE'							=> 'Mensaje estático',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'					=> 'Aquí puede definir un mensaje estático para mostrar a los usuarios de la chat. Código HTML está permitido.<br />Deje esto en blanco para deshabilitar esto. Está límitado a 255 caracteres.<br /><strong>Este mensaje puede ser traducido.</strong> (debe editar el archivo mchat_lang.php y leer las instrucciones).',
	'MCHAT_USER_TIMEOUT'							=> 'Tiempo de espera del usuario',
	'MCHAT_USER_TIMEOUT_EXPLAIN'					=> 'Establezca la cantidad de tiempo, en segundos, hasta que una sesión de usuario en el chat termina. Se establece en 0 para que no haya tiempo de espera.<br /><em>Está límitado a %sconfiguración de sesiones del foro%s que está actualmente en %s segundos</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'					=> 'Anular límite de emoticonos',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'			=> 'Establezca en Sí, para anular el ajustes del límite de emoticonos en los foros, para mensajes del chat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'					=> 'Anular límite mínimo caracteres',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'			=> 'Establezca en Sí, para anular el ajustes del límite mínimo de caracteres en los foros, para mensajes del chat',

	'MCHAT_WHOIS_REFRESH'							=> 'Intervalo de actualización de quién está chateando',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'					=> 'Número de segundos antes de que el Chat se refresque.<br /><em>Está limitado de 10 a 300 segundos. Por defecto es 60.</em>',
	'MCHAT_SOUND'									=> 'Reproducir sonidos para los nuevos mensajes, al editar y eliminar mensajes',
	'MCHAT_PURGE'									=> 'Borrar todos los mensajes ahora',
	'MCHAT_PURGE_CONFIRM'							=> 'Confirmar la eliminación de todos los mensajes',
	'MCHAT_PURGED'									=> 'Todos los mensajes de mChat han sido eliminados correctamente',

	// Error reporting
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'				=> 'El valor de BBCodes no permitidos es demasiado largo.',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'					=> 'El valor de altura a medida es demasiado pequeña.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'					=> 'El valor de altura a medida es demasiado grande.',
	'TOO_LONG_MCHAT_DATE'							=> 'El formato de la fecha que ha escrito es demasiado largo.',
	'TOO_SHORT_MCHAT_DATE'							=> 'El formato de la fecha que ha escrito es demasiado corto.',
	'TOO_SMALL_MCHAT_FLOOD_TIME'					=> 'El valor de tiempo de flujo es demasiado pequeño.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'					=> 'El valor de tiempo de flujo es demasiado grande.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'					=> 'El valor de la altura de índice es demasiado pequeño.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'					=> 'El valor de la altura de índice es demasiado grande.',
	'TOO_SMALL_MCHAT_MAX_MESSAGE_LNGTH'				=> 'El valor de longitud máxima de mensaje es demasiado pequeño.',
	'TOO_LARGE_MCHAT_MAX_MESSAGE_LNGTH'				=> 'El valor de longitud máxima de mensaje es demasiado grande.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'El número de mensajes a mostrar en la página personalizada es demasiado pequeño.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'El número de mensajes a mostrar en la página personalizada es demasiado grande.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_INDEX'				=> 'El número de mensajes a mostrar en la página índice es demasiado pequeño.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_INDEX'				=> 'El número de mensajes a mostrar en la página índice es demasiado grande.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'El número de mensajes a mostrar en la página archivo es demasiado pequeño.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'El número de mensajes a mostrar en la página archivo es demasiado grande.',
	'TOO_SMALL_MCHAT_REFRESH'						=> 'El valor de actualización es demasiado pequeño.',
	'TOO_LARGE_MCHAT_REFRESH'						=> 'El valor de actualización es demasiado grande.',
	'TOO_LONG_MCHAT_STATIC_MESSAGE'					=> 'El valor de mensaje estático es demasiado largo.',
	'TOO_SMALL_MCHAT_TIMEOUT'						=> 'El valor de tiempo de espera del usuario es demasiado pequeño.',
	'TOO_LARGE_MCHAT_TIMEOUT'						=> 'El valor de tiempo de espera del usuario es demasiado grande.',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'					=> 'El valor de refresco whois es demasiado pequeño.',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'					=> 'El valor de refresco whois es demasiado grande.',
));
