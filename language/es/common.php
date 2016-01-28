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

$lang = array_merge($lang, array(
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_ADD'						=> 'Enviar',
	'MCHAT_IN'						=> 'en',
	'MCHAT_IN_SECTION'				=> 'sección',
	'MCHAT_LIKES'					=> 'Me Gusta este mensaje',
	'MCHAT_ANNOUNCEMENT'			=> 'Anuncio',
	'MCHAT_ARCHIVE'					=> 'Archivo',
	'MCHAT_ARCHIVE_PAGE'			=> 'Archivo de Mini-Chat',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CLEAN'					=> 'Purge',
	'MCHAT_CLEANED'					=> 'Todos los mensajes han sido eliminados correctamente',
	'MCHAT_CLEAR_INPUT'				=> 'Reiniciar',
	'MCHAT_COPYRIGHT'				=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'			=> 'BBCodes personalizados',
	'MCHAT_DELALLMESS'				=> '¿Eliminar todos los mensajes?',
	'MCHAT_DELCONFIRM'				=> '¿Quiere confirmar el borrado?',
	'MCHAT_DELITE'					=> 'Borrar',
	'MCHAT_EDIT'					=> 'Editar',
	'MCHAT_EDITINFO'				=> 'Editar el mensaje y haga clic en OK',
	'MCHAT_ERROR'					=> 'Error',
	'MCHAT_FLOOD'					=> 'No puede enviar otro mensaje tan pronto después de su último mensaje',
	'MCHAT_FOE'						=> 'Este mensaje fue creado por <strong>%1$s</strong> que se encuentra actualmente en su lista de ignorados.',
	'MCHAT_HELP'					=> 'Normas de mChat',
	'MCHAT_HIDE_LIST'				=> 'Ocultar Lista',
	'MCHAT_HOUR'					=> 'hora',
	'MCHAT_HOURS'					=> 'horas',
	'MCHAT_IP'						=> 'IP whois de',
	'MCHAT_MINUTE'					=> 'minuto',
	'MCHAT_MINUTES'					=> 'minutos',
	'MCHAT_MESS_LONG'				=> 'Su mensaje es demasiado largo.\nPor favor, debe limitarlo a %s caracteres',
	'MCHAT_NO_CUSTOM_PAGE'			=> '¡La página personalizada de mChat no está habilitada en este momento!',
	'MCHAT_NO_RULES'				=> '¡Las normas de mChat no están habilitadas en este momento!',
	'MCHAT_NOACCESS'				=> 'Usted no tiene permiso para publicar en el mChat',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Usted no tiene permiso para ver el archivo',
	'MCHAT_NOJAVASCRIPT'			=> 'Su navegador no soporta JavaScript, o JavaScript está desactivado',
	'MCHAT_NOMESSAGE'				=> 'No hay mensajes',
	'MCHAT_NOMESSAGEINPUT'			=> 'No ha escrito ningún mensaje',
	'MCHAT_NOSMILE'					=> 'No se encontraron los Emoticonos',
	'MCHAT_NOTINSTALLED_USER'		=> 'mChat no está instalado. Por favor, notifique al fundador del foro.',
	'MCHAT_NOT_INSTALLED'			=> 'Faltan las entradas de mChat en la base de datos.<br />Por favor, ejecute el %sinstalador%s para hacer los cambios en la base de datos para está modificación.',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Pausado',
	'MCHAT_LOAD'					=> 'Cargando',
	'MCHAT_PERMISSIONS'				=> 'Change user’s permissions',
	'MCHAT_REFRESHING'				=> 'Refrescando...',
	'MCHAT_REFRESH_NO'				=> 'La actualización automática está desactivada',
	'MCHAT_REFRESH_YES'				=> 'Actualización automática cada <strong>%d</strong> segundos',
	'MCHAT_RESPOND'					=> 'Responder al usuario',
	'MCHAT_RESET_QUESTION'			=> '¿Limpiar el área de entrada?',
	'MCHAT_SESSION_OUT'				=> 'La sesión de Chat ha expirado',
	'MCHAT_SHOW_LIST'				=> 'Mostrar Lista',
	'MCHAT_SECOND'					=> 'segundo',
	'MCHAT_SECONDS'					=> 'segundos',
	'MCHAT_SESSION_ENDS'			=> 'La sesión del Chat finaliza en',
	'MCHAT_SMILES'					=> 'Emoticonos',
	'MCHAT_TOTALMESSAGES'			=> 'Mensajes Totales: <strong>%s</strong>',
	'MCHAT_USESOUND'				=> '¿Usar sonido?',
	'MCHAT_ONLINE_USERS_TOTAL'		=> 'En total hay <strong>%d</strong> usuarios chateando',
	'MCHAT_ONLINE_USER_TOTAL'		=> 'En total hay <strong>%d</strong> usuario chateando',
	'MCHAT_NO_CHATTERS'				=> 'Nadie está charlando',
	'MCHAT_ONLINE_EXPLAIN'			=> 'basado en usuarios activos en los últimos %s',
	'WHO_IS_CHATTING'				=> 'Quién está chateando',
	'WHO_IS_REFRESH_EXPLAIN'		=> 'Se refresca cada <strong>%d</strong> segundos',
	'MCHAT_NEW_POST'				=> 'Realizar un nuevo tema',
	'MCHAT_NEW_REPLY'				=> 'Realizar una nueva respuesta',
	'MCHAT_NEW_QUOTE'				=> 'Responder citando',
	'MCHAT_NEW_EDIT'				=> 'Realizar una edición',

	// UCP
	'UCP_PROFILE_MCHAT'				=> 'Preferencias de mChat',
	'DISPLAY_MCHAT'					=> 'Mostrar mChat en el índice',
	'SOUND_MCHAT'					=> 'Habilitar sonido en mChat',
	'DISPLAY_STATS_INDEX'			=> 'Mostrar quién está chateando en el índice',
	'DISPLAY_NEW_TOPICS'			=> 'Mostrar nuevos temas en el chat',
	'DISPLAY_AVATARS'				=> 'Mostrar avatares en el chat',
	'CHAT_AREA'						=> 'Tipo de entrada',
	'CHAT_AREA_EXPLAIN'				=> 'Elija qué tipo de área va a utilizar para introducir en el chat:<br />Un área de texto o<br />un área de entrada',
	'INPUT_AREA'					=> 'Área de entrada (Input)',
	'TEXT_AREA'						=> 'Área de texto (Textarea)',
	'UCP_CAT_MCHAT'					=> 'mChat',
	'UCP_MCHAT_CONFIG'				=> 'mChat',

	// Preferences
	'LOG_MCHAT_TABLE_PRUNED'		=> 'La tabla de mChat ha sido purgada',
	'ACP_USER_MCHAT'				=> 'Ajustes de mChat',
	'LOG_DELETED_MCHAT'				=> '<strong>Mensaje de mChat borrado</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Mensaje de mChat editado</strong><br />» %1$s',
	'MCHAT_TOP_POSTERS'				=> 'Top Spammers',
	'MCHAT_NEW_CHAT'				=> '¡Nuevo mensaje de Chat!',
	'MCHAT_SEND_PM'					=> 'Enviar mensaje privado',

	// Custom edits
	'REPLY_WITH_LIKE'				=> 'Me Gusta este mensaje',
));
