<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net / Estonian translation by phpBBeesti.com 05/2015
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
	'MCHAT_TITLE'				=> 'Mini Jututuba',
	'MCHAT_ADD'					=> 'Saada',
	'MCHAT_IN'					=> '',
	'MCHAT_IN_SECTION'			=> 'osa',
	'MCHAT_LIKES'				=> 'Postitus meeldib',
	'MCHAT_ANNOUNCEMENT'		=> 'Teadaanne',
	'MCHAT_ARCHIVE'				=> 'Arhiiv',
	'MCHAT_ARCHIVE_PAGE'		=> 'Mini Jututoa arhiiv',
	'MCHAT_BBCODES'				=> 'BBkoodid',
	'MCHAT_CLEAN'				=> 'Puhasta',
	'MCHAT_CLEANED'				=> 'Kõik sõnumid on edukalt eemaldatud',
	'MCHAT_CLEAR_INPUT'			=> 'Lähtesta',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Kohandatud BBkoodid',
	'MCHAT_DELALLMESS'			=> 'Eemalda kõik sõnumid?',
	'MCHAT_DELCONFIRM'			=> 'Kas kinnitad eemaldamise?',
	'MCHAT_DELITE'				=> 'Kustuta',
	'MCHAT_EDIT'				=> 'Muuda',
	'MCHAT_EDITINFO'			=> 'Muuda sõnumit ja vajuta OK',
	'MCHAT_ENABLE'				=> 'Vabandame, kuid Mini-Jututuba on hetkel kättesaamatu',
	'MCHAT_ERROR'				=> 'Viga',
	'MCHAT_FLOOD'				=> 'Sa ei saa postitada oma järgmist postitust nii kiiresti',
	'MCHAT_FOE'					=> 'See sõnum on tehtud kasutaja <strong>%1$s</strong>, kes on sinu mustas nimekirjas.',
	'MCHAT_HELP'				=> 'mChat Reeglid',
	'MCHAT_HIDE_LIST'			=> 'Peida nimekiri',
	'MCHAT_HOUR'				=> 'tund ',
	'MCHAT_HOURS'				=> 'tundi',
	'MCHAT_IP'					=> 'Kelle IP aadress?',
	'MCHAT_MINUTE'				=> 'minut ',
	'MCHAT_MINUTES'				=> 'minutit ',
	'MCHAT_MESS_LONG'			=> 'Sinu sõnum on liiga pikk.\nPalun vähenda oma sõnum %s sümbolini',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'mChati kohandatud lehekülg ei ole aktiveeritud hetkel!',
	'MCHAT_NO_RULES'			=> 'mChat reeglite lehekülg ei ole aktiveeritud hetkel!',
	'MCHAT_NOACCESS'			=> 'Sul ei ole jututuppa postitamiseks õigusi',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Sul ei ole jututoa arhiivi vaatamiseks õigusi',
	'MCHAT_NOJAVASCRIPT'		=> 'Sinu veebilehitseja ei toeta JavaScripti või JavaScript on keelatud',
	'MCHAT_NOMESSAGE'			=> 'Pole ühtegi sõnumit',
	'MCHAT_NOMESSAGEINPUT'		=> 'Sa ei sisestanud sõnumit',
	'MCHAT_NOSMILE'				=> 'Emotikone ei leitud',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat ei ole paigaldatud. Palun teavita sellest foorumi administraatorit.',
	'MCHAT_NOT_INSTALLED'		=> 'mChati andmebaasi sissekanded puuduvad.<br />Palun käivita %spaigaldaja%s, et teha andmebaasi muudatused antud laiendusele.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Peatatud',
	'MCHAT_LOAD'				=> 'Laadin',
	'MCHAT_PERMISSIONS'			=> 'Muuda kasutaja õigusi',
	'MCHAT_REFRESHING'			=> 'Värskendan...',
	'MCHAT_REFRESH_NO'			=> 'Automaatne uuendamine on väljas',
	'MCHAT_REFRESH_YES'			=> 'Automaatne uuendamine iga <strong>%d</strong> sekundi tagant',
	'MCHAT_RESPOND'				=> 'Vasta kasutajale',
	'MCHAT_RESET_QUESTION'		=> 'Puhasta tekstiväli?',
	'MCHAT_SESSION_OUT'			=> 'Jututoa sessioon on aegunud',
	'MCHAT_SHOW_LIST'			=> 'Näita nimekirja',
	'MCHAT_SECOND'				=> 'sekund ',
	'MCHAT_SECONDS'				=> 'sekundit ',
	'MCHAT_SESSION_ENDS'		=> 'Jututoa sessioon aegub',
	'MCHAT_SMILES'				=> 'Emotikonid',
	'MCHAT_TOTALMESSAGES'		=> 'Sõnumeid kokku: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Heli?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Kokku on <strong>%d</strong> kasutajat jututoas ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'Kokku on <strong>%d</strong> kasutaja jututoas ',
	'MCHAT_NO_CHATTERS'					=> 'Kedagi ei ole jututoas',
	'MCHAT_ONLINE_EXPLAIN'				=> 'põhineb viimase %s minuti aktiivsetel kasutajatel',
	'WHO_IS_CHATTING'			=> 'Kes on jututoas',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Värskendatakse iga <strong>%d</strong> sekundi tagant',
	'MCHAT_NEW_TOPIC'			=> 'Tegi uue teema',
	'MCHAT_NEW_REPLY'			=> 'Tegi uue vastuse',
	'MCHAT_NEW_QUOTE'			=> 'Vastas tsiteeringuga',
	'MCHAT_NEW_EDIT'			=> 'Tegi muudatuse',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'mChat eelistused',
	'DISPLAY_MCHAT' 	=> 'Näita mChat esilehel',
	'SOUND_MCHAT'		=> 'Luba mChati heli',
	'DISPLAY_STATS_INDEX'	=> 'Näita "Kes on jututoas" statistikat esilehel',
	'DISPLAY_NEW_TOPICS'	=> 'Näita uusi teemasi jututoas',
	'DISPLAY_AVATARS'	=> 'Näita avatare jututoas',
	'CHAT_AREA'		=> 'Sisendi tüüp',
	'CHAT_AREA_EXPLAIN'	=> 'Vali, millist tüüpi ala soovid kastutada teksti sisestamiseks jutukasse:<br />Teksti ala või<br />sisend ala',
	'INPUT_AREA'		=> 'Sisend ala',
	'TEXT_AREA'			=> 'Teksti ala',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat tabel on kärbitud',
	'ACP_USER_MCHAT'			=> 'mChat seaded',
	'LOG_DELETED_MCHAT'		=> '<strong>Kustutatud mChatis sõnum</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Muudetud mChatis sõnumit</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Sümboleid jäänud: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Rämpspostitajate TOP',
	'MCHAT_NEW_CHAT'			=> 'Uus sõnum jututoas!',
	'MCHAT_SEND_PM'			 => 'Saada privaatsõnum',
	'MCHAT_PM'					=> '(PS)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Asjalik postitus',
	));