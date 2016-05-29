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
	'MCHAT_ADD'						=> 'Enviar',
	'MCHAT_ARCHIVE'					=> 'Archivo',
	'MCHAT_ARCHIVE_PAGE'			=> 'Archivo de mChat',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CUSTOM_BBCODES'			=> 'BBCodes personalizados',
	'MCHAT_DELCONFIRM'				=> '¿Quiere confirmar el borrado?',
	'MCHAT_EDIT'					=> 'Editar',
	'MCHAT_EDITINFO'				=> 'Editar el mensaje y haga clic en OK',
	'MCHAT_NEW_CHAT'				=> '¡Nuevo mensaje de chat!',
	'MCHAT_SEND_PM'					=> 'Enviar mensaje privado',
	'MCHAT_LIKE'					=> 'Me gusta este mensaje',
	'MCHAT_LIKES'					=> 'Me gusta este mensaje',
	'MCHAT_FLOOD'					=> 'No puede enviar otro mensaje tan pronto después de su último mensaje',
	'MCHAT_FOE'						=> 'Este mensaje fue creado por <strong>%1$s</strong> que se encuentra actualmente en su lista de ignorados.',
	'MCHAT_RULES'					=> 'Normas',
	'MCHAT_WHOIS_USER'				=> 'IP whois de %1$s',
	'MCHAT_MESS_LONG'				=> 'Su mensaje es demasiado largo. Por favor, debe limitarlo a %1$d caracteres',
	'MCHAT_NO_CUSTOM_PAGE'			=> '¡La página personalizada de mChat no está habilitada en este momento!',
	'MCHAT_NO_RULES'				=> '¡Las normas de mChat no están habilitadas en este momento!',
	'MCHAT_NOACCESS'				=> 'Usted no tiene permiso para publicar en el mChat',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Usted no tiene permiso para ver el archivo',
	'MCHAT_NOJAVASCRIPT'			=> 'Su navegador no soporta JavaScript, o JavaScript está desactivado',
	'MCHAT_NOMESSAGE'				=> 'No hay mensajes',
	'MCHAT_NOMESSAGEINPUT'			=> 'No ha escrito ningún mensaje',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Pausado',
	'MCHAT_PERMISSIONS'				=> 'Cambiar permisos del usuario',
	'MCHAT_REFRESHING'				=> 'Refrescando…',
	'MCHAT_REFRESH_NO'				=> 'La actualización automática está desactivada',
	'MCHAT_REFRESH_YES'				=> 'Actualización automática cada <strong>%1$d</strong> segundos',
	'MCHAT_RESPOND'					=> 'Responder al usuario',
	'MCHAT_SESSION_ENDS'			=> 'La sesión de Chat finaliza en %1$s',
	'MCHAT_SESSION_OUT'				=> 'La sesión de Chat ha expirado',
	'MCHAT_SMILES'					=> 'Emoticonos',
	'MCHAT_TOTALMESSAGES'			=> 'Mensajes Totales: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Usar sonido',
	'MCHAT_COLLAPSE_TITLE'			=> 'Alternar la visibilidad de mChat',
	'MCHAT_WHO_IS_REFRESH_EXPLAIN'	=> 'Se refresca cada <strong>%1$d</strong> segundos',
	'MCHAT_MINUTES_AGO'				=> array(
		0 => 'justo ahora',
		1 => 'hace %1$d minuto',
		2 => 'hace %1$d minutos',
	),

	// These messages are formatted with JavaScript, hence {} and no $d
	'MCHAT_CHARACTER_COUNT'			=> '<strong>{current}</strong> caracteres',
	'MCHAT_CHARACTER_COUNT_LIMIT'	=> '<strong>{current}</strong> de {max} caracteres',
	'MCHAT_SESSION_ENDS_JS'			=> 'La sesión de Chat finaliza en {timeleft}',

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',
));
