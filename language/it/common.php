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

	'MCHAT_TITLE'				=> 'Mini Chat',
	'MCHAT_ADD'					=> 'Invia',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> '',
	'MCHAT_LIKES'				=> 'Mi Piace il messaggio: ',
	'MCHAT_ANNOUNCEMENT'		=> 'Annuncio',
	'MCHAT_ARCHIVE'				=> 'Archivio',
	'MCHAT_ARCHIVE_PAGE'		=> 'Archivio Chat',
	'MCHAT_BBCODES'				=> 'BBCode',
	'MCHAT_CLEAN'				=> 'Cancella',
	'MCHAT_CLEANED'				=> 'Tutti i messaggi sono stati rimossi',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a> - traduzione <a href="http://brunino.altervista.org">BruninoIt</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Modifica BBCode',
	'MCHAT_DELALLMESS'			=> 'Rimuovere tutti i messaggi?',
	'MCHAT_DELCONFIRM'			=> 'Confermi la rimozione?',
	'MCHAT_DELITE'				=> 'Cancella',
	'MCHAT_EDIT'				=> 'Modifica',
	'MCHAT_EDITINFO'			=> 'Modifica il messaggio e premi Ok',
	'MCHAT_ENABLE'				=> 'Spiacente, mChat non è al momento disponibile',
	'MCHAT_ERROR'				=> 'Errore',
	'MCHAT_FLOOD'				=> 'Non puoi inviare un altro messaggio dopo così poco tempo',
	'MCHAT_FOE'					=> 'Questo messaggio è stato inviato da <strong>%1$s</strong> che è attualmente sulla tua lista di utenti ignorati.',
	'MCHAT_HELP'				=> 'Regole mChat',
	'MCHAT_HIDE_LIST'			=> 'Nascondi lista',
	'MCHAT_HOUR'				=> 'ora ',
	'MCHAT_HOURS'				=> 'ore',
	'MCHAT_IP'					=> 'dettagli IP di',
	'MCHAT_MINUTE'				=> 'minuto ',
	'MCHAT_MINUTES'				=> 'minuti ',
	'MCHAT_MESS_LONG'			=> 'Il tuo messaggio è troppo lungo.\n Il limite è di %s caratteri',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'La pagina intera della mChat non è disponibile al momento!',
	'MCHAT_NO_RULES'			=> 'La pagina delle regole della mChat non è disponibile al momento!',
	'MCHAT_NOACCESS'			=> 'Non hai il permesso di inviare messaggi in mChat',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Non hai il permesso di visualizzare l’Archivio',
	'MCHAT_NOJAVASCRIPT'		=> 'Il tuo browser non supporta JavaScript oppure JavaScript è disabilitato',
	'MCHAT_NOMESSAGE'			=> 'Nessun messaggio',
	'MCHAT_NOMESSAGEINPUT'		=> 'Non hai inserito alcun messaggio',
	'MCHAT_NOSMILE'				=> 'Smile non trovato',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat non è installato. Si prega di comunicarlo all’Admin.',
	'MCHAT_NOT_INSTALLED'		=> 'Mancano delle voci nel database di mChat.<br />Eseguire l’%sinstaller%s per apportare le modifiche al database.',
	'MCHAT_OK'					=> 'Ok',
	'MCHAT_PAUSE'				=> 'Pausa',
	'MCHAT_LOAD'				=> 'Caricamento',
	'MCHAT_PERMISSIONS'			=> 'Cambia permessi utente',
	'MCHAT_REFRESHING'			=> 'Refresh...',
	'MCHAT_REFRESH_NO'			=> 'Il caricamento automatico è disabilitato',
	'MCHAT_REFRESH_YES'			=> 'Caricamento automatico ogni <strong>%d</strong> secondi',
	'MCHAT_RESPOND'				=> 'Rispondere',
	'MCHAT_RESET_QUESTION'		=> 'Cancellare il testo da inviare?',
	'MCHAT_SESSION_OUT'			=> 'Sessione della chat scaduta',
	'MCHAT_SHOW_LIST'			=> 'Mostra lista',
	'MCHAT_SECOND'				=> 'secondo ',
	'MCHAT_SECONDS'				=> 'secondi ',
	'MCHAT_SESSION_ENDS'		=> 'La sessione della chat termina tra ',
	'MCHAT_SMILES'				=> 'Smile',
	'MCHAT_TOTALMESSAGES'		=> 'Totale messaggi: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Usare i suoni?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Ci sono <strong>%d</strong> utenti in chat',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'C’è un utente in chat ',
	'MCHAT_NO_CHATTERS'					=> 'Nessun utente in chat',
	'MCHAT_ONLINE_EXPLAIN'				=> 'basato sugli utenti attivi negli ultimi %s',
	'WHO_IS_CHATTING'			=> 'Chi è in chat',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Refresh ogni <strong>%d</strong> secondi',
	'MCHAT_NEW_TOPIC'			=> 'Nuovo Topic',
	'MCHAT_NEW_REPLY'			=> 'Nuovo Post',
	'MCHAT_NEW_QUOTE'			=> 'Citazione',
	'MCHAT_NEW_EDIT'			=> 'Ha modificato',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'Preferenze mChat',
	'DISPLAY_MCHAT' 	=> 'Visualizza mChat nell’indice',
	'SOUND_MCHAT'		=> 'Abilita suoni mChat',
	'DISPLAY_STATS_INDEX'	=> 'Visualizza le statistiche di mChat nell’indice',
	'DISPLAY_NEW_TOPICS'	=> 'Visualizza nuovi topic nella chat',
	'DISPLAY_AVATARS'	=> 'Visualizza avatar nella chat',
	'CHAT_AREA'		=> 'Tipo di input',
	'CHAT_AREA_EXPLAIN'	=> 'Scegli quale tipo di input usare nella chat:<br />Una text-area o<br />un campo di input',
	'INPUT_AREA'		=> 'Input area',
	'TEXT_AREA'			=> 'Text area',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'Impostazioni mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'Tabelle di mChat cancellate',
	'ACP_USER_MCHAT'			=> 'Opzioni mChat',
	'LOG_DELETED_MCHAT'		=> '<strong>cancellato il messaggio della mChat</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>modificato il messaggio della mChat</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caratteri: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Utente più attivo in Chat',
	'MCHAT_NEW_CHAT'			=> 'Nuovo messaggio nella Chat!',
	'MCHAT_SEND_PM'			 => 'Invia messaggio privato',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Mi Piace il messaggio ',
));
