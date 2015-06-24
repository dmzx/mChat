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
	'ACP_MCHAT_CONFIG'				=> 'Configuração',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Um mini chat (aka “Caja de texto”) para o teu forum',
	'MCHAT_TABLE_DELETED'			=> 'A tabela mChat foi excluído com sucesso',
	'MCHAT_TABLE_CREATED'			=> 'A tabela mChat foi criado com sucesso',
	'MCHAT_TABLE_UPDATED'			=> 'A tabela mChat foi atualizado com sucesso',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Nada que ver... Contunia',
	'UCP_CAT_MCHAT'					=> 'Preferencias de mChat',
	'UCP_MCHAT_CONFIG'				=> 'Preferencias de usuario de mChat',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regras',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Intruduzir as regras do forum aquí. Cada regra numa nova línha.<br />Está limitado a 255 caracteres.<br /><strong>Esta mensagem pode ser traduzida.</strong> (hay que editar el archivo mchat_lang.php y lea las instrucciones).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Atualizar configurações de mChat</strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Configuração Mini Chat foi atualizado',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versión:',
	'MCHAT_ENABLE'					=> 'Activar mChat MOD',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Activar o desactivar o mod a nivel global.',
	'MCHAT_AVATARS'					=> 'Mostrar avatars',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Se marcar como sim, os avatars serão mostrados em modo pequeno',
	'MCHAT_ON_INDEX'				=> 'mChat no Index',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Permitir a exibição do mChat na página de índice.',
	'MCHAT_INDEX_HEIGHT'			=> 'Altura da página índice',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'A altura da caixa de bate-papo em pixels na página de índice do fórum.<br /><em>Está limitado de 50 a 1000</em>.',
	'MCHAT_LOCATION'				=> 'Localização no Fórum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Escolha o local do mChat na página de índice.',
	'MCHAT_TOP_OF_FORUM'			=> 'Top do Forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Parte inferior do Forum',
	'MCHAT_REFRESH'					=> 'Recarregar',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Número de segundos antes do chat se actualize automáticamente. <strong>Você está limitado a partir de 5 a 60 segundos</strong>.',
	'MCHAT_PRUNE'					=> 'Activar purga',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Defina como sim para permitir la função purgar.<br /><em>Só ocorre se o usuário visualiza as páginas personalizadas ou arquivo</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Numero de purga',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'O número de mensagens de reter no chat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Limite de mensagens',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'O número máximo de mensagens para mostrar na área de bate-papo.<br /><em>Recomendado de 10 a 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limite de mensagens página Index',
	'MCHAT_MESSAGE_NUM_EXPLAIN'		=> 'O número máximo de mensagens para mostrar na área de bate-papo na página de índice.<br /><em>Recomendado de 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limite de Archivo',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'O número máximo de mensagens para mostrar por página na página de arquivo.<br /> <em>Recomendado de 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Tiempo límite',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'O número de segundos que um usuário deve esperar antes de postar outra mensagem no chat.<br /><em>Recomendado de 5 a 30, establecer em 0 para desabilitar</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Maximo comprimento da mensagem',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Número máximo de caracteres permitidos por mensagem enviada.<br /><em>Recomendado de 100 a 500, establece em 0 para desabilitar</em>.',
	'MCHAT_CUSTOM_PAGE'				 => 'Página personalizada',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'				=> 'Permitir o uso de de página personalizada.',
	'MCHAT_CUSTOM_HEIGHT'					=> 'Altura da página personalizada',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'			=> 'A altura da mini- chat, em pixels, da página personalizada mChat.<br /><em>Está limitado de 50 a 1000</em>.',
	'MCHAT_DATE_FORMAT'						=> 'Formato da data',
	'MCHAT_DATE_FORMAT_EXPLAIN'				=> 'A sintaxe utilizada é idêntica à do PHP <a href="http://www.php.net/date">date()</a>.',
	'MCHAT_CUSTOM_DATEFORMAT'				=> 'Personalizar...',
	'MCHAT_WHOIS'							=> 'Quem É',
	'MCHAT_WHOIS_EXPLAIN'					=> 'Permitir a visualização de usuários que estão conversando.',
	'MCHAT_WHOIS_REFRESH'					=> 'Actualizar Quem É',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'			=> 'Número de segundos antes de actualizar a estatísticas Quem É.<br /><strong>Esta limitado de 30 a 300 segundos</strong>.',
	'MCHAT_BBCODES_DISALLOWED'				=> 'Desabilitar BBCodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'		=> 'Aqui você pode inserir os bbcodes que	<strong>não</strong> se vão utilizar na mensagem.<br />Separar BBcodes com uma barra vertical, por ejemplo: <br />b|i|u|code|list|list=|flash|quote and/or a %scustom bbcode tag name%s',
	'MCHAT_STATIC_MESSAGE'					=> 'Mensagem estática',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'			=> 'Aquí pode definir uma mensagem estatica que se mostrara aos usuarios do chat. Código HTML é permitido<br />Coloque nada para desligar essa visualização.	Está limitado a 255 caracteres.<br /><strong>Esta mensagem pode ser traduzida.</strong>	(só precisa editar o arquivo mchat_lang.phpe leia as instruções).',
	'MCHAT_USER_TIMEOUT'					=> 'Timeout do usuario',
	'MCHAT_USER_TIMEOUT_EXPLAIN'			=> 'Defina a quantidade de tempo, em segundos , até que, uma sessão de usuários termina no chat. Defina como 0 para nenhum tempo limite.<br /><em>Está limitado a %s Ajustes de configuración da sessões do forum%s que actualmente está en %s segundos</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Substituir limite de emocões',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Por em Sim, para sustituir o ajuste do limite de emoções do fórum para as mensagem do chat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	 	=> 'Sustituir límite de caracteres minimos',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Por em Sim, para sustituir os ajustes de caracteres minimos do forum, nas mensagem do chat',
	'MCHAT_NEW_POSTS'						=> 'Ativar exibir mensagens',
	'MCHAT_NEW_POSTS_EXPLAIN'				=> 'Por Sim, para permitir novas mensagens do forum na area de mensagens do chat.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Exibir novas mensagens e topicos ',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Por Sim, para permitir novas mensagens do Topico do Fórum na area de mensagens do chat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Exibir novas mensagens respondidas',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Por sim, para permitir novas mensagens respondidas do forum na area de mensagens do chat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'exibir mensagens editadas',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Por sim, para permitir mensagens editadas do forum na area de mensagens do chat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Mostrar mensagens citados',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Por sim, para permitir mensagens citados do forum na area de mensagens do chat.',
	'MCHAT_MAIN'					=> 'Configuracão principal',
	'MCHAT_STATS'					=> 'Quem esta conversando',
	'MCHAT_STATS_INDEX'				=> 'Estatísticas no Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Mostre quem está conversando com na seção de estatísticas do fórum',
	'MCHAT_MESSAGE_TOP'				=> 'Mantenha a mensagem na parte inferior/superior',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Este publicar a mensagem na parte inferior ou superior da area de mensagens do chat.',
	'MCHAT_BOTTOM'					=> 'Abaixo',
	'MCHAT_TOP'						=> 'Top',
	'MCHAT_MESSAGES'				=> 'Ajustes da mensagem',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pausa de entrada',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Se colocar Sim, o Chat nao se actualizara automaticamente, mediante um utilizador introduza uma mensagem na área de entrada',

	// error reporting
	'TOO_LONG_DATE'					=> 'O formato da data que você inseriu é muito longa.',
	'TOO_SHORT_DATE'				=> 'O formato da data que você inseriu é muito curto.',
	'TOO_SMALL_REFRESH'				=> 'O valor de atualização é muito pequeno.',
	'TOO_LARGE_REFRESH'				=> 'O valor de atualização é muito grande.',
	'TOO_SMALL_MESSAGE_LIMIT'		=> 'O valor limite de mensagem é muito pequeno.',
	'TOO_LARGE_MESSAGE_LIMIT'		=> 'O valor limite de mensagem é muito longo.',
	'TOO_SMALL_ARCHIVE_LIMIT'		=> 'O valor limite do arquivo é muito curto.',
	'TOO_LARGE_ARCHIVE_LIMIT'		=> 'O valor limite do arquivo é muito longo.',
	'TOO_SMALL_FLOOD_TIME'			=> 'O valor do tempo limite é muito curto.',
	'TOO_LARGE_FLOOD_TIME'			=> 'O valor do tempo limite é muito longo.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'O valor do máximo da mensagem é muito pequeno.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'O valor do máximo da mensagem é muito longo.',
	'TOO_SMALL_MAX_WORDS_LNGTH'		=> 'O valor máximo de palavras é muito pequeno.',
	'TOO_LARGE_MAX_WORDS_LNGTH' 	=> 'O valor máximo de palavras é muito grande.',
	'TOO_SMALL_WHOIS_REFRESH'		=> 'O valor de refresco de whois é demasiado corto.',
	'TOO_LARGE_WHOIS_REFRESH'		=> 'O valor de refresco de whois é demasiado largo.',
	'TOO_SMALL_INDEX_HEIGHT'		=> 'O valor da altura do índice é demasiado curto.',
	'TOO_LARGE_INDEX_HEIGHT'		=> 'O valor da altura do índice é demasiado largo.',
	'TOO_SMALL_CUSTOM_HEIGHT'		=> 'O valor da altura personalizada é demasiado curto.',
	'TOO_LARGE_CUSTOM_HEIGHT'		=> 'O valor da altura personalizada é demasiado largo.',
	'TOO_SHORT_STATIC_MESSAGE'		=> 'O valor da mensagem estatico é demasiado curto.',
	'TOO_LONG_STATIC_MESSAGE'		=> 'O valor da mensagem estatico é demasiado largo.',
	'TOO_SMALL_TIMEOUT'		 	=> 'O valor de tempo de espera do usuario é demasiado curto.',
	'TOO_LARGE_TIMEOUT'				=> 'O valor de tempo de espera do usuario é demasiado largo.',

		// User perms
	'ACL_U_MCHAT_USE'			=> 'Pode usar mChat',
	'ACL_U_MCHAT_VIEW'			=> 'Pode ver mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Pode editar mensagens no mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Pode apagar mensagens no mChat',
	'ACL_U_MCHAT_IP'			=> 'Pode ver Endereço IP no mChat',
	'ACL_U_MCHAT_PM'			=> 'Pode usar mensagens privadas no mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Pode usar, Eu gosto da mensagem no mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Pode citar mensagens no mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Pode ignorar tiempo limite de mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Pode ver o Archivo do mChat',
	'ACL_U_MCHAT_BBCODE'		=> 'Pode usar BBCodes no mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Pode usar emocões no mChat',
	'ACL_U_MCHAT_URLS'			=> 'Pode colocár URLs no mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Pode gerir os ajustes do mChat',

));