<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
* @Translation: Romanian (Română)
* @Translator:	GEORGiOBBLOVER < georgiobblover@gmail.com > (Georgian Iordache) http://escritoriobase.com
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

$lang = array_merge($lang, array(
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_ADD'						=> 'Trimite',
	'MCHAT_IN'						=> 'în',
	'MCHAT_IN_SECTION'				=> 'secție',
	'MCHAT_LIKES'					=> 'Aprecieri acestui mesaj',
	'MCHAT_ANNOUNCEMENT'			=> 'Anunț',
	'MCHAT_ARCHIVE'					=> 'Arhivă',
	'MCHAT_ARCHIVE_PAGE'			=> 'Arhivă mini-Chat',
	'MCHAT_BBCODES'					=> 'Coduri BB',
	'MCHAT_CLEAN'					=> 'Curățenie',
	'MCHAT_CLEANED'					=> 'Toate mesajele s-au eliminat cu succes',
	'MCHAT_CLEAR_INPUT'				=> 'Ștergere',
	'MCHAT_COPYRIGHT'				=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'			=> 'Coduri BB personalizate',
	'MCHAT_DELALLMESS'				=> 'Ștergi toate mesajele?',
	'MCHAT_DELCONFIRM'				=> 'Ești sigur?',
	'MCHAT_DELITE'					=> 'Șterge',
	'MCHAT_EDIT'					=> 'Modifică',
	'MCHAT_EDITINFO'				=> 'Editează mesaj și apoi apasă OK',
	'MCHAT_ENABLE'					=> 'Ne pare rău, momentan mini-Chat nu este disponibil',
	'MCHAT_ERROR'					=> 'Eroare',
	'MCHAT_FLOOD'					=> 'Nu poți trimite alt mesaj (chiar așa de repede de la ultimul)',
	'MCHAT_FOE'						=> 'Acest mesaj a fost trimis de <strong>%1$s</strong>. Se află blocat in lista ta.',
	'MCHAT_HELP'					=> 'Regulament mChat',
	'MCHAT_HIDE_LIST'				=> 'Ascunde lista',
	'MCHAT_HOUR'					=> 'oră ',
	'MCHAT_HOURS'					=> 'ore',
	'MCHAT_IP'						=> 'IP whois pentru',
	'MCHAT_MINUTE'					=> 'minut',
	'MCHAT_MINUTES'					=> 'minute',
	'MCHAT_MESS_LONG'				=> 'Mesajul tău este prea lung.\Te rog, limitează-l la %s characters',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'Pagina pentru mChat nu este activată momentan!',
	'MCHAT_NO_RULES'				=> 'Regulile pentru pagina mChat momentan nu sunt disponibile!',
	'MCHAT_NOACCESS'				=> 'Nu ai acces să scrii pe mChat',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Nu ai acces să vezi arhiva',
	'MCHAT_NOJAVASCRIPT'			=> 'Browserul tău nu suportă JavaScript sau JavaScript nu este activat',
	'MCHAT_NOMESSAGE'				=> 'Nu sunt mesaje',
	'MCHAT_NOMESSAGEINPUT'			=> 'Nu ai scris nici un mesaj',
	'MCHAT_NOSMILE'					=> 'Nu sunt zâmbete',
	'MCHAT_NOTINSTALLED_USER'		=> 'mChat nu este instalat.	Te rog anunță fundatorul comunității.',
	'MCHAT_NOT_INSTALLED'			=> 'Intrările in baza de date pentru mChat lipsesc.<br />Execută %sinstaller%s pentru a modifica baza de date a extensiei.',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Pauză',
	'MCHAT_LOAD'					=> 'Se încarcă',
	'MCHAT_PERMISSIONS'				=> 'Schimbă accesul membrilor',
	'MCHAT_REFRESHING'				=> 'Reîmprospătare...',
	'MCHAT_REFRESH_NO'				=> 'Actualizarea automată nu este activată',
	'MCHAT_REFRESH_YES'				=> 'Actualizarea automată la fiecare <strong>%d</strong> secunde',
	'MCHAT_RESPOND'					=> 'Răspunde membrului',
	'MCHAT_RESET_QUESTION'			=> 'Ștergi mesajul de pe bara?',
	'MCHAT_SESSION_OUT'				=> 'Sesiunea de chat a expirat',
	'MCHAT_SHOW_LIST'				=> 'Arată lista',
	'MCHAT_SECOND'					=> 'secundă ',
	'MCHAT_SECONDS'					=> 'secunde ',
	'MCHAT_SESSION_ENDS'			=> 'Sesiunea de chat expiră în',
	'MCHAT_SMILES'					=> 'Zâmbete',
	'MCHAT_TOTALMESSAGES'			=> 'Număr total de mesaje: <strong>%s</strong>',
	'MCHAT_USESOUND'				=> 'Folosești sunet?',
	'MCHAT_ONLINE_USERS_TOTAL'		=> 'În total sunt <strong>%d</strong> membri pe chat ',
	'MCHAT_ONLINE_USER_TOTAL'		=> 'În total sunt <strong>%d</strong> membri activi ',
	'MCHAT_NO_CHATTERS'				=> 'Nu este activitate pe chat',
	'MCHAT_ONLINE_EXPLAIN'			=> 'bazat pe membri activi în ultimele %s',
	'WHO_IS_CHATTING'				=> 'Cine scrie pe chat',
	'WHO_IS_REFRESH_EXPLAIN'		=> 'Actualizare la fiecare <strong>%d</strong> secunde',
	'MCHAT_NEW_TOPIC'				=> 'A publicat un subiect',
	'MCHAT_NEW_REPLY'				=> 'A publicat un mesaj',
	'MCHAT_NEW_QUOTE'				=> 'A răspuns cu citat',
	'MCHAT_NEW_EDIT'				=> 'A făcut o modificare',

	// UCP
	'UCP_PROFILE_MCHAT'				=> 'Preferințe mChat',
	'DISPLAY_MCHAT' 				=> 'Afișează mChat pe Index',
	'SOUND_MCHAT'					=> 'Permite sunet în mChat',
	'DISPLAY_STATS_INDEX'			=> 'Afișează cine scrie pe chat -who is chating- pe pagina de index',
	'DISPLAY_NEW_TOPICS'			=> 'Afișează subiecte noi pe chat',
	'DISPLAY_AVATARS'				=> 'Afișează avatare pe chat',
	'CHAT_AREA'						=> 'Tipul de intrare -bara de scriere-',
	'CHAT_AREA_EXPLAIN'				=> 'Alege una din metodele de a trimite mesaje în chat:<br />Suprafață de text sau<br />o zonă de intrare',
	'INPUT_AREA'					=> 'zonă de intrare',
	'TEXT_AREA'						=> 'suprafață de text',
	'UCP_CAT_MCHAT'					=> 'mChat',
	'UCP_MCHAT_CONFIG'				=> 'mChat',

	// Preferences
	'LOG_MCHAT_TABLE_PRUNED'		=> 'Tabla mChat s-a curățat',
	'ACP_USER_MCHAT'				=> 'Setări mChat',
	'LOG_DELETED_MCHAT'				=> '<strong>Mesaje din mChat eliminate</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Mesaje din mChat modificate</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caractere rămase: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'				=> 'Top Spameri',
	'MCHAT_NEW_CHAT'				=> 'Mesaj nou!',
	'MCHAT_SEND_PM'			 		=> 'Trimite mesaj privat',

	// Custom edits
	'REPLY_WITH_LIKE'				=> 'Îmi place mesajul',
));
