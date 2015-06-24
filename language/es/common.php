<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE!
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

// Adding the permissions
$lang = array_merge($lang, array(

	'MCHAT_TITLE'				=> 'Mini-Chat',
	'MCHAT_ADD'					=> 'Enviar',
	'MCHAT_IN'					=> 'en',
	'MCHAT_IN_SECTION'			=> 'sección',
	'MCHAT_LIKES'				=> 'Me gusta este mensaje',
	'MCHAT_ANNOUNCEMENT'		=> 'Anuncio',
	'MCHAT_ARCHIVE'				=> 'Archivo',
	'MCHAT_ARCHIVE_PAGE'		=> 'Archivo de Mini-Chat',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Purgar',
	'MCHAT_CLEANED'				=> 'Todos los mensajes han sido eliminados',
	'MCHAT_CLEAR_INPUT'			=> 'Limpiar',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'BBCodes personalizados',
	'MCHAT_DELALLMESS'			=> '¿Eliminar todos los mensajes?',
	'MCHAT_DELCONFIRM'			=> '¿Confirmar la eliminación?',
	'MCHAT_DELITE'				=> 'Borrar',
	'MCHAT_EDIT'				=> 'Editar',
	'MCHAT_EDITINFO'			=> 'Editar el mensaje y clic en OK',
	'MCHAT_ENABLE'				=> 'Perdón, el Mini-Chat actualmente no está disponible',
	'MCHAT_ERROR'				=> 'Error',
	'MCHAT_FLOOD'				=> 'No puede enviar otro mensaje tan pronto, después de enviar el último',
	'MCHAT_FOE'					=> 'Este mensaje ha sido creado por <strong>%1$s</strong> quien se encuentra actualmente en su lista de ignorados.',
	'MCHAT_HELP'				=> 'Normas',
	'MCHAT_HIDE_LIST'			=> 'Ocultar lista',
	'MCHAT_HOUR'				=> 'hora ',
	'MCHAT_HOURS'				=> 'horas ',
	'MCHAT_IP'					=> 'IP whois para %s',
	'MCHAT_MINUTE'				=> 'minuto ',
	'MCHAT_MINUTES'				=> 'minutos ',
	'MCHAT_MESS_LONG'			=> 'Su mensaje es demasiado largo.\nPor favor, el limite está en %s caracteres',
	'MCHAT_NO_CUSTOM_PAGE'		=> '¡La página personalizada de mChat no está activada en este momento!',
	'MCHAT_NOACCESS'			=> 'No tiene permisos para enviar mensajes al mChat',
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'No tiene permisos para ver el archivo',
	'MCHAT_NOJAVASCRIPT'		=> 'Su navegador no soporta JavaScript o JavaScript esta desactivado',
	'MCHAT_NOMESSAGE'			=> 'No hay mensajes',
	'MCHAT_NOMESSAGEINPUT'		=> 'Debe introducir un mensaje',
	'MCHAT_NOSMILE'				=> 'No se encontraron emoticonos',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat no esta instalado.	Por favor, avise al fundador del foro.',
	'MCHAT_NOT_INSTALLED'		=> 'Faltan entradas de mChat en la base de datos.<br />Por favor, ejecute el %sinstalador%s para crear los cambios de la modificación en la base de datos.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Pausado',
	'MCHAT_LOAD'				=> 'Cargando',
	'MCHAT_PERMISSIONS'			=> 'Cambiar permisos de usuario',
	'MCHAT_REFRESHING'			=> 'Refrescando...',
	'MCHAT_REFRESH_NO'			=> 'Actualización automatica está apagada',
	'MCHAT_REFRESH_YES'			=> 'Actualización cada <strong>%d</strong> segundos',
	'MCHAT_RESPOND'				=> 'Responder al usuario',
	'MCHAT_RESET_QUESTION'		=> '¿Vaciar el area de entrada?',
	'MCHAT_SESSION_OUT'			=> 'La sesión del Chat a finalizado',
	'MCHAT_SHOW_LIST'			=> 'Mostrar lista',
	'MCHAT_SECOND'				=> 'segundo ',
	'MCHAT_SECONDS'				=> 'segundos ',
	'MCHAT_SESSION_ENDS'		=> 'La sesión del Chat finaliza en',
	'MCHAT_SMILES'				=> 'Emoticonos',
	'MCHAT_TOTALMESSAGES'		=> 'Mensajes en total: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Habilitar sonido',
	'MCHAT_ONLINE_USERS_TOTAL'	=> 'En total hay <strong>%d</strong> usuarios chateando ',
	'MCHAT_ONLINE_USER_TOTAL'	=> 'En total hay <strong>%d</strong> usuario chateando ',
	'MCHAT_NO_CHATTERS'			=> 'No hay nadie chateando',
	'MCHAT_ONLINE_EXPLAIN'		=> '( basado en usuarios activos cada %s)',
	'WHO_IS_CHATTING'			=> 'Quien esta chateando',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Refrescando cada <strong>%d</strong> segundos',
	'MCHAT_NEW_TOPIC'			=> 'Nuevo Tema',
	'MCHAT_NEW_REPLY'			=> 'Nueva Respuesta',
	'MCHAT_NEW_QUOTE'			=> 'Respondió Citando',
	'MCHAT_NEW_EDIT'			=> 'Editado',

	// UCP
	'UCP_PROFILE_MCHAT'		=> 'Preferencias de mChat',
	'DISPLAY_MCHAT' 		=> 'Mostrar mChat en el índice',
	'SOUND_MCHAT'			=> 'Activar sonido en mChat',
	'DISPLAY_STATS_INDEX'	=> 'Mostrar estadisticas de quien esta chateando en la página índice',
	'DISPLAY_NEW_TOPICS'	=> 'Mostrar nuevos temas en el Chat',
	'DISPLAY_AVATARS'		=> 'Mostrar avatars en el Chat',
	'CHAT_AREA'				=> 'Tipo de entrada',
	'CHAT_AREA_EXPLAIN'		=> 'Elija que tipo de área usar en la entrada del Chat:<br />Un texto de área o<br />un área de entrada (una línea).',
	'INPUT_AREA'			=> 'Área de entrada (línea)',
	'TEXT_AREA'				=> 'Área de texto',
	'UCP_CAT_MCHAT'			=> 'mChat',
	'UCP_MCHAT_CONFIG'		=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'La tabla de mChat ha sido limpiada',
	'ACP_USER_MCHAT'			=> 'Ajustes de mChat',
	'LOG_DELETED_MCHAT'				=> '<strong>Mensaje de mChat borrado</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Mensaje de mChat editado</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caracteres restantes: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> '¡Nuevo mensaje en el Chat!',
	'MCHAT_SEND_PM'			 	=> 'Enviar mensaje privado',
	'MCHAT_PM'						=> '(MP)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Me gusta este mensaje',
));
