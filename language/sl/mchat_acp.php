<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * Slovenian Translation - Marko K.(max, max-ima,...)
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
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

$lang = array_merge($lang, [
	// ACP Configuration sections
	'MCHAT_SETTINGS_INDEX'							=> 'Nastavitve indeksne strani',
	'MCHAT_SETTINGS_CUSTOM'							=> 'Nastavitve strani mChat',
	'MCHAT_SETTINGS_ARCHIVE'						=> 'Nastavitve strani arhiva',
	'MCHAT_SETTINGS_POSTS'							=> 'Nastavitve novih objav',
	'MCHAT_SETTINGS_MESSAGES'						=> 'Nastavitve sporočil',
	'MCHAT_SETTINGS_PRUNE'							=> 'Nastavitve obrezovanja (nastavljive samo za ustanovitelje)',
	'MCHAT_SETTINGS_LOG'							=> 'Nastavitve dnevnika (nastavljivo samo za ustanovitelje)',
	'MCHAT_SETTINGS_STATS'							=> 'Kdo klepeta nastavitve',

	'MCHAT_GLOBALUSERSETTINGS_EXPLAIN'				=> 'Nastavitve, za katere uporabnik <strong>nima</strong> dovoljenja za prilagajanje, se uporabljajo, kot je konfigurirano spodaj.<br>Novi uporabniški računi bodo imeli začetne nastavitve, kot so konfigurirane spodaj.<br><br>Pojdite na <em> mChat v zavihku UCP</em> v razdelku uporabniških dovoljenj, da prilagodite dovoljenja za prilagajanje.<br>Pojdite na obrazec <em>Nastavitve</em> v razdelku <em>upravljanje uporabnikov</em>, da prilagodite posamezne uporabniške nastavitve .',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE'			=> 'Prepiši nastavitve za vse uporabnike',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_EXPLAIN'	=> 'Uporabi nastavitve, kot so definirane zgoraj, za <em>vse</em> uporabniške račune.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_CONFIRM'	=> 'Potrdite prepisovanje nastavitev mChat za vse uporabnike',

	'MCHAT_ACP_USER_PREFS_EXPLAIN'					=> 'Spodaj so navedene vse nastavitve mChata izbranega uporabnika. Nastavitve, za katere izbrani uporabnik nima dovoljenja za prilagajanje, so onemogočene. Te nastavitve lahko spremenite v razdelku <em>Globalne uporabniške nastavitve</em> za konfiguracijo mChata.',

	// ACP settings
	'MCHAT_ACP_CHARACTERS'							=> 'znakov',
	'MCHAT_ACP_MESSAGES'							=> 'sporočil',
	'MCHAT_ACP_SECONDS'								=> 'sekunde',
	'MCHAT_ACP_HOURS'								=> 'ure',
	'MCHAT_ACP_DAYS'								=> 'dni',
	'MCHAT_ACP_WEEKS'								=> 'tedni',
	'MCHAT_ACP_GLOBALSETTINGS_TITLE'				=> 'mChat Globalne nastavitve',
	'MCHAT_ACP_GLOBALUSERSETTINGS_TITLE'			=> 'mChat Globalne uporabniške nastavitve',
	'MCHAT_VERSION'									=> 'Verzija',
	'MCHAT_RULES'									=> 'Pravila',
	'MCHAT_RULES_EXPLAIN'							=> 'Tukaj vnesite pravila. Koda HTML je dovoljena. Nastavite na prazno, da onemogočite prikaz.<br>To sporočilo je mogoče prevesti: uredite jezikovni ključ MCHAT_RULES_MESSAGE v /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_CONFIG_SAVED'							=> 'Konfiguracija mChata je posodobljena.',
	'MCHAT_AVATARS'									=> 'Prikaži avatarje',
	'MCHAT_AVATARS_EXPLAIN'							=> 'Če je nastavljeno na da, bodo prikazani avatarji uporabnikov s spremenjeno velikostjo.',
	'MCHAT_INDEX'									=> 'Prikaži mChat na indeksni strani',
	'MCHAT_INDEX_HEIGHT'							=> 'Višina indeksne strani',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'					=> '<em>Omejeni ste od 50 do 1000. Privzeto je 250.</em>',
	'MCHAT_TOP_OF_FORUM'							=> 'Zgoraj',
	'MCHAT_BOTTOM_OF_FORUM'							=> 'Spodaj',
	'MCHAT_REFRESH'									=> 'Osvežitveni intervali',
	'MCHAT_REFRESH_EXPLAIN'							=> 'Število sekund med osveževanjem sporočil.<br><em>Omejeni ste od 2 do 3600 sekund. Privzeto je 10.</em>',
	'MCHAT_LIVE_UPDATES'							=> 'Posodobitve urejenih in izbrisanih sporočil v živo',
	'MCHAT_LIVE_UPDATES_EXPLAIN'					=> 'Ko uporabnik ureja ali izbriše sporočila, se spremembe v živo posodobijo za vse ostale, ne da bi jim bilo treba osveževati stran. Onemogočite to, če imate težave z zmogljivostjo.',
	'MCHAT_PRUNE'									=> 'Omogoči obrezovanje sporočil',
	'MCHAT_PRUNE_GC'								=> 'Interval opravil obrezovanja sporočila',
	'MCHAT_PRUNE_GC_EXPLAIN'						=> 'Čas, ki mora preteči, preden se sproži naslednje obrezovanje sporočil. Opomba: ta nastavitev nadzoruje, <em>kdaj</em> se sporočila preverjajo, če jih je mogoče izbrisati. <em>Ne</em> nadzoruje, <em>katera</em> sporočila se izbrišejo. <em>Privzeto je 86400 sekund = 24 ur.</em>',
	'MCHAT_PRUNE_NUM'								=> 'Sporočila, ki jih je treba ohraniti pri obrezovanju',
	'MCHAT_PRUNE_NUM_EXPLAIN'						=> 'Pri uporabi ’sporočil’ se ohrani določeno število sporočil. Pri uporabi ’ur’, ’dnevov’ ali ’tednov’ se izbrišejo vsa sporočila, starejša od določenega časovnega obdobja v času obrezovanja.',
	'MCHAT_PRUNE_NOW'								=> 'Obrežite sporočila zdaj',
	'MCHAT_PRUNE_NOW_CONFIRM'						=> 'Potrdite sporočila o obrezovanju',
	'MCHAT_PRUNED'									=> '%1$d sporočil mChat je bilo obrezano',
	'MCHAT_NAVBAR_LINK_COUNT'						=> 'Prikaz števila aktivnih sej klepeta v navigacijski vrstici',
	'MCHAT_MESSAGE_NUM_CUSTOM'						=> 'Začetno število sporočil za prikaz na strani mChat',
	'MCHAT_MESSAGE_NUM_CUSTOM_EXPLAIN'				=> '<em>Privzeto je 10.</em>',
	'MCHAT_MESSAGE_NUM_INDEX'						=> 'Začetno število sporočil za prikaz na indeksni strani',
	'MCHAT_MESSAGE_NUM_INDEX_EXPLAIN'				=> '<em>Privzeto je 10.</em>',
	'MCHAT_MESSAGE_NUM_ARCHIVE'						=> 'Število sporočil za prikaz na strani arhiva',
	'MCHAT_MESSAGE_NUM_ARCHIVE_EXPLAIN'				=> '<em>Omejeni ste od 10 do 100. Privzeto je 25.</em>',
	'MCHAT_ARCHIVE_SORT'							=> 'Razvrščanje sporočil',
	'MCHAT_ARCHIVE_SORT_TOP_BOTTOM'					=> 'Vedno razvrsti sporočila od najstarejših do najnovejših',
	'MCHAT_ARCHIVE_SORT_BOTTOM_TOP'					=> 'Vedno razvrsti sporočila od najnovejšega do najstarejšega',
	'MCHAT_ARCHIVE_SORT_USER'						=> 'Sporočila razvrstite glede na uporabnikovo nastavitev <em>Lokacija novih sporočil</em>',
	'MCHAT_FLOOD_TIME'								=> 'Poplavni čas',
	'MCHAT_FLOOD_TIME_EXPLAIN'						=> 'Število sekund, ki jih mora uporabnik počakati, preden v klepetu objavi drugo sporočilo.<br><em>Omejeni ste od 0 do 3600 sekund (1 ura). Privzeto je 0. Če želite onemogočiti, nastavite na 0.</em>',
	'MCHAT_FLOOD_MESSAGES'							=> 'Sporočila o poplavah',
	'MCHAT_FLOOD_MESSAGES_EXPLAIN'					=> 'Število sporočil, ki jih lahko uporabnik pošlje zaporedno, preden mora drug uporabnik objaviti v klepetu.<br><em>Omejeni ste od 0 do 100 sporočil. Privzeto je 0. Če želite onemogočiti, nastavite na 0.</em>',
	'MCHAT_EDIT_DELETE_LIMIT'						=> 'Časovna omejitev za urejanje in brisanje sporočil',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'				=> 'Sporočil, starejših od določenega števila sekund, avtor ne more več urejati ali brisati.<br>Uporabniki, ki imajo <em>dovoljenje za urejanje/brisanje in tudi dovoljenje moderatorja, so izvzeti</em> iz te časovne omejitve.<br >Nastavite na 0, da omogočite neomejeno urejanje in brisanje.',
	'MCHAT_MAX_MESSAGE_LENGTH'						=> 'Največja dolžina sporočila',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'				=> 'Največje dovoljeno število znakov na objavljeno sporočilo.<br><em>Privzeto je 500. Če želite onemogočiti, nastavite na 0.</em>',
	'MCHAT_MAX_INPUT_HEIGHT'						=> 'Največja višina vnosnega polja',
	'MCHAT_MAX_INPUT_HEIGHT_EXPLAIN'				=> 'Vnosno polje se ne bo razširilo preko tega števila slikovnih pik(pixels).<br><em>Omejeni ste od 0 do 1000. Privzeto je 150. Nastavite na 0, da ne dovolite večvrstičnih sporočil.</em>',
	'MCHAT_CUSTOM_PAGE'								=> 'Omogoči stran mChat',
	'MCHAT_CUSTOM_HEIGHT'							=> 'Višina strani mChat',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'					=> '<em>Omejeni ste od 50 do 1000. Privzeto je 350.</em>',
	'MCHAT_BBCODES_DISALLOWED'						=> 'Nedovoljene BBKode',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'				=> 'Tukaj lahko vnesete BBKode, ki se <strong>ne</strong> uporabljajo v sporočilu.<br>BBKode ločite z navpično črto, na primer:<br>b|i|u|code|list|list=|flash|quote in/ali ime oznake %1$scustom BBCode tag name%2$s.',
	'MCHAT_STATIC_MESSAGE'							=> 'Statično sporočilo',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'					=> 'Tukaj lahko definirate statično sporočilo. Koda HTML je dovoljena. Nastavite na prazno, da onemogočite prikaz.<br>To sporočilo je mogoče prevesti: uredite MCHAT_STATIC_MESSAGE language key in /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_TIMEOUT'									=> 'Časovna omejitev seje',
	'MCHAT_TIMEOUT_EXPLAIN'							=> 'Nastavite število sekund do konca seje v klepetu.<br>Nastavite na 0, če ni časovne omejitve. Previdno, seja uporabnika, ki bere mChat, ne bo nikoli potekla!<br><em>Omejeni ste na konfiguracijsko nastavitev %1$sforum za seje%2$s, ki je trenutno nastavljena na %3$d sekund.</em >',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'					=> 'Preglasite omejitev smeškosti',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'			=> 'Nastavite na da, da preglasite nastavitev omejitve smeškov na forumih za sporočila v klepetu.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'					=> 'Preglasite omejitev najmanjšega števila znakov',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'			=> 'Nastavite na da, da preglasite nastavitev minimalnih znakov v forumih za sporočila klepeta.',
	'MCHAT_LOG_ENABLED'								=> 'Dodajte vnose v skrbniški dnevnik',
	'MCHAT_LOG_ENABLED_EXPLAIN'						=> 'To vpliva na urejanje, brisanje, obrezovanje in brisanje sporočil.',

	'MCHAT_POSTS_AUTH_CHECK'						=> 'Zahtevaj uporabniško dovoljenje',
	'MCHAT_POSTS_AUTH_CHECK_EXPLAIN'				=> 'Če je nastavljeno na da, uporabniki, ki ne morejo uporabljati mChat-a, ne bodo ustvarili nobenih obvestil o objavi/prijavi.',

	'MCHAT_WHOIS_REFRESH'							=> 'Kdo klepeta interval osveževanja',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'					=> 'Število sekund, preden se osveži, kdo klepeta.<br><em>Omejeni ste od 10 do 300 sekund. Privzeto je 60.</em>',
	'MCHAT_SOUND'									=> 'Predvajajte zvoke za nova, urejena in izbrisana sporočila',
	'MCHAT_PURGE'									=> 'Zdaj izbrišite vsa sporočila',
	'MCHAT_PURGE_CONFIRM'							=> 'Potrdite brisanje vseh sporočil',
	'MCHAT_PURGED'									=> 'Vsa sporočila mChat so bila uspešno izbrisana.',

	'MCHAT_REPARSER_STATUS'							=> 'Stanje razpravljalca sporočil',
	'MCHAT_REPARSER_ACTIVE'							=> 'aktiven',
	'MCHAT_REPARSER_FINISHED'						=> 'končal',

	// '%1$s' contains 'Retain posts' and 'Delete posts' respectively
	'MCHAT_RETAIN_MESSAGES'							=> '%1$s in obdržite sporočila mChat',
	'MCHAT_DELETE_MESSAGES'							=> '%1$s in izbrišite sporočila mChat',

	// Error reporting
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'				=> 'Nedovoljena vrednost BBCodes je predolga.',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'					=> 'Vrednost višine strani mChat je premajhna.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'					=> 'Vrednost višine strani mChat je prevelika.',
	'TOO_LONG_MCHAT_DATE'							=> 'Oblika datuma, ki ste jo vnesli, je predolga.',
	'TOO_SHORT_MCHAT_DATE'							=> 'Format datuma, ki ste ga vnesli, je prekratek.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'					=> 'Vrednost časa poplave je prevelika.',
	'TOO_LARGE_MCHAT_FLOOD_MESSAGES'				=> 'Vrednost sporočil o poplavi je prevelika.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'					=> 'Vrednost višine indeksa je premajhna.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'					=> 'Vrednost višine indeksa je prevelika.',
	'TOO_LARGE_MCHAT_MAX_INPUT_HEIGHT'				=> 'Največja vrednost vhodne višine je prevelika.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'Število sporočil za prikaz na strani arhiva je premajhno.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'Število sporočil za prikaz na strani arhiva je preveliko.',
	'TOO_SMALL_MCHAT_REFRESH'						=> 'Vrednost osveževanja je premajhna.',
	'TOO_LARGE_MCHAT_REFRESH'						=> 'Vrednost osveževanja je prevelika.',
	'TOO_SMALL_MCHAT_TIMEOUT'						=> 'Vrednost uporabniške časovne omejitve je premajhna.',
	'TOO_LARGE_MCHAT_TIMEOUT'						=> 'Vrednost časovne omejitve uporabnika je prevelika.',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'					=> 'Vrednost osveževanja whois je premajhna.',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'					=> 'Vrednost osveževanja whois je prevelika.',

	'MCHAT_30X_REMNANTS'							=> 'Namestitev je bila prekinjena.<br>V bazi so preostali moduli iz mChat MOD za phpBB 3.0.x. Razširitev mChat ne deluje pravilno s temi prisotnimi moduli.<br>Pred namestitvijo razširitve mChat morate v celoti odstraniti mChat MOD. Natančneje, module z naslednjimi ID-ji je treba izbrisati iz %1$smodules table: %2$s',
]);
