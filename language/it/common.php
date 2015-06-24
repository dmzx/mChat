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
	'MCHAT_ADD'					=> 'Invia',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> 'section',
	'MCHAT_LIKES'				=> 'Likes this post',
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
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
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
	'MCHAT_NEW_TOPIC'			=> 'Nuovo Topic',
	'MCHAT_NEW_REPLY'			=> 'Nuova risposta',
	'MCHAT_NEW_QUOTE'			=> 'Risposta con Quote',
	'MCHAT_NEW_EDIT'			=> 'Ha modificato',

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
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat tabelle cancellate',
	'ACP_USER_MCHAT'			=> 'mChat Opzioni',
	'LOG_DELETED_MCHAT'		=> '<strong>Cancella messaggi mChat</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Modifica messaggi mChat</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caratteri: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Miglior Spammer',
	'MCHAT_NEW_CHAT'			=> 'Nuovo messaggio in Chat !',
	'MCHAT_SEND_PM'			 => 'Invia messaggio privato',
	'MCHAT_PM'					=> '(PM)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Like This Post',
));