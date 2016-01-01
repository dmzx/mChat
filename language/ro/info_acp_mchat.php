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
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, array(
	// UMIL stuff
	'ACP_MCHAT_CONFIG'						=> 'Configurație',
	'ACP_CAT_MCHAT'							=> 'mChat',
	'ACP_MCHAT_TITLE'						=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'				=> 'Un mini chat (adică “shout box”) pentru forumul tău',
	'MCHAT_TABLE_DELETED'					=> 'Tabla mChat s-a șters cu succes',
	'MCHAT_TABLE_CREATED'					=> 'Tabla mChat s-a creat cu succes',
	'MCHAT_TABLE_UPDATED'					=> 'Tabla mChat s-a actualizat cu succes',
	'MCHAT_NOTHING_TO_UPDATE'				=> 'Nu este nimic de făcut....continuăm',
	'UCP_CAT_MCHAT'							=> 'mChat Prefs',
	'UCP_MCHAT_CONFIG'						=> 'User mChat Prefs',

	// ACP entries
	'ACP_MCHAT_RULES'						=> 'Reguli',
	'ACP_MCHAT_RULES_EXPLAIN'				=> 'Introduceți regulile forumului aici. Fiecare regulă intr-o nouă linie.<br />Ai o limită de 255 de caractere.<br /><strong>Acest mesaj poate fi tradus.</strong> (modificând fișierul mchat_lang.php și citind instrucțiunile).',
	'LOG_MCHAT_CONFIG_UPDATE'				=> '<strong>Configurație mChat actualizată </strong>',
	'MCHAT_CONFIG_SAVED'					=> 'Configurația mini-Chat actualizată',
	'MCHAT_TITLE'							=> 'Mini-Chat',
	'MCHAT_VERSION'							=> 'Versiune:',
	'MCHAT_ENABLE'							=> 'Permite extensia mChat',
	'MCHAT_ENABLE_EXPLAIN'					=> 'Activare sau dezactivare a extensiei la nivel global.',
	'MCHAT_AVATARS'							=> 'Arată avatare',
	'MCHAT_AVATARS_EXPLAIN'					=> 'Dacă este setat -DA-, avatarele redimensionate utilizator vor fi afișate',
	'MCHAT_ON_INDEX'						=> 'mChat pe Index',
	'MCHAT_ON_INDEX_EXPLAIN'				=> 'Permite afișarea extensiei mChat pe pagina de Index.',
	'MCHAT_INDEX_HEIGHT'					=> 'Înăltimea mChat afișată pe Index',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'			=> 'Înăltimea ferestrei de chat dată in pixeli pe pagina principală index a forumului.<br /><em>Limita este începând de la 50 până la 1000</em>.',
	'MCHAT_LOCATION'						=> 'Locația pe forum',
	'MCHAT_LOCATION_EXPLAIN'				=> 'Alege locația chatului pe pagina de index.',
	'MCHAT_TOP_OF_FORUM'					=> 'Partea de sus a forumului -top-',
	'MCHAT_BOTTOM_OF_FORUM'					=> 'Partea de jos a forumului -bottom-',
	'MCHAT_REFRESH'							=> 'Actualizare',
	'MCHAT_REFRESH_EXPLAIN'					=> 'Numărul de secunde înainte ca chatul să se actualizeze automat.<br /><em>Limita este de la 5 la 60 de secunde</em>.',
	'MCHAT_PRUNE'							=> 'Permite curățarea',
	'MCHAT_PRUNE_EXPLAIN'					=> 'Alege -DA- pentru a permite opțiunea de curățare.<br /><em>Se produce doar atunci când utilizatorul vede pagina proprie și/sau arhiva chatului</em>.',
	'MCHAT_PRUNE_NUM'						=> 'Cantitate a curăța',
	'MCHAT_PRUNE_NUM_EXPLAIN'				=> 'Numărul de mesaje păstrate în chat.',
	'MCHAT_MESSAGE_LIMIT'					=> 'Limitare mesaje',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'			=> 'Numărul maxim de mesaje ce poate fi arătat in fereastra chatului.<br /><em>Recomandat între 10 și 30</em>.',
	'MCHAT_MESSAGE_NUM'						=> 'Limitare mesaje la index',
	'MCHAT_MESSAGE_NUM_EXPLAIN'				=> 'Numărul maxim de mesaje ce poate fi arătat in fereastra chatului la pagina de index.<br /><em>Recomandat între 10 și 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'					=> 'Limitare arhivă',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'			=> 'Numărul maxim de mesaje ce poate fi arătat pentru fiecare pagină, la pagina arhivei.<br /> <em>Recomandat între 25 și 50</em>.',
	'MCHAT_FLOOD_TIME'						=> 'Timpul de flood',
	'MCHAT_FLOOD_TIME_EXPLAIN'				=> 'Numărul de secunde ce trebuie să aștepte un utilizator înainte de a trimite alt mesaj pe chat.<br /><em>Recomandat între 5 și 30, setează 0 pentru dezactivare</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'				=> 'Lungimea maximă a mesajului',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'		=> 'Numărul maxim de caractere permis pentru fiecare mesaj trimis pe chat.<br /><em>Recomandat între 100 și 500, setează 0 pentru dezactivare</em>.',
	'MCHAT_CUSTOM_PAGE'						=> 'Pagina proprie',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'				=> 'Permite utilizatorului a folosi pagina proprie a chatului.',
	'MCHAT_CUSTOM_HEIGHT'					=> 'Înăltimea paginii proprie',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'			=> 'Înăltimea ferestrei de chat în pixeli în pagina proprie mChat.<br /><em>Dimensiunile permise sunt cuprinse între 50 și 1000</em>.',
	'MCHAT_DATE_FORMAT'						=> 'Format dată',
	'MCHAT_DATE_FORMAT_EXPLAIN'				=> 'Sintaxa utilizată este identică cu cea folosită din funcția PHP a datei <a href="http://www.php.net/date">date()</a>.',
	'MCHAT_CUSTOM_DATEFORMAT'				=> 'Personalizat...',
	'MCHAT_WHOIS'							=> 'Whois',
	'MCHAT_WHOIS_EXPLAIN'					=> 'Permite afișarea utilizatorilor activi pe chat',
	'MCHAT_WHOIS_REFRESH'					=> 'Actualizare whois',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'			=> 'Numărul de secunde înainte ca statistica whois să se actualizeze.<br /><em>Dimensiunile permise sunt cuprinse între 30 și 300 de secunde</em>.',
	'MCHAT_BBCODES_DISALLOWED'				=> 'Coduri BB ne permise',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'		=> 'Aici poți introduce coduri BB ce <strong>NU</strong> se pot folosi în chat.<br />Codurile BB pot fi separate cu o bară verticală, de exemplu: <br />b|i|u|code|list|list=|flash|quote și/sau/ un cod bb %scustom etichetat name%s',
	'MCHAT_STATIC_MESSAGE'					=> 'Mesaj static',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'			=> 'Aici puteți defini un mesaj static pentru a afișa utilizatorilor din chat. Codul HTML este permis.<br />Lasă spațiul gol pentru a anula afișarea. Sun permise până la 255 de caractere.<br /><strong>Acest mesaj poate fi tradus.</strong> (trebuie modificat doar fișierul mchat_lang.php și a citii instrucțiunile).',
	'MCHAT_USER_TIMEOUT'					=> 'Limita de timp a utilizatorului',
	'MCHAT_USER_TIMEOUT_EXPLAIN'			=> 'Setați durata de timp, în secunde, până la încheierea sesiunii a utilizatorului pe chat. Setează 0 pentru a anula limita de timp.<br /><em>Ești limitat la configurația forumului %sforum config. Setarea pentru o sesiune sessions%s ce actual este setată la %s secunde</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Suprascrie limita de zîmbete',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Setare la -DA- pentru a suprascrie setările folosite în forumuri zâmbetele, pentru mesajele din chat.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'			=> 'Suprascrie limita minimă de caractere',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Setare la -DA- pentru a suprascrie setările folosite în forumuri la caracterele minime pentru mesajele din chat',
	'MCHAT_NEW_POSTS'						=> 'Activează afișarea mesajelor -posts-',
	'MCHAT_NEW_POSTS_EXPLAIN'				=> 'Setare la -DA- și mai jos putem alege ce mesaje se vor afișa pe spațiul de chat.',
	'MCHAT_NEW_POSTS_TOPIC'					=> 'Afișează subiecte noi',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'			=> 'Setează -DA- pentru a permite noilor subicte din forum să fie afișate pe spațiul de chat.',
	'MCHAT_NEW_POSTS_REPLY'					=> 'Afișează răspunsuri noi',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'			=> 'Setează -DA- pentru a permite noilor răspunsuri din forum să fie afișate pe spațiul de chat.',
	'MCHAT_NEW_POSTS_EDIT'					=> 'Afișează răspunsuri modificate',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'			=> 'Setează -DA- pentru a permite afișarea pe spațiul de chat a răspunsurilor modificate.',
	'MCHAT_NEW_POSTS_QUOTE'					=> 'Afișează răspunsuri citate',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'			=> 'Setează -DA- pentru a permite afișarea răspunsurilor citate din forumuri pe spațiul de chat.',
	'MCHAT_MAIN'							=> 'Configurația principală',
	'MCHAT_STATS'							=> 'Cine este pe chat -Whois-',
	'MCHAT_STATS_INDEX'						=> 'Statistici pe Index',
	'MCHAT_STATS_INDEX_EXPLAIN'				=> 'Arată cine scrie pe chat împreună cu secțiunea de statistici a forumului',
	'MCHAT_MESSAGE_TOP'						=> 'Păstrează mesaj în Jos / Sus',
	'MCHAT_MESSAGE_TOP_EXPLAIN'				=> 'Aceasta va publica mesajul de jos sau de sus în zona mesaj de discuții.',
	'MCHAT_BOTTOM'							=> 'Jos',
	'MCHAT_TOP'								=> 'Sus',
	'MCHAT_MESSAGES'						=> 'Setări mesaje',
	'MCHAT_PAUSE_ON_INPUT'					=> 'Pauză pe intrare',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'			=> 'Dacă este setat -DA-, atunci chatul nu se va actualiza automat până când un utilizator nu va începe să scrie pe zona de intrare.',

	// Error reporting
	'MCHAT_NEEDS_UPDATING'					=> 'Extensia mChat trebuie actualizată. Anunță fundatorul forumului să viziteze această secție pentru a executa instalarea.',
	'MCHAT_WRONG_VERSION'					=> 'Versiunea greșită a extensiei este instalată. Te rog, execută %sinstaller%s pentru o nouă versiune a extensiei.',
	'WARNING'								=> 'Atenție',
	'TOO_LONG_DATE'							=> 'Formatul datei introdus este prea lung.',
	'TOO_SHORT_DATE'						=> 'Formatul datei introdus este prea scurt.',
	'TOO_SMALL_REFRESH'						=> 'Valoarea pentru reîmprospătare este prea mică.',
	'TOO_LARGE_REFRESH'						=> 'Valoarea pentru reîmprospătare este prea mare.',
	'TOO_SMALL_MESSAGE_LIMIT'				=> 'Valoarea limită mesaj este prea mică.',
	'TOO_LARGE_MESSAGE_LIMIT'				=> 'Valoarea limită mesaj este prea mare.',
	'TOO_SMALL_ARCHIVE_LIMIT'				=> 'Valoarea limită de arhivă este prea mică.',
	'TOO_LARGE_ARCHIVE_LIMIT'				=> 'Valoarea limită de arhivă este prea mare.',
	'TOO_SMALL_FLOOD_TIME'					=> 'Valoarea timpului de flood este prea mică.',
	'TOO_LARGE_FLOOD_TIME'					=> 'Valoarea timpului de flood este prea mică.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'			=> 'Valoarea maximă a lungimii unui mesaj este prea mică.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'			=> 'Valoarea maximă a lungimii unui mesaj este prea mare.',
	'TOO_SMALL_MAX_WORDS_LNGTH'				=> 'Valoarea maximă a lungimii cuvintelor este prea mică.',
	'TOO_LARGE_MAX_WORDS_LNGTH'				=> 'Valoarea maximă a lungimii cuvintelor este prea mare.',
	'TOO_SMALL_WHOIS_REFRESH'				=> 'Valoarea whois la reîmprospătare este prea mică.',
	'TOO_LARGE_WHOIS_REFRESH'				=> 'Valoarea whois la reîmprospătare este prea mare.',
	'TOO_SMALL_INDEX_HEIGHT'				=> 'Valoarea înălțimii de pe index este prea mică.',
	'TOO_LARGE_INDEX_HEIGHT'				=> 'Valoarea înălțimii de pe index este prea mare.',
	'TOO_SMALL_CUSTOM_HEIGHT'				=> 'Valoarea înălțimii a paginei proprii este prea mică.',
	'TOO_LARGE_CUSTOM_HEIGHT'				=> 'Valoarea înălțimii a paginei proprii este prea mare.',
	'TOO_SHORT_STATIC_MESSAGE'				=> 'Valoarea mesaj static este prea scurtă.',
	'TOO_LONG_STATIC_MESSAGE'				=> 'Valoarea mesaj static este prea lungă.',
	'TOO_SMALL_TIMEOUT'						=> 'Valoarea pentru limita de timp a utilizatorului este prea mică.',
	'TOO_LARGE_TIMEOUT'						=> 'Valoarea pentru limita de timp a utilizatorului este prea mare.',

	// User perms
	'ACL_U_MCHAT_USE'						=> 'Poate utiliza mChat',
	'ACL_U_MCHAT_VIEW'						=> 'Poate vizualiza mChat',
	'ACL_U_MCHAT_EDIT'						=> 'Poate modifica mesajele din mChat',
	'ACL_U_MCHAT_DELETE'					=> 'Poate șterge mesajele din mChat',
	'ACL_U_MCHAT_IP'						=> 'Poate utiliza vizualizarea adreselor IP în mChat',
	'ACL_U_MCHAT_PM'						=> 'Poate folosi mesaj privat în mchat',
	'ACL_U_MCHAT_LIKE'						=> 'Poate folosi like la mesaje în chat',
	'ACL_U_MCHAT_QUOTE'						=> 'Poate folosi răspunsuri citate în mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Poate ignora limita de timp -flood- în mChat',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Poate vizualiza arhiva mChat',
	'ACL_U_MCHAT_BBCODE'					=> 'Poate folosi coduri bb în mChat',
	'ACL_U_MCHAT_SMILIES'					=> 'Poate folosi zâmbete în mChat',
	'ACL_U_MCHAT_URLS'						=> 'Poate folosi url în mChat',

	// Admin perms
	'ACL_A_MCHAT'							=> array('lang' => 'Pot gestiona setările din mChat', 'cat' => 'permissions'), // Using a phpBB category here
));
