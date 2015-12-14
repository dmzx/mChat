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

	'MCHAT_TITLE'				=> 'Chat',
	'MCHAT_ADD'					=> 'Enviar',
	'MCHAT_IN'					=> 'na seção',
	'MCHAT_IN_SECTION'			=> ' ',
	'MCHAT_LIKES'				=> 'Gostei desta mensagem',
	'MCHAT_ANNOUNCEMENT'		=> 'Anúncio',
	'MCHAT_ARCHIVE'				=> 'Histórico',
	'MCHAT_ARCHIVE_PAGE'		=> 'Histórico do mChat',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Limpeza',
	'MCHAT_CLEANED'				=> 'Todas as mensagens foram removidas',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'BBCodes personalizados',
	'MCHAT_DELALLMESS'			=> 'Remover todas as mensagens?',
	'MCHAT_DELCONFIRM'			=> 'Confirma a exclusão?',
	'MCHAT_DELITE'				=> 'Excluir',
	'MCHAT_EDIT'				=> 'Editar',
	'MCHAT_EDITINFO'			=> 'Edite a mensagem e clique OK',
	'MCHAT_ENABLE'				=> 'Desculpe, o mChat está indisponível no momento',
	'MCHAT_ERROR'				=> 'Erro',
	'MCHAT_FLOOD'				=> 'Você não pode postar uma mensagem logo após postar a última',
	'MCHAT_FOE'					=> 'Esta mensagem foi feita por <strong>%1$s</strong> o qual está atualmente na sua lista de ignorados.',
	'MCHAT_HELP'				=> 'Regras do mChat',
	'MCHAT_HIDE_LIST'			=> 'Lista de ignorados',
	'MCHAT_HOUR'				=> 'hora ',
	'MCHAT_HOURS'				=> 'horas',
	'MCHAT_IP'					=> 'Whois para',
	'MCHAT_MINUTE'				=> 'minuto ',
	'MCHAT_MINUTES'				=> 'minutos ',
	'MCHAT_MESS_LONG'			=> 'Sua mensagem é muito grande.\nO limite é de %s caracteres',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'A página personalizada do mChat não está ativada neste momento!',
	'MCHAT_NO_RULES'			=> 'A página de regras do mChat não está ativa neste momento!',
	'MCHAT_NOACCESS'			=> 'Você não tem permissão para postar no mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Você não tem permissão para ver o histórico',
	'MCHAT_NOJAVASCRIPT'		=> 'Seu browser não suporta JavaScript ou está desabilitado',
	'MCHAT_NOMESSAGE'			=> 'Não há mensagens',
	'MCHAT_NOMESSAGEINPUT'		=> 'Você não digitou uma mensagem',
	'MCHAT_NOSMILE'				=> 'Smilies não encontrados',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat não está instalado. Por favor avise um moderador.',
	'MCHAT_NOT_INSTALLED'		=> 'Estão faltando entradas no banco de dados.<br />Rode o %sinstalador%s para corrigir isso.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Pausado',
	'MCHAT_LOAD'				=> 'Carregando',
	'MCHAT_PERMISSIONS'			=> 'Altera as permissões do usuário',
	'MCHAT_REFRESHING'			=> 'Atualizando...',
	'MCHAT_REFRESH_NO'			=> 'Atualização automática está desligada',
	'MCHAT_REFRESH_YES'			=> 'Atualização automática a cada <strong>%d</strong> segundos',
	'MCHAT_RESPOND'				=> 'Responder ao usuário',
	'MCHAT_RESET_QUESTION'		=> 'Limpar a área de digitação?',
	'MCHAT_SESSION_OUT'			=> 'A sessão do mChat expirou',
	'MCHAT_SHOW_LIST'			=> 'Mostra Lista',
	'MCHAT_SECOND'				=> 'segundo ',
	'MCHAT_SECONDS'				=> 'segundos ',
	'MCHAT_SESSION_ENDS'		=> 'A sessão do mChat termina em',
	'MCHAT_SMILES'				=> 'Smilies',
	'MCHAT_TOTALMESSAGES'		=> 'Total de mensagens: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Ativar som:',
	'MCHAT_ONLINE_USERS_TOTAL'	=> 'No total há <strong>%d</strong> usuários conversando',
	'MCHAT_ONLINE_USER_TOTAL'	=> 'No total há <strong>%d</strong> usuário conversando',
	'MCHAT_NO_CHATTERS'			=> 'Ninguém conversando',
	'MCHAT_ONLINE_EXPLAIN'		=> 'baseado em usuários ativos em %s',
	'WHO_IS_CHATTING'			=> 'Quem está conversando',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Atualiza a cada <strong>%d</strong> segundos',
	'MCHAT_NEW_TOPIC'			=> 'Criou',
	'MCHAT_NEW_REPLY'			=> 'Respondeu',
	'MCHAT_NEW_QUOTE'			=> 'Respondeu citando',
	'MCHAT_NEW_EDIT'			=> 'Editou',

	// UCP
	'UCP_PROFILE_MCHAT'		=> 'Preferências do mChat',
	'DISPLAY_MCHAT'			=> 'Mostrar mChat no índice',
	'SOUND_MCHAT'			=> 'Ativar som no mChat',
	'DISPLAY_STATS_INDEX'	=> 'Mostrar "Quem está Conversando" no índice',
	'DISPLAY_NEW_TOPICS'	=> 'Mostrar novos tópicos e mensagens no mChat',
	'DISPLAY_AVATARS'		=> 'Mostrar avatares no mChat',
	'CHAT_AREA'				=> 'Tipo de entrada',
	'CHAT_AREA_EXPLAIN'		=> 'Escolhe como digitar no mChat:<br />Área de texto ou<br />Área de digitação',
	'INPUT_AREA'			=> 'Área de digitação',
	'TEXT_AREA'				=> 'Área de texto',
	'UCP_CAT_MCHAT'			=> 'mChat',
	'UCP_MCHAT_CONFIG'		=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'		=> 'Tabela mChat foi limpa',
	'ACP_USER_MCHAT'				=> 'Configurações do mChat',
	'LOG_DELETED_MCHAT'				=> '<strong>Mensagem do mChat deletada</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Mensagem do mChat editada</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caracteres restantes: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'				=> 'Top usuários',
	'MCHAT_NEW_CHAT'				=> 'Nova mensagem no mChat!',
	'MCHAT_SEND_PM'				 	=> 'Enviar mensagem privada',
	'MCHAT_PM'						=> '(PM)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Gostei desta mensagem',
));
