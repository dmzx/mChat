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
	'MCHAT_IN'					=> 'em',
	'MCHAT_IN_SECTION'			=> 'seção',
	'MCHAT_LIKES'				=> 'Eu gosta desta mensagem',
	'MCHAT_ANNOUNCEMENT'		=> 'Anuncio',
	'MCHAT_ARCHIVE'				=> 'Arquivo',
	'MCHAT_ARCHIVE_PAGE'		=> 'Arquivo de Mini-Chat',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Purgar',
	'MCHAT_CLEANED'				=> 'Todas as mensagens foram apagados',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'BBCodes personalizados',
	'MCHAT_DELALLMESS'			=> 'Apagar todas as mensagens?',
	'MCHAT_DELCONFIRM'			=> 'Confirmar a eliminacão?',
	'MCHAT_DELITE'				=> 'Excluir',
	'MCHAT_EDIT'				=> 'Editar',
	'MCHAT_EDITINFO'			=> 'Editar a mensagem e clik em OK',
	'MCHAT_ENABLE'				=> 'Perdão, o Mini-Chat actualmente no está disponível',
	'MCHAT_ERROR'				=> 'Error',
	'MCHAT_FLOOD'				=> 'Você não pode enviar outra mensagem tão rapido, depois de enviar a última',
	'MCHAT_FOE'					=> 'Esta mensagem foi criada por <strong>%1$s</strong> que se encontra actualmente na sua lista de ignorados.',
	'MCHAT_HELP'				=> 'mChat Regras',
	'MCHAT_HIDE_LIST'			=> 'Ocultar lista',
	'MCHAT_HOUR'				=> 'hora ',
	'MCHAT_HOURS'				=> 'horas ',
	'MCHAT_IP'					=> 'IP whois para',
	'MCHAT_MINUTE'				=> 'minuto ',
	'MCHAT_MINUTES'				=> 'minutos ',
	'MCHAT_MESS_LONG'			=> 'Sua mensagem é muito longo.\nPor favor, o limite está em %s caracteres',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'A página personalizada de mChat não está activada neste momento!',
	'MCHAT_NOACCESS'			=> 'Nâo tem permissões para enviar mensagens no mChat',
	'MCHAT_NO_RULES'			=> 'A página de regras mChat não é ativado neste momento!',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Não tem permissões para ver o arquivo',
	'MCHAT_NOJAVASCRIPT'		=> 'O seu navegador não suporta JavaScript o JavaScript esta desactivado',
	'MCHAT_NOMESSAGE'			=> 'Não há mensagens',
	'MCHAT_NOMESSAGEINPUT'		=> 'Você deve digitar uma mensagem',
	'MCHAT_NOSMILE'				=> 'Nenhum emoticons encontrados',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat não esta instalado.	Por favor, avise o fundador do fórum.',
	'MCHAT_NOT_INSTALLED'		=> 'Faltam entradas na base de dados do mChat .<br />Por favor, corra o %sinstalador%s para criar mudanças de modificação na base de dados.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Pausado',
	'MCHAT_LOAD'				=> 'Cargando',
	'MCHAT_PERMISSIONS'			=> 'Alterar permissões de usuario',
	'MCHAT_REFRESHING'			=> 'Recarregar...',
	'MCHAT_REFRESH_NO'			=> 'Atualização automatica está desligada',
	'MCHAT_REFRESH_YES'			=> 'Atualizar a cada <strong>%d</strong> segundos',
	'MCHAT_RESPOND'				=> 'Responder ao usuario',
	'MCHAT_RESET_QUESTION'		=> 'Limpar a area de entrada?',
	'MCHAT_SESSION_OUT'			=> 'A sessão do Chat expirou',
	'MCHAT_SHOW_LIST'			=> 'Mostrar lista',
	'MCHAT_SECOND'				=> 'segundo ',
	'MCHAT_SECONDS'				=> 'segundos ',
	'MCHAT_SESSION_ENDS'		=> 'A sessão do Chat finaliza em',
	'MCHAT_SMILES'				=> 'Emoções',
	'MCHAT_TOTALMESSAGES'		=> 'Total mensagens: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Activar som',
	'MCHAT_ONLINE_USERS_TOTAL'	=> 'No total há <strong>%d</strong> usuarios conversando ',
	'MCHAT_ONLINE_USER_TOTAL'	=> 'No total há <strong>%d</strong> usuario conversando ',
	'MCHAT_NO_CHATTERS'			=> 'Ninguém conversando',
	'MCHAT_ONLINE_EXPLAIN'		=> '( baseada em usuários ativos nos últimos %s)',
	'WHO_IS_CHATTING'			=> 'Quem esta conversando',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Recarregar a cada <strong>%d</strong> segundos',
	'MCHAT_NEW_TOPIC'			=> 'Novo Tópico ',
	'MCHAT_NEW_REPLY'			=> 'Nova Resposta',
	'MCHAT_NEW_QUOTE'			=> 'Resposta Citando',
	'MCHAT_NEW_EDIT'			=> 'Editado',

	// UCP
	'UCP_PROFILE_MCHAT'		=> 'Preferencias do mChat',
	'DISPLAY_MCHAT' 		=> 'Mostrar mChat no índice',
	'SOUND_MCHAT'			=> 'Activar som no mChat',
	'DISPLAY_STATS_INDEX'	=> 'Mostrar estatísticas de quem esta conversando na página índice',
	'DISPLAY_NEW_TOPICS'	=> 'Mostrar novos topicos no Chat',
	'DISPLAY_AVATARS'		=> 'Mostrar avatars no Chat',
	'CHAT_AREA'				=> 'Tipo de entrada',
	'CHAT_AREA_EXPLAIN'		=> 'Escolher que tipo de área utilizada no bate-papo de entrada:<br />área de texto o<br />uma área de entrada (uma línha).',
	'INPUT_AREA'			=> 'Área de entrada (linha)',
	'TEXT_AREA'				=> 'Área de texto',
	'UCP_CAT_MCHAT'			=> 'mChat',
	'UCP_MCHAT_CONFIG'		=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'A tabela do mChat foi apagada',
	'ACP_USER_MCHAT'			=> 'Ajustes do mChat',
	'LOG_DELETED_MCHAT'				=> '<strong>Mensagem do mChat apagado</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Mensagem do mChat editado</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caracteres restantes: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> 'Nova mensagem no Chat!',
	'MCHAT_SEND_PM'			 	=> 'Enviar mensagem privado',
	'MCHAT_PM'						=> '(MP)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Eu gosto desta mensagem',

));