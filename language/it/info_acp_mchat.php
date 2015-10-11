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
	'ACP_MCHAT_CONFIG'				=> 'Configurazione',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Una mini chat per il tuo forum',
	'MCHAT_TABLE_DELETED'			=> 'Le tabelle della mChat sono state cancellate',
	'MCHAT_TABLE_CREATED'			=> 'Le tabelle della mChat sono state create',
	'MCHAT_TABLE_UPDATED'			=> 'Le tabelle della mChat sono state aggiornate',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Niente da fare... continua',
	'UCP_CAT_MCHAT'					=> 'Preferenze mChat',
	'UCP_MCHAT_CONFIG'				=> 'Preferenze utenti mChat',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regole',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Inserisci le regole della chat di questo forum. Ogni regola	deve stare in una nuova linea.<br />Limite di 255 caratteri.<br /><strong>Questo messaggio può essere tradotto.</strong> (è necessario modificare il file mchat_lang.php e leggere le istruzioni).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Aggiornamento Configurazioni mChat </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Configurazioni della mChat salvate',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versione in uso:',
	'MCHAT_ENABLE'					=> 'Abilita mChat',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Abilita o disabilita globalmente questa estensione.',
	'MCHAT_AVATARS'					=> 'Visualizza avatar',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Se impostato su sì, verranno visualizzati gli avatar ridimensionati degli utenti',
	'MCHAT_ON_INDEX'				=> 'mChat nell’indice',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Consentire la visualizzazione di mChat nell’indice.',
	'MCHAT_INDEX_HEIGHT'			=> 'Altezza mChat nell’indice',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Altezza della chat in pixel nell’indice del forum.<br /><em>limite da 50 a 1000</em>.',
	'MCHAT_LOCATION'				=> 'Posizione nel Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Scegliere la posizione di mChat nell’indice.',
	'MCHAT_TOP_OF_FORUM'			=> 'in alto nel forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'in basso nel Forum',
	'MCHAT_REFRESH'					=> 'Aggiorna',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Numero di secondi prima dell\'aggiornamento automatico della chat.<br /><em>Limite da 5 a 60 secondi</em>.',
	'MCHAT_PRUNE'					=> 'Abilita cancellazione automatica messaggi',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Impostare su sì per abilitare la funzione di cancellazione automatica dei messaggi.<br /><em>Si verifica solo se un utente visualizza le pagine personalizzate o l’archivio</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Numero messaggi cancellati automaticamente',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Numero di messaggi da mantenere in chat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Limite messaggi',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare nella chat.<br /><em>Limite da 10 a 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limite messaggi nell’indice',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare nel box della chat nell’indice<br /><em>Limite da 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limite Archivio',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare ogni pagina dell’Archivio.<br /> <em>Limite da 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Tempo',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Il numero di secondi che un utente deve attendere prima di inviare un altro messaggio in chat.<br /><em>Limite da	5 a 30, imposta 0 per disabilitare</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Lunghezza massima messaggi',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Il numero massimo di caratteri consentiti nei messaggi inviati.<br /><em>Limite da 100 a 500, imposta 0 per disabilitare</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Pagina personalizzata',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Consentire utilizzo della pagina personalizzata',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Altezza pagina personalizzata',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Altezza della chat in pixel della pagina personalizzata mChat.<br /><em>Limite da 50 a 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Formato Data',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'La sintassi usata è quella di PHP <a href="http://www.php.net/date">date()</a>',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Quella normale…',
	'MCHAT_WHOIS'					=> 'Dettagli',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Mostrare elenco utenti che sono in chat',
	'MCHAT_WHOIS_REFRESH'			=> 'Aggiornamento Dettagli',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Numero di secondi prima di aggiornare i dettagli.<br /><em>Limite da 30 a 300 secondi</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Disabilita BBcode',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Qui è possibile inserire i BBCodes che <strong>non</strong> sarà possobile usare nei messaggi.<br />Separare i BBcode con una barra verticale, ad esempio: <br />b|i|u|code|list|list=|flash|quote e/o a %snome bbcode personalizzati%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Messaggio fisso',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Qui è possibile definire un messaggio fisso da visualizzare agli utenti della chat.	È permesso usare codice html.<br />Lasciare vuoto per disattivare la visualizzazione.	Limite di 255 caratteri.<br /><strong>Questo messaggio può essere tradotto.</strong>	(modificando il file mchat_lang.php leggere le istruzioni).',
	'MCHAT_USER_TIMEOUT'			=> 'Timeout utente',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Impostare quanto tempo deve passare, in secondi, prima che finisca la sessione di un utente nella chat. Imposta su 0 per disabilitare questa funzione.<br /><em>Limite attuale %sdi tempo nel forum%s prima del termine delle sessioni: %s secondi</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Limite smile',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Impostare su sì per ignorare le impostazioni del limite di smile nella chat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Ignora limite minimo di caratteri',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Impostare su sì per ignorare i caratteri minimi dei messaggi della chat',
	'MCHAT_NEW_POSTS'				=> 'Abilita la visualizzazione dei nuovi Post',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Metti sì se vuoi visualizzare nella chat i nuovi Post del forum.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Visualizza nuovi Post e nuovi Topic',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Impostare su sì per consentire a mChat di pubblicare i nuovi Post e Topic del forum nella chat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Visualizza nuovi Post',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Impostata su sì per consentire la visualizzazione delle risposte ai Topic del forum nella chat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Visualizza i Post modificati',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Impostare su sì per consentire che i messaggi modificati siano pubblicati nella chat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Visualizza Post con citazione',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Impostare su Sì per consentire che i messaggi modificati siano pubblicati nella chat',
	'MCHAT_MAIN'					=> 'Configurazioni',
	'MCHAT_STATS'					=> 'Dettagli Chat',
	'MCHAT_STATS_INDEX'				=> 'Statistiche nell\'indice',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Mostra chi è attivo in chat nella sezione statistiche del forum',
	'MCHAT_MESSAGE_TOP'				=> 'Nuovi messaggi Sopra / Sotto',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Questa opzione metterà i nuovi messaggi Sopra o Sotto nella chat',
	'MCHAT_BOTTOM'					=> 'Sotto',
	'MCHAT_TOP'						=> 'Sopra',
	'MCHAT_MESSAGES'				=> 'Opzioni Messaggi',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pausa durante scrittura messaggi',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Se impostato sì, allora la chat non verrà aggiornata automaticamente mentre un utente inserisce un messaggio nella chat',

	// error reporting
	'TOO_LONG_DATE'		=> 'Il formato della data immessa è troppo lunga.',
	'TOO_SHORT_DATE'	=> 'Il formato della data immessa è troppo corta.',
	'TOO_SMALL_REFRESH'	=> 'Il valore di auto-aggiornamento è troppo piccolo.',
	'TOO_LARGE_REFRESH'	=> 'Il valore di auto-aggiornamento è troppo grande.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Il valore del limite di messaggi è troppo piccolo.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Il valore del limite di messaggi è troppo grande.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Il valore del limite dell\'archivio è troppo piccolo.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Il valore del limite dell\'archivio è troppo grande.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Il valore di tempo è troppo breve.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Il valore di tempo è troppo grande.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'Il valore massimo della lunghezza del messaggio è troppo piccolo.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'Il valore massimo della lunghezza del messaggio è troppo grande.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'Il valore della lunghezza massima delle parole è troppo piccolo.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'Il valore della lunghezza massima delle parole è troppo grande.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'Il valore di aggiornamento dei dettagli è troppo piccolo.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'Il valore di aggiornamento dei dettagli è troppo grande.',
	'TOO_SMALL_INDEX_HEIGHT'	=> 'Il valore di altezza della chat nell’indice è troppo piccolo.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'Il valore di altezza della chat nell’indice è troppo grande.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'Il valore di altezza nella pagina personalizzata è troppo piccolo.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'Il valore di altezza nella pagina personalizzata è troppo grande.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'Il messaggio fisso è troppo corto.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'Il messaggio fisso è troppo lungo.',
	'TOO_SMALL_TIMEOUT'	=> 'Il valore di timeout utente è troppo piccolo.',
	'TOO_LARGE_TIMEOUT'	=> 'Il valore di timeout utente è troppo grande.',

		// User perms
	'ACL_U_MCHAT_USE'			=> 'Può usare mchat',
	'ACL_U_MCHAT_VIEW'			=> 'Può vedere mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Può modificare i messaggi in mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Può cancellare i messaggi in mchat',
	'ACL_U_MCHAT_IP'			=> 'Può visualizzare indirizzi IP in mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Può ignorare limite flood in mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Può visualizzare l’Archivio di mchat',
	'ACL_U_MCHAT_BBCODE'		=> 'Può usare BBcode in mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Può usare smile in mChat',
	'ACL_U_MCHAT_URLS'			=> 'Può postare url in mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Può modificare impostazioni mChat',

));