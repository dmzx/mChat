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
	'ACP_MCHAT_CONFIG'				=> 'Configuratie',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Een mini chat (aka “shout box”) voor gebruik op jouw forum',
	'MCHAT_TABLE_DELETED'			=> 'De mChat tabel is succesvol verwijderd',
	'MCHAT_TABLE_CREATED'			=> 'De mChat tabel is succesvol aangemaakt',
	'MCHAT_TABLE_UPDATED'			=> 'De mChat tabel is succesvol bijgewerkt.',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Niks te doen..... doorgaan',
	'UCP_CAT_MCHAT'					=> 'mChat voorkeuren',
	'UCP_MCHAT_CONFIG'				=> 'Gebruiker mChat voorkeuren',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Regels',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Verander hier de regels van het forum.	Elke regel op een nieuwe lijn.<br />Je kunt maximaal 255 karakters gebruiken.<br /><strong>Deze boodschap kan worden vertaald..</strong> (Je moet de mchat_lang.php file aanpassen en lees de instructies).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Update mChat configuratie </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'Mini Chat configuratie is bijgewerkt',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Versie:',
	'MCHAT_ENABLE'					=> 'Inschakelen mChat Extensie',
	'MCHAT_ENABLE_EXPLAIN'			=> 'In- of Uitschakelen van deze extensie.',
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
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Het aantal seconden dat een gebruiker moet wachten om een volgend bericht te plaatsen in de mChat.<br /><em>Aanbevolen is tussen de 5 en 30 seconden, 0 is uitschakelen van deze functie</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'		=> 'Maximale berichten lengte',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Maximaal toegestane aantal karakters per gepost bericht.<br /><em>anbevolen is tussen de 100 en 500 karakters, 0 is uitschakelen van deze functie</em>.',
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
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Hier kan je een statisch bericht definieren, welke getoond wordt aan de gebruikers van de mChat.<br />Stel 0 in om de vertoning uit te schakelen.	Je bent gelimiteerd tot 255 karakters.<br /><strong>Deze boodschap kan worden vertaald..</strong> (Je moet de mchat_lang.php file aanpassen en lees de instructies).',
	'MCHAT_USER_TIMEOUT'			=> 'Gebruiker timeout',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Stel hier de seconden in, wanneer de sessie van een gebruiker eindigd. Stel 0 om de timeout uit te schakelen.<br /><em>Je bent gelimiteerd tot de %sforum instellingen voor de chat sessie, welke momenteel is ingesteld op %s seconden</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Aantal smilie limiet',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Stel hier het aantal smilie limiet in voor de chat berichten',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Minimum karakters limit',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Stel ja in om het aantal minimum karakters in te stellen voor een chat bericht',
	'MCHAT_NEW_POSTS'				=> 'Inschakelen van de berichten weergave',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Stel Ja in en je kan onder de opties instellen welke chat berichten worden weergegeven in de mChat.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Weergave in mChat van nieuwe topic berichten',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Stel ja in om de nieuwe topic berichten van het forum te tonen in de mChat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Weergave in mChat van nieuwe beantwoorde berichten',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Stel ja in om de beantwoorde berichten van het forum te tonen in de mChat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Weergave bewerkte berichten',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Stel Ja in om de bewerkte berichten van het forum te tonen in de mChat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Weergave geciteerde berichten',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Stel Ja in om de geciteerde berichten van het forum te tonen in de mChat.',
	'MCHAT_MAIN'					=> 'Hoofd Configuratie',
	'MCHAT_STATS'					=> 'Wie is aan het chatten',
	'MCHAT_STATS_INDEX'				=> 'Statistieken op de Index pagina',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Laat zien wie aan het chatten is in de statistieken sectie op het forum',
'MCHAT_MESSAGE_TOP'					=> 'Toon berichten boven of beneden in mChat',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Dit zal het geplaatste bericht boven of beneden laten zien in mChat.',
	'MCHAT_BOTTOM'					=> 'Beneden',
	'MCHAT_TOP'						=> 'Boven',
	'MCHAT_MESSAGES'				=> 'Berichten instellingen',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pauze op eventuele inactiviteit van mChat',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Stel je ja in, dan wordt mChat niet automatisch vernieuwd, todat een gebruiker een bericht plaatst in mChat',

	// error reporting
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

		// User perms
	'ACL_U_MCHAT_USE'			=> 'Je kunt mChat gebruiken',
	'ACL_U_MCHAT_VIEW'			=> 'Je kunt mChat bekijken',
	'ACL_U_MCHAT_EDIT'			=> 'Je kunt mchat berichten bewerken',
	'ACL_U_MCHAT_DELETE'		=> 'Je kunt mChat berichten verwijderen',
	'ACL_U_MCHAT_IP'			=> 'Je kunt mChat IP adressen bekijken',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Je kunt mChat de hoeveelheid aan data negeren',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Je kunt het archief van mChat bekijken',
	'ACL_U_MCHAT_BBCODE'		=> 'Je kunt de bbcode in mChat gebruiken',
	'ACL_U_MCHAT_SMILIES'		=> 'Je kunt de smilies in mChat gebruiken',
	'ACL_U_MCHAT_URLS'			=> 'Je kunt urls posten in mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Je kunt de vindt ik leuk knop gebruiken in mChat',
	'ACL_U_MCHAT_PM'			=> 'Je kunt de berichten knop gebruiken in mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Je kunt de citeer berichten knop gebruiken in mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Kan mChat instellingen beheren',

));