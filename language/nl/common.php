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
	'MCHAT_ADD'					=> 'Versturen',
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

	'MCHAT_TOTALMESSAGES'		=> 'Total berichten: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Gebruik geluid?',

	'MCHAT_ONLINE_USERS_TOTAL'			=> 'In totaal zijn er <strong>%d</strong> gebruikers aan het chatten ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'In total is er <strong>%d</strong> gebruiker aan het chatten ',
	'MCHAT_NO_CHATTERS'					=> 'Niemand is aan het chatten',
	'MCHAT_ONLINE_EXPLAIN'				=> 'gebaseerd op actieve gebruikers over de afgelopen %s',

	'WHO_IS_CHATTING'			=> 'Wie is aan het chatten',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'ververst iedere <strong>%d</strong> seconden',
	'MCHAT_NEW_TOPIC'			=> '<strong>Nieuw Topic</strong>',
	'MCHAT_NEW_REPLY'			=> '<strong>Nieuw antwoord</strong>',

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
	// ACP
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Verander hier de regels van het forum.  Elke regel op een nieuwe lijn.<br />Je kunt maximaal 255 karakters gebruiken.<br /><strong>Deze boodschap kan worden vertaald..</strong> (Je moet de mchat_lang.php file aanpassen en lees de instructies).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Update mChat configuratie </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini Chat configuratie is bijgewerkt',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versie:',
	'MCHAT_ENABLE'					=> 'Inschakelen mChat Extensie',
	'MCHAT_ENABLE_EXPLAIN'			=> 'In of Uitschakelen van deze extensie.',
	'MCHAT_AVATARS'					=> 'Toon avatars',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Als je ja hebt aangevinkt, verkleinde gebruikers avatars zullen worden getoond',
	'MCHAT_ON_INDEX'				=> 'mChat Op de Index pagina',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Toestaan om de mChat te tonen op de Index pagina.',
	'MCHAT_INDEX_HEIGHT'			=> 'Index pagina hoogte',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'De hoogte van de mChat box op de Index pagina uitgedrukt in pixels, kun je hier aanpassen.<br /><em>Je bent gelimiteerd tussen de 50 en 1000</em>.',
	'MCHAT_LOCATION'				=> 'Locatie op het Forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Kies de locatie van de mChat op de Index pagina.',
	'MCHAT_TOP_OF_FORUM'			=> 'Bovenaan op het Forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Onderaan op het Forum',
	'MCHAT_REFRESH'					=> 'Vernieuwen',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Aantal seconden dat de mChat automatische ververst wordt.<br /><em>Je bent gelimiteerd tussen 5 en 60 seconden</em>.',
	'MCHAT_PRUNE'					=> 'Inschakelen opschonen van berichten',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Vink Ja aan als je het opschonen van berichten wilt inschakelen.<br /><em>Werkt alleen als een gebruiker de gemaakte of archief pagina bekijkt</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Het aantal berichten welke bewaard moeten worden in de mChat',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Geef hier het aantal in, van de berichten welke je bewaard wilt houden in de mChat.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Berichten limiet',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Maximaal aantal berichten, welke getoond worden in de mChat.<br /><em>Aanbevolen is tussen de 10 en 30 berichten</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Index pagina berichten limiet',
	'MCHAT_MESSAGE_NUM_EXPLAIN'		=> 'Het maximale aantal berichten, welke getoond worden in de mChat op de Index pagina.<br /><em>Aanbevolen is tussen de 10 en 50 berichten</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Archief limiet',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Het maximale aantal berichten, welke getoond worden in de mChat op de Archief pagina.<br /><em>Aanbevolen is tussen de 25 en 50 berichten</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Wachttijd plaatsen volgende bericht, na reeds geplaatst bericht',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'et aantal seconden dat een gebruiker moet wachten om een volgend bericht te plaatsen in de mChat.<br /><em>Aanbevolen is tussen de 5 en 30 seconden, 0 is uitschakelen van deze functie</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Maximale berichten lengte',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'aximaal toegestane aantal karakters per gepost bericht.<br /><em>aanbevolen is tussen de 100 en 500 karakters, 0 is uitschakelen van deze functie</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Aangepaste pagina',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Toestaan om gebruik te maken van de mChat op de aangepaste pagina',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Aangepaste pagina hoogte',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'De hoogte van de mChat box in pixels op de aangepaste mChat pagina.<br /><em>Je bent gelimiteerd tussen de 50 en 1000 pixels</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Datum weergave',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'De gebruikte syntax is identiek aan de PHP <a href="http://www.php.net/date">date()</a> functie.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Aangepast…',
	'MCHAT_WHOIS'					=> 'Whois',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Toestaan om gebruikers te laten zien die gebruik maken van de mChat',
	'MCHAT_WHOIS_REFRESH'			=> 'Whois vernieuwen',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Aantal seconden voordat whois statistieken worden vernieuwd.<br /><em>Je bent gelimiteerd tussen de 30 en 300 seconden</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Niet toegestane bbcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Hier kun je de bbcodes plaatsen, die <strong>niet</strong>zijn toegstaan<strong>not</strong> om te gebruiken in een bericht.<br />Aparte BBCodes met een verticale balk , bijvoorbeeld: <br />b|i|u|code|list|list=|flash|quote and/or a %scustom bbcode tag name%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Statisch bericht',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Hier kan je een statisch bericht definieren, welke getoond wordt aan de gebruikers van de mChat.<br />Stel 0 in om de vertoning uit te schakelen.  Je bent gelimiteerd tot 255 karakters.<br /><strong>Deze boodschap kan worden vertaald..</strong> (Je moet de mchat_lang.php file aanpassen en lees de instructies).',
	'MCHAT_USER_TIMEOUT'			=> 'Gebruiker timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Stel hier de seconden in, wanneer de sessie van een gebruiker eindigd. Stel 0 om de timeout uit te schakelen.<br /><em>Je bent gelimiteerd tot de %sforum instellingen voor de chat sessie, welke momenteel is ingesteld op %s seconden</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Aantal smilie limiet',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'SStel hier het aantal smilie limiet in voor de chat berichten',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Minimum karakters limit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Stel ja in om het aantal minimum karakters in te stellen voor een chat bericht',
	'MCHAT_NEW_POSTS'				=> 'Toon nieuwe berichten',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Stel ja in om nieuwe berichten te plaatsen in een chat bericht<br /><strong>U moet de add-on voor de nieuwe post meldingen geïnstalleerd hebben</strong> (within the contrib directory of the extension download).',
	'MCHAT_MAIN'					=> 'Hoofd Configuratie',
	'MCHAT_STATS'					=> 'Wie is aan het chatten',
	'MCHAT_STATS_INDEX'				=> 'Statistieken op de Index pagina',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Laat zien wie aan het chatten is in de statistieken sectie op het forum',
	'MCHAT_MESSAGES'				=> 'Berichten instellingen',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pauze op eventuele inactiviteit van mChat',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Stel je ja in, dan wordt mChat niet automatisch vernieuwd, todat een gebruiker een bericht plaatst in mChat',

	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'De mChat extensie moet worden bijgewerkt. Neem contact op met de forum beheerder om de mChat bij te laten werken.',
	'MCHAT_WRONG_VERSION'	=> 'De verkeerde versie van de extensie is geinstalleerd.  Gebruik a.u.b. de %sinstaller%s van de nieuwe versie voor eventuele wijzigingen.',
	'WARNING'	=> 'Waarschuwing',
