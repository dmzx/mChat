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
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'la mini chat (aka “shout box”) per il tuo forum',
	'MCHAT_TABLE_DELETED'			=> 'Le tabelle mChat sono state cancellate',
	'MCHAT_TABLE_CREATED'			=> 'Le tabelle mChat sono state create',
	'MCHAT_TABLE_UPDATED'			=> 'Le tabelle mChat sono state aggiornate',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Niente da fare .... continua',
	'UCP_CAT_MCHAT'					=> 'mChat Preferenze',
	'UCP_MCHAT_CONFIG'				=> 'Utente mChat Preferenze',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regole',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Inserisci le regole per questo forum.	Ogni regola su una nuova linea.<br />Limite a 255 caratteri.<br /><strong>Questo messaggio può essere tradotto.</strong> (è necessario modificare il file mchat_lang.php e leggere le istruzioni).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Aggiornamento Configurazioni mChat </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini Chat configurazioni salvate',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versione:',
	'MCHAT_ENABLE'					=> 'Abilita mChat Estensione',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Abilita o disabilita questa estensione globalmente.',
	'MCHAT_AVATARS'					=> 'Visualizza avatar',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Se impostato su Sì, verranno visualizzati gli avatar degli utenti ridimensionate',
	'MCHAT_ON_INDEX'				=> 'mChat in indice',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Consentire la visualizzazione di mChat nella pagina indice.',
	'MCHAT_INDEX_HEIGHT'			=> 'Indice Pagina Altezza',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Altezza della casella di chat in pixel nella pagina indice del forum.<br /><em>limite da 50 a 1000</em>.',
	'MCHAT_LOCATION'				=> 'Posizione nel Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Scegliere la posizione di mChat nella pagina indice.',
	'MCHAT_TOP_OF_FORUM'			=> 'in alto al Forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Sotto al Forum',
	'MCHAT_REFRESH'					=> 'Aggiorna',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Numero di secondi prima di un aggiornamento automatico.<br /><em>Limite da 5 a 60 secondi</em>.',
	'MCHAT_PRUNE'					=> 'Abilita cancellazione automatica',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Impostare su SI per abilitare la funzione di cancellazione automatica.<br /><em>Si verifica solo se un utente visualizza le pagine personalizzate o di archivio</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Numero cancellazione automatica',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Il numero di messaggi da mantenere in chat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Messaggi limite',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare in chat.<br /><em>Recommandato da 10 a 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limite messaggio di pagina Indice',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare in area di chat sulla pagina indice.<br /><em>Recommandato da 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Archivio limite',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare per pagina nella pagina di archivio.<br /> <em>Recommandato da 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Tempo',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Il numero di secondi che un utente deve attendere prima di inviare un altro messaggio in chat.<br /><em>Recommandato da	5 a 30, imposta 0 per disabilitare</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Lunghezza massima messaggi',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Il numero massimo di caratteri consentiti per messaggio inviato.<br /><em>Recommandato da 100 a 500, imposta 0 per disabilitare</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Pagina personalizzata',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Consentire utilizzo della pagina personalizzata',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Altezza pagina personalizzata',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Altezza della casella di chat in pixel della pagina mChat separata.<br /><em>Limite da 50 a 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Formato Data',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'La sintassi usata è identica al PHP <a href="http://www.php.net/date">date()</a>',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Uso…',
	'MCHAT_WHOIS'					=> 'Whois',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Lasciare un display di utenti che sono in chat',
	'MCHAT_WHOIS_REFRESH'			=> 'Aggiornamento Whois',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Numero di secondi prima di aggiornare il whois.<br /><em>Limite da 30 a 300 secondi</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Disabilita bbcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Qui è possibile inserire i BBCodes che <strong>not</strong> saranno usati nei messaggi.<br />Separare i bbcodes con una barra verticale, ad esempio: <br />b|i|u|code|list|list=|flash|quote e/o a %scustom bbcode tag name%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Messaggi Statici',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Qui è possibile definire un messaggio statico da visualizzare agli utenti della chat.	HTML codice è permesso.<br />Svuotare per disattivare la visualizzazione.	Limite di 255 caratteri.<br /><strong>Questo messaggio può essere tradotto.</strong>	(modificando il file mchat_lang.php leggere le istruzioni).',
	'MCHAT_USER_TIMEOUT'			=> 'Timeout utente',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Impostare la quantità di tempo, in secondi, fino una sessione utenti nella chat termina. Impostare a 0 per nessun timeout.<br /><em>Limite di %sforum config impostazioni a sessions%s che è attualmente impostato %s secondi</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Limite smile',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Impostare su Si per ignorare le smile impostazione messaggi di limite in chat',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Ignora limite minimo caratteri',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Impostare su SI per ignorare i caratteri minimi impostazione per i messaggi di chat',
	'MCHAT_NEW_POSTS'				=> 'Abilita Post Display',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Setta si se vuoi visualizzare in chat i messaggi di post nel forum.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Visualizza nuovi post e topic',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Impostare su si per consentire i nuovi post-argomento del forum per essere pubblicati in area messaggio della chat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Visualizza nuove risposte',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Impostata su Sì per consentire la visualizzazione delle risposte ai messaggi nel forum in area messaggio della chat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Visualizza post modificati',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Impostare su si per consentire ai messaggi modificati del forum di essere pubblicati in area messaggio della chat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Visualizza post quotati',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Impostare su Sì per consentire ai messaggi citati del forum di esser pubblicati in area messaggio della chat.',
	'MCHAT_MAIN'					=> 'Configurazione principale',
	'MCHAT_STATS'					=> 'Chat Whois',
	'MCHAT_STATS_INDEX'				=> 'Statistiche Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Mostra chi sta chattando nella sezione statistiche del forum',
	'MCHAT_MESSAGE_TOP'				=> 'Keep message on Bottom / Top',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'This will post the message bottom or top in the chat message area.',
	'MCHAT_BOTTOM'					=> 'Bottom',
	'MCHAT_TOP'						=> 'Top',
	'MCHAT_MESSAGES'				=> 'Opzioni Messaggi',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pausa in ingresso',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Se impostato Sì, allora la chat non verrà aggiornata automaticamente se un utente inserisce un messaggio in area di immissione',

	// error reporting
	'TOO_LONG_DATE'		=> 'Il formato della data immessa è troppo lunga.',
	'TOO_SHORT_DATE'	=> 'Il formato della data immessa è troppo corta.',
	'TOO_SMALL_REFRESH'	=> 'Il valore di aggiornamento è troppo piccolo.',
	'TOO_LARGE_REFRESH'	=> 'Il valore di aggiornamento è troppo grande.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Il valore di limite messaggio è troppo piccolo.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Il valore di limite messaggio è troppo grande.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Il valore limite archivio è troppo piccolo.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Il valore limite archivio è troppo grande.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Il valore di tempo è troppo breve.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Il valore di tempo è troppo grande.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'Il valore massimo della lunghezza del messaggio è troppo piccolo.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'Il valore massimo della lunghezza del messaggio è troppo grande.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'Il valore della lunghezza massima delle parole è troppo piccolo.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'Il valore della lunghezza massima delle parole è troppo grande.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'Il valore di aggiornamento whois è troppo piccolo.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'Il valore di aggiornamento whois è troppo grande.',
	'TOO_SMALL_INDEX_HEIGHT'	=> 'Il valore di altezza indice è troppo piccolo.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'Il valore di altezza indice è troppo grande.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'Il valore di altezza personalizzato è troppo piccolo.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'Il valore di altezza personalizzato è troppo grande.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'Il valore di messaggio statico è troppo corto.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'Il valore di messaggio statico è troppo grande.',
	'TOO_SMALL_TIMEOUT'	=> 'Il valore di timeout utente è troppo piccolo.',
	'TOO_LARGE_TIMEOUT'	=> 'Il valore di timeout utente è troppo grande.',

		// User perms
	'ACL_U_MCHAT_USE'			=> 'Puoi usare mchat',
	'ACL_U_MCHAT_VIEW'			=> 'Puoi vedere mChat mchat',
	'ACL_U_MCHAT_EDIT'			=> 'Puoi modificare i messaggi in mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Puoi cancellare i messaggi in mchat',
	'ACL_U_MCHAT_IP'			=> 'Puoi visualizzare indirizzi IP in mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Puoi ignorare limite flood in mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Puoi visualizzare archivio mchat',
	'ACL_U_MCHAT_BBCODE'		=> 'Puoi usare bbcode in mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Puoi usare smile in mChat',
	'ACL_U_MCHAT_URLS'			=> 'Puoi postare url in mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Puoi modificare impostazioni mChat',

));