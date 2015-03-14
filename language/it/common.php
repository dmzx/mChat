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

// Adding new category
$lang['permission_cat']['mchat'] = 'mChat';

// Adding the permissions
$lang = array_merge($lang, array(

	'MCHAT_TITLE'				=> 'Mini-Chat',
	'MCHAT_ADD'					=> 'Invia',
	'MCHAT_ANNOUNCEMENT'		=> 'Announcio',
	'MCHAT_ARCHIVE'				=> 'Archivio',	
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini-Chat Archivio',	
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Cancella',
	'MCHAT_CLEANED'				=> 'Tutti i messaggi sono stati rimossi',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a> traduzione by <a href="http://www.microcosmoacquari.it/forum/">Microcosmo</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Modifica BBCodes',
	'MCHAT_DELALLMESS'			=> 'Rimuovere tutti i messaggi ?',
	'MCHAT_DELCONFIRM'			=> 'Vuoi confermare la rimozione ?',
	'MCHAT_DELITE'				=> 'Cancella',
	'MCHAT_EDIT'				=> 'Modifica',
	'MCHAT_EDITINFO'			=> 'Modifica il messaggio e clicca OK',
	'MCHAT_ENABLE'				=> 'Spiacente, la Mini-Chat non è al momento disponibile',	
	'MCHAT_ERROR'				=> 'Errore',	
	'MCHAT_FLOOD'				=> 'Non puoi inviare un altro messaggio così presto dopo ultimo',	
	'MCHAT_FOE'					=> 'Questo messaggio è stato inviato da <strong>%1$s</strong> che è attualmente sulla tua lista da ignorare.',
	'MCHAT_HELP'				=> 'Regole mChat',
	'MCHAT_HIDE_LIST'			=> 'Nascondi Lista',	
	'MCHAT_HOUR'				=> 'ora ',
	'MCHAT_HOURS'				=> 'ore',
	'MCHAT_IP'					=> 'IP whois per',
	
	'MCHAT_MINUTE'				=> 'minuto ',
	'MCHAT_MINUTES'				=> 'minuti ',
	'MCHAT_MESS_LONG'			=> 'Il tuo messaggio è troppo lungo.\n Perfavore limita a %s caratteri',	
	'MCHAT_NO_CUSTOM_PAGE'		=> 'La pagina mChat personalizzata non si attiva in questo momento!',	
	'MCHAT_NOACCESS'			=> 'Non hai il permesso di postare in mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Non hai il permesso di visualizzare questo archivio',	
	'MCHAT_NOJAVASCRIPT'		=> 'Il tuo browser non supporta JavaScript oppure JavaScript è disabilitato',		
	'MCHAT_NOMESSAGE'			=> 'Nessun messaggio',
	'MCHAT_NOMESSAGEINPUT'		=> 'Non hai inserito un messaggio',
	'MCHAT_NOSMILE'				=> 'Smile non trovato',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat non è installato. Si prega di comunicarlo al fondatore.',
	'MCHAT_NOT_INSTALLED'		=> 'mChat database voci mancanti.<br />Eseguire il %sinstaller%s per apportare le modifiche del database.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Pausa',
	'MCHAT_LOAD'				=> 'Loading',      
	'MCHAT_PERMISSIONS'			=> 'Cambia permessi utente',
	'MCHAT_REFRESHING'			=> 'Refresh...',
	'MCHAT_REFRESH_NO'			=> 'Autoupdate è off',
	'MCHAT_REFRESH_YES'			=> 'Autoupdate ogni <strong>%d</strong> secondi',
	'MCHAT_RESPOND'				=> 'Rispondere',
	'MCHAT_RESET_QUESTION'		=> 'Cancellare area ingresso ?',
	'MCHAT_SESSION_OUT'			=> 'Chat sessione scaduta',	
	'MCHAT_SHOW_LIST'			=> 'Mostra lista',
	'MCHAT_SECOND'				=> 'secondo ',
	'MCHAT_SECONDS'				=> 'secondi ',
	'MCHAT_SESSION_ENDS'		=> 'Chat sessione termina in',
	'MCHAT_SMILES'				=> 'Smile',

	'MCHAT_TOTALMESSAGES'		=> 'Totale messaggi: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Usa suono ?',
	

	'MCHAT_ONLINE_USERS_TOTAL'			=> 'In totale ci sono <strong>%d</strong> utenti in chat ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'In totale un <strong>%d</strong> utente in chat ',
	'MCHAT_NO_CHATTERS'					=> 'Nessuno sta chattando',
	'MCHAT_ONLINE_EXPLAIN'				=> 'basato sugli utenti attivi negli ultimi %s',
	
	'WHO_IS_CHATTING'			=> 'Chi è in chat',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Refresh ogni <strong>%d</strong> secondi',
	'MCHAT_NEW_TOPIC'			=> '<strong>Nuovo Topic</strong>',		
	'MCHAT_NEW_REPLY'			=> '<strong>Nuova risposta</strong>',	
	
	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat Preferenze',
	
	'DISPLAY_MCHAT' 	=> 'Visualizza mChat in Index',
	'SOUND_MCHAT'		=> 'Abilita suono mChat',
	'DISPLAY_STATS_INDEX'	=> 'Visualizzare le statistiche di chi sta chattando a pagina index',
	'DISPLAY_NEW_TOPICS'	=> 'Visualizza nuovi argomenti chat',
	'DISPLAY_AVATARS'	=> 'Visualizza avatar in chat',
	'CHAT_AREA'		=> 'Tipo di ingresso',
	'CHAT_AREA_EXPLAIN'	=> 'Scegli il tipo di superficie da utilizzare per inserire la chat:<br />Area di testo o<br />area input',
	'INPUT_AREA'		=> 'Input area',
	'TEXT_AREA'			=> 'Testo area',	
	// ACP
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Inserire le regole del forum qui. Ogni regola su una nuova linea.<br />Limite a 255 caratteri.<br /><strong>Questo messaggio può essere tradotto.</strong> (necessario modificare il file mchat_lang.php archiviare e leggere le istruzioni).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Aggiornamento configurazione mChat </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini Chat configurazioni salvate',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versione:',
	'MCHAT_ENABLE'					=> 'Abilita Estensione mChat',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Abilita o disabilita Mchat globalmente.',
	'MCHAT_AVATARS'					=> 'Visualizza avatars',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Se impostato su Sì, verranno visualizzati gli avatar degli utenti ridimensionate',	
	'MCHAT_ON_INDEX'				=> 'mChat in Indice',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Consentire la visualizzazione di mChat nella pagina indice.',
	'MCHAT_INDEX_HEIGHT'			=> 'Indice Altezza Pagina',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Altezza della casella della chat in pixel nella pagina indice del forum.<br /><em>You are limited from 50 to 1000</em>.',
	'MCHAT_LOCATION'				=> 'Posizione nel Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Scegliere la posizione della mChat nella pagina indice.',
	'MCHAT_TOP_OF_FORUM'			=> 'In alto al Forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'In basso al Forum',
	'MCHAT_REFRESH'					=> 'Refresh',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Numero di secondi prima di chat si aggiorna automaticamente.<br /><em>Limite da 5 a 60 secondi</em>.',
	'MCHAT_PRUNE'					=> 'Abilita Cancellazione',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Impostare su SI per abilitare la funzione cancellazione automatica.<br /><em>Si verifica solo se un utente visualizza le pagine personalizzate o di archivio</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Cancellazione numero',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Il numero di messaggi da mantenere in chat.',	
	'MCHAT_MESSAGE_LIMIT'			=> 'Messaggi limite',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare nella chat.<br /><em>Recommandati da 10 a 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limite messaggi di pagina in Indice',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare nella chat sulla pagina indice.<br /><em>Recommandati da 10 a 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limite Archivio',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Il numero massimo di messaggi da visualizzare per pagina nelle pagine archivio.<br /> <em>Raccomandati da 25 a 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Tempo',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Il numero di secondi che un utente deve attendere prima di inviare un altro messaggio in chat.<br /><em>Raccomandati da 5 a 30, imposta 0 per disabilitare</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Lunghezza massima messaggi',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Il numero massimo di caratteri consentiti per messaggio inviato.<br /><em>Raccomandato da 100 a 500, imposta 0 per disabilitare</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Pagina personalizzata',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Consentire utilizzo della pagina personalizzata',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Pagina personalizzata altezza',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Altezza della casella di chat in pixel della pagina mChat separata.<br /><em>Limite da 50 a 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Formato Data',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'La sintassi usata è identica al PHP <a href="http://www.php.net/date">date()</a>',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Uso…',
	'MCHAT_WHOIS'					=> 'Whois',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Lasciare visualizzazione utenti che sono in chat',
	'MCHAT_WHOIS_REFRESH'			=> 'Whois refresh',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Numero di secondi prima del refresh del whois.<br /><em>Limite da 30 a 300 secondi</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Disabilita bbcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Qui è possibile inserire i BBCodes da <strong>non</strong> utilizzare.<br />Separare i bbcodes da una barra verticale, ad esempio: <br />b|i|u|code|list|list=|flash|quote e/o %scustom bbcode tag name%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Messaggi Statici',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Here you can define a static message to display to users of the chat.  HTML code is allowed.<br />Set to empty to disable the display.  You are limited to 255 characters.<br /><strong>This message can be translated.</strong>  (you must edit the mchat_lang.php file and read the instructions).',
	'MCHAT_USER_TIMEOUT'			=> 'User Timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Set the amount of time, in seconds, until a users session in the chat ends. Set to 0 for no timeout.<br /><em>You are limited to the %sforum config setting for sessions%s which is currently set to %s seconds</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Override smilie limit',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Set to yes to override the forums smilie limit setting for chat messages',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Override minimum characters limit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Set to yes to override the forums minimum characters setting for chat messages',
	'MCHAT_NEW_POSTS'				=> 'Display New Posts',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Set to yes to allow new posts from the forum to be posted into the chat message area<br /><strong>You must have the add-on for new post notifications installed</strong> (within the contrib directory of the extension download).',
	'MCHAT_MAIN'					=> 'Main Configuration',
	'MCHAT_STATS'					=> 'Whois Chatting',
	'MCHAT_STATS_INDEX'				=> 'Stats on Index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Show who is chatting with in the stats section of the forum',
	'MCHAT_MESSAGES'				=> 'Message Settings',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause on input',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'If set Yes, then the chat will not autoupdate upon a user entering a message in the input area',
	
	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'The mChat extension needs updating.  Please have a forum founder visit this section to run the installer.',
	'MCHAT_WRONG_VERSION'	=> 'The wrong version of the extension is installed.  Please run the %sinstaller%s for the new version of the modification.',
	'WARNING'	=> 'Warning',
	'TOO_LONG_DATE'		=> 'The date format you entered is too long.',
	'TOO_SHORT_DATE'	=> 'The date format you entered is too short.',
	'TOO_SMALL_REFRESH'	=> 'The refresh value is too small.',
	'TOO_LARGE_REFRESH'	=> 'The refresh value is too large.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'The message limit value is too small.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'The message limit value is too large.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'The archive limit value is too small.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'The archive limit value is too large.',
	'TOO_SMALL_FLOOD_TIME'	=> 'The flood time value is too small.',
	'TOO_LARGE_FLOOD_TIME'	=> 'The flood time value is too large.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'The max message length value is too small.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'The max message length value is too large.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'The max words length value is too small.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'The max words length value is too large.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'The whois refresh value is too small.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'The whois refresh value is too large.',	
	'TOO_SMALL_INDEX_HEIGHT'	=> 'The index height value is too small.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'The index height value is too large.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'The custom height value is too small.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'The custom height value is too large.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'The static message value is too short.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'The static message value is too long.',	
	'TOO_SMALL_TIMEOUT'	=> 'The user timeout value is too small.',
	'TOO_LARGE_TIMEOUT'	=> 'The user timeout value is too large.',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat', //Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat Table was pruned',
	'ACP_USER_MCHAT'			=> 'mChat Settings',
	'LOG_DELETED_MCHAT'      => '<strong>Deleted mChat message</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'      => '<strong>Edited mChat message</strong><br />» %1$s',	
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'   => 'Characters remaining: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'            => 'Miglior Spammer',
	'MCHAT_NEW_CHAT'            => 'Nuovo messaggio in Chat !',
	'FONT_COLOR'				=> 'Font colore',
	'FONT_COLOR_HIDE'			=> 'Nascondi colore font',
	'FONT_HUGE'					=> 'Enorme',
	'FONT_LARGE'				=> 'Grande',
	'FONT_NORMAL'				=> 'Normale',
	'FONT_SIZE'					=> 'Grandezza Font',
	'FONT_SMALL'				=> 'Piccolo',
	'FONT_TINY'					=> 'Molto Piccolo',
	'MCHAT_SEND_PM'             => 'Invia messaggio privato',
    'MCHAT_PM'                  => '(PM)',
	'MORE_SMILIES'              => 'Altre Smile',
));