'TOO_LONG_DATE'		=> 'De datum weergave die je hebt ingegeven is te lang.',
	'TOO_SHORT_DATE'	=> 'De datum weergave die je hebt ingegeven is te kort.',
	'TOO_SMALL_REFRESH'	=> 'De waarde voor het vernieuwen van de pagina is te klein.',
	'TOO_LARGE_REFRESH'	=> 'De waarde voor het vernieuwen van de pagina is te groot.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'De waarde van de berichten limiet is te klein.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'De waarde van de berichten limiet is te groot.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'De waarde van het archief limiet is te klein.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'De waarde van het archief limiet is te groot.',
		'TOO_SMALL_FLOOD_TIME'	=> 'De waarde van de hoeveelheid aan data in een bepaalde tijd is te klein.',
	'TOO_LARGE_FLOOD_TIME'	=> 'De waarde van de hoeveelheid aan data in een bepaalde tijd is te groot.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'De waarde van de maximale lengte van berichten is te klein.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'De waarde van de maximale lengte van berichten is te groot.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'De waarde van de maximale lengte van het aantal woorden is te klein.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'De waarde van de maximale lengte van het aantal woorden is te groot.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'De verversing van de whois waarde is te klein.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'De verversing van de whois waarde is te groot.',
'TOO_SMALL_INDEX_HEIGHT'	=> 'De waarde van de index hoogte is te klein.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'De waarde van de index hoogte is te groot.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'De waarde van de gemaakte hoogte is te klein.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'De waarde van de gemaakte hoogte is te groot.',
		'TOO_SHORT_STATIC_MESSAGE'	=> 'De waarde van de statische berichten is te kort.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'De waarde van de statische berichten is te lang.',
	'TOO_SMALL_TIMEOUT'	=> 'De waarde van de timeout voor gebruikers is te klein.',
	'TOO_LARGE_TIMEOUT'	=> 'De waarde van de timeout voor gebruikers is te groot.',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat', //Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'mChat tabel is ingekort',
	'ACP_USER_MCHAT'			=> 'mChat Instellingen',
	'LOG_DELETED_MCHAT'	  => '<strong>Verwijder mChat berichten</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'	  => '<strong>Bewerk mChat berichten</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'   => 'Overgebleven karakters: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> 'Nieuw Chat bericht!',
	'FONT_COLOR'				=> 'letter kleur',
	'FONT_COLOR_HIDE'			=> 'verberg letter kleur',
	'FONT_HUGE'					=> 'Zeer Groot',
	'FONT_LARGE'				=> 'Groot',
	'FONT_NORMAL'				=> 'Normaal',
	'FONT_SIZE'					=> 'Letter grootte',
	'FONT_SMALL'				=> 'Klein',
	'FONT_TINY'					=> 'zeer klein',
	'MCHAT_SEND_PM'			 => 'Stuur prive bericht',
	'MCHAT_PM'				  => '(PM)',
	'MORE_SMILIES'			  => 'Meer Smilies',
));