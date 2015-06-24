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
	'MCHAT_ADD'					=> 'Versturen',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> 'sectie',
	'MCHAT_LIKES'				=> 'Vindt dit bericht leuk',
	'MCHAT_ANNOUNCEMENT'		=> 'Aankondiging',
	'MCHAT_ARCHIVE'				=> 'Archief',
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini-Chat Archief',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Opschonen',
	'MCHAT_CLEANED'				=> 'Alle berichten zijn succesvol verwijderd',
	'MCHAT_CLEAR_INPUT'			=> 'Reset',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'gebruik BBCodes',
	'MCHAT_DELALLMESS'			=> 'Verwijder alle berichten?',
	'MCHAT_DELCONFIRM'			=> 'Ben je akkoord om te verwijderen?',
	'MCHAT_DELITE'				=> 'Verwijder',
	'MCHAT_EDIT'				=> 'Bewerk',
	'MCHAT_EDITINFO'			=> 'Bewerk het bericht en klik op OKE',
	'MCHAT_ENABLE'				=> 'Sorry, de Mini-Chat is momenteel niet beschikbaar',
	'MCHAT_ERROR'				=> 'Fout',
	'MCHAT_FLOOD'				=> 'Je kunt niet zo snel een bericht plaatsen, na jouw laatste bericht !!',
	'MCHAT_FOE'					=> 'Dit bericht was gemaakt door <strong>%1$s</strong> die momenteel op jouw negeerlijst staat.',
	'MCHAT_HELP'				=> 'mChat Regels',
	'MCHAT_HIDE_LIST'			=> 'Lijst verbergen',
	'MCHAT_HOUR'				=> 'uur ',
	'MCHAT_HOURS'				=> 'uren',
	'MCHAT_IP'					=> 'IP whois voor',
	'MCHAT_MINUTE'				=> 'minuut ',
	'MCHAT_MINUTES'				=> 'minuten ',
	'MCHAT_MESS_LONG'			=> 'Jou bericht is te lang.Beperk dit a.u.b. tot %s karakters',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'De gebruikte mChat pagina is niet actief op dit moment!',
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'			=> 'Je hebt geen permissie om een bericht in mChat te plaatsen',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Je hebt geen permissie om het archief te bekijken',
	'MCHAT_NOJAVASCRIPT'		=> 'Je browser ondersteunt geen JavaScript of JavaScript is uitgeschakeld',
	'MCHAT_NOMESSAGE'			=> 'Geen berichten',
	'MCHAT_NOMESSAGEINPUT'		=> 'Je hebt geen bericht ingevoerd',
	'MCHAT_NOSMILE'				=> 'Smilies zijn niet gevonden',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat is niet geinstalleerd. Neem contact op met de beheerder van het forum.',
	'MCHAT_NOT_INSTALLED'		=> 'mChat database invoeringen ontbreken.<br />voer a.u.b. de %sinstaller%s om de database veranderingen te maken voor deze modificatie.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Pauze',
	'MCHAT_LOAD'				=> 'Laden',
	'MCHAT_PERMISSIONS'			=> 'Verander gebruikers permissie',
	'MCHAT_REFRESHING'			=> 'Verversen...',
	'MCHAT_REFRESH_NO'			=> 'Verversen is uit',
	'MCHAT_REFRESH_YES'			=> 'Ververs iedere <strong>%d</strong> seconden',
	'MCHAT_RESPOND'				=> 'Reageer naar gebruiker',
	'MCHAT_RESET_QUESTION'		=> 'Schoon het ingave veld op?',
	'MCHAT_SESSION_OUT'			=> 'Chat sessie is verlopen',
	'MCHAT_SHOW_LIST'			=> 'Toon lijst',
	'MCHAT_SECOND'				=> 'seconde ',
	'MCHAT_SECONDS'				=> 'seconden ',
	'MCHAT_SESSION_ENDS'		=> 'Chat sessie eindigdt in',
	'MCHAT_SMILES'				=> 'Smilies',
	'MCHAT_TOTALMESSAGES'		=> 'Totaal aantal berichten: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Gebruik geluid?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'In totaal zijn er <strong>%d</strong> gebruikers aan het chatten ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'In total is er <strong>%d</strong> gebruiker aan het chatten ',
	'MCHAT_NO_CHATTERS'					=> 'Niemand is aan het chatten',
	'MCHAT_ONLINE_EXPLAIN'				=> 'gebaseerd op actieve gebruikers over de afgelopen %s',
	'WHO_IS_CHATTING'			=> 'Wie is aan het chatten',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'ververst iedere <strong>%d</strong> seconden',
	'MCHAT_NEW_TOPIC'			=> 'Een nieuw Topic gemaakt',
	'MCHAT_NEW_REPLY'			=> 'Een nieuw antwoord gemaakt',
	'MCHAT_NEW_QUOTE'			=> 'Beantwoord met een Citaat',
	'MCHAT_NEW_EDIT'			=> 'Een bewerking gemaakt',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat voorkeuren',
	'DISPLAY_MCHAT' 	=> 'Toon mChat op de index pagina',
	'SOUND_MCHAT'		=> 'Inschakelen geluid mChat',
	'DISPLAY_STATS_INDEX'	=> 'Toon de wie is er aan het chatten op de index pagina',
	'DISPLAY_NEW_TOPICS'	=> 'Toon nieuwe topics in de chat',
	'DISPLAY_AVATARS'	=> 'Toon avatars in de chat',
	'CHAT_AREA'		=> 'Invoer type',
	'CHAT_AREA_EXPLAIN'	=> 'Kies welke type te gebruiken om een chat in te voeren:<br />een tekst gebied of<br />een invoerveld',
	'INPUT_AREA'		=> 'Invoerveld',
	'TEXT_AREA'			=> 'Tekst gebied',
		'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat tabel is ingekort',
	'ACP_USER_MCHAT'			=> 'mChat Instellingen',
	'LOG_DELETED_MCHAT'		=> '<strong>Verwijder mChat berichten</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Bewerk mChat berichten</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Overgebleven karakters: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> 'Nieuw Chat bericht!',
	'MCHAT_SEND_PM'			 => 'Stuur prive bericht',
	'MCHAT_PM'					=> '(PM)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Vindt dit bericht leuk',
));