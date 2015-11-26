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
	'ACP_MCHAT_TITLE'				=> 'mChat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Um mini chat para seu fórum',
	'MCHAT_TABLE_DELETED'			=> 'A tabela do mChat foi excluída com sucesso',
	'MCHAT_TABLE_CREATED'			=> 'A tabela do mChat foi criada com sucesso',
	'MCHAT_TABLE_UPDATED'			=> 'A tabela do mChat foi atualizada com sucesso',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Nada a atualizar... Continuando',
	'UCP_CAT_MCHAT'					=> 'Preferêncas do mChat',
	'UCP_MCHAT_CONFIG'				=> 'Preferêncas do usuário mChat',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regras do mChat',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Digite as regras do mChat aqui. Cada regra em uma linha.<br /><em>Limitado a 255 characters.</em><br /><strong>Esta mensagem pode ser traduzida.</strong> (edite o arquivo mchat_lang.php e leia as instruções).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Configurações atualizadas</strong>',
	'MCHAT_CONFIG_SAVED'			=> 'As configurações foram atualizadas',
	'MCHAT_TITLE'					=> 'mChat',
	'MCHAT_VERSION'					=> 'Versão:',
	'MCHAT_ENABLE'					=> 'Ativar o mChat',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Ativa ou desativa o mChat completamente.',
	'MCHAT_AVATARS'					=> 'Mostrar avatares',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Se SIM, mostra miniaturas dos avatares.',
	'MCHAT_ON_INDEX'				=> 'Mostrar mChat no índice',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Se SIM, mostra o mChat no índice.',
	'MCHAT_INDEX_HEIGHT'			=> 'Altura do mChat no índice',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Define a altura em pixels do mChat no índice.<br /><em>Limitado entre 50 e 1000</em>.',
	'MCHAT_LOCATION'				=> 'Localização no fórum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Defina a localização do mChat no índice.',
	'MCHAT_TOP_OF_FORUM'			=> 'Em cima',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Embaixo',
	'MCHAT_REFRESH'					=> 'Tempo de atualização',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Número de segundos antes de atualizar automaticamente.<br /><em>Limitado entre 5 e 60 segundos</em>.',
	'MCHAT_PRUNE'					=> 'Habilitar a limpeza',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Se SIM, habilita o recurso de limpeza.<br /><em>Somente ocorre se o usuário visualiza a página personalizada ou o histórico</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Quantidade a manter',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Define a quantidade de mensagens a manter no mChat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Limite de mensagens',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Define a quantidade máxima de mensagens a mostrar no mChat.<br /><em>Recomendado de 10 a 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limite de mensagens no índice',
	'MCHAT_MESSAGE_NUM_EXPLAIN'		=> 'Define a quantidade máxima de mensagens a mostrar no índice.<br /><em>Recomendado de 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limite do histórico',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Define o número máximo de mensagens por página a mostrar no histórico.<br /> <em>Recomendado de 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Tempo entre postagens',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Define quantos segundos o usuário deve esperar entre uma nova mensagem e a última.<br /><em>Recomendado de 5 a 30, 0 para desabilitar.</em>',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Tamanho máximo da mensagem',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Define a quantidade máxima de caracteres por mensagem.<br /><em>Recomendado de 100 a 500, 0 para desabilitar.</em>',
	'MCHAT_CUSTOM_PAGE'				=> 'Página personalizada',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Permite o uso de uma página personalizada.',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Altura do mChat na página personalizada',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Define a altura em pixels do mChat na página personalizada.<br /><em>Limitado entre 50 e 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Formato da data',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'A sintaxe é a mesma da função <a href="http://www.php.net/date">date()</a> do PHP.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Personalizar formato da data',
	'MCHAT_WHOIS'					=> 'Mostrar Quem está conversando',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Mostra Quem está conversando.',
	'MCHAT_WHOIS_REFRESH'			=> 'Atualiza Quem está conversando',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Define o número de segundos entre as atualizações de Quem está conversando.<br /><em>Limitado entre 30 e 300 segundos.</em>',
	'MCHAT_BBCODES_DISALLOWED'		=> 'BBCodes desabilitados',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Coloque aqui os BBCodes que <strong>NÃO</strong> estarão disponíveis para uso nas mensagens.<br />Separe os BBCodes com uma barra vertical, por exemplo: <br />b|i|u|code|list|list=|flash|quote',
	'MCHAT_STATIC_MESSAGE'			=> 'Anúncio',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Define uma mensagem a ser mostrada em destaque no mChat.<br />Códigos HTML são permitidos. Deixe em branco para desabilitar.<br /><em>Limitado a 255 characters.</em><br /><strong>Esta mensagem pode ser traduzida.</strong> (edite o arquivo mchat_lang.php e leia as instruções).',
	'MCHAT_USER_TIMEOUT'			=> 'Timeout do usuário',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Define a quantidade de segundos	até a sessão do usuário expirar, 0 para desabilitar.<br /><em>Limitado à <u>%sconfiguração de sessões do fórum%s</u> a qual atualmente é de %s segundos.</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Ignorar limite de smilies',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Se SIM, ignora o limite máximo de smilies definido para o fórum.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'			=> 'Ignorar limite mínimo de caracteres',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Se SIM, ignora o limite mínimo de caracteres definido para o fórum.',
	'MCHAT_NEW_POSTS'				=> 'Habilitar o recurso de exibir as mensagens do fórum',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Se SIM, mostra tópicos e mensagens diretamente no mChat.',
	'MCHAT_NEW_POSTS_TOPIC'			=> 'Mostrar novos tópicos e mensagens',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'	=> 'Se SIM, mostra novos tópicos e mensagens diretamente no mChat.',
	'MCHAT_NEW_POSTS_REPLY'			=> 'Mostrar novas respostas',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'	=> 'Se SIM, mostra novas respostas diretamente no mChat.',
	'MCHAT_NEW_POSTS_EDIT'			=> 'Mostrar mensagens editadas',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'	=> 'Se SIM, mostra mensagens editadas diretamente no mChat.',
	'MCHAT_NEW_POSTS_QUOTE'			=> 'Mostrar mensagens com citação',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'	=> 'Se SIM, mostra mensagens com citação diretamente no mChat.',
	'MCHAT_MAIN'					=> 'Configuração principal',
	'MCHAT_STATS'					=> 'Quem está conversando',
	'MCHAT_STATS_INDEX'				=> 'Estatísticas no índice',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Mostra "Quem está conversando" nas estatísticas do índice.',
	'MCHAT_MESSAGE_TOP'				=> 'Posição das novas mensagens',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Define se novas mensagens aparecerão na parte de baixo ou de cima no mChat.',
	'MCHAT_BOTTOM'					=> 'Embaixo',
	'MCHAT_TOP'						=> 'Em cima',
	'MCHAT_MESSAGES'				=> 'Configurações das mensagens',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pausar durante a digitação',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Se SIM, o mChat não atualiza durante a digitação de uma mensagem.',

	// error reporting
	'TOO_LONG_DATE'					=> 'O formato da data é muito grande.',
	'TOO_SHORT_DATE'				=> 'O formato da data é muito pequeno.',
	'TOO_SMALL_REFRESH'				=> 'O valor da atualização é muito pequeno.',
	'TOO_LARGE_REFRESH'				=> 'O valor da atualização é muito grande.',
	'TOO_SMALL_MESSAGE_LIMIT'		=> 'As mensagens máximas são muito pequenas.',
	'TOO_LARGE_MESSAGE_LIMIT'		=> 'As mensagens máximas são muito grandes.',
	'TOO_SMALL_ARCHIVE_LIMIT'		=> 'O histórico é muito pequeno.',
	'TOO_LARGE_ARCHIVE_LIMIT'		=> 'O histórico é muito grande.',
	'TOO_SMALL_FLOOD_TIME'			=> 'O tempo entre postagens é muito pequeno.',
	'TOO_LARGE_FLOOD_TIME'			=> 'O tempo entre postagens é muito grande.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'O tamanho das mensagens é muito pequeno.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'O tamanho das mensagens é muito grande.',
	'TOO_SMALL_MAX_WORDS_LNGTH'		=> 'A quantidade máxima de caracteres é muito pequena.',
	'TOO_LARGE_MAX_WORDS_LNGTH'		=> 'A quantidade máxima de caracteres é muito grande.',
	'TOO_SMALL_WHOIS_REFRESH'		=> 'A atualização de Quem está conversando é muito pequena.',
	'TOO_LARGE_WHOIS_REFRESH'		=> 'A atualização de Quem está conversando é muito grande.',
	'TOO_SMALL_INDEX_HEIGHT'		=> 'A altura máxima no índice é muito pequena.',
	'TOO_LARGE_INDEX_HEIGHT'		=> 'A altura máxima no índice é muito grande.',
	'TOO_SMALL_CUSTOM_HEIGHT'		=> 'A altura máxima personalizada é muito pequena.',
	'TOO_LARGE_CUSTOM_HEIGHT'		=> 'A altura máxima personalizada é muito grande.',
	'TOO_SHORT_STATIC_MESSAGE'		=> 'O anúncio é muito pequeno.',
	'TOO_LONG_STATIC_MESSAGE'		=> 'O anúncio é muito grande.',
	'TOO_SMALL_TIMEOUT'				=> 'O timeout é muito pequeno.',
	'TOO_LARGE_TIMEOUT'				=> 'O timeout é muito grande.',

	// User perms
	'ACL_U_MCHAT_USE'			=> 'Pode usar o mChat',
	'ACL_U_MCHAT_VIEW'			=> 'Pode ver o mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Pode editar mensagens no mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Pode deletar mensagens no mChat',
	'ACL_U_MCHAT_IP'			=> 'Pode ver endereços IP no mChat',
	'ACL_U_MCHAT_PM'			=> 'Pode usar MPs no mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Pode usar o "Gostei da mensagem" no mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Pode citar no mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Pode ignorar tempo de fllod no mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Pode ver o histórico do mChat',
	'ACL_U_MCHAT_BBCODE'		=> 'Pode usar BBCodes no mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Pode usar smilies no mChat',
	'ACL_U_MCHAT_URLS'			=> 'Pode postar URLs no mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Pode gerenciar as configurações do mChat',

));