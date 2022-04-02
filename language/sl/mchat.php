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
	'MCHAT_ADD'						=> 'Pošlji',
	'MCHAT_ARCHIVE'					=> 'Arhiv',
	'MCHAT_ARCHIVE_PAGE'			=> 'mChat arhiv',
	'MCHAT_CUSTOM_PAGE'				=> 'mChat',
	'MCHAT_BBCODES'					=> 'BBKode',
	'MCHAT_CUSTOM_BBCODES'			=> 'BBKode po meri',
	'MCHAT_DELCONFIRM'				=> 'Ali ste prepričani, da želite izbrisati to sporočilo?',
	'MCHAT_EDIT'					=> 'Uredi',
	'MCHAT_EDITINFO'				=> 'Uredite spodnje sporočilo.',
	'MCHAT_NEW_CHAT'				=> 'Novo sporočilo v klepetu!',
	'MCHAT_SEND_PM'					=> 'Pošlji zasebno sporočilo',
	'MCHAT_LIKE'					=> 'Všečkajte to sporočilo',
	'MCHAT_LIKES'					=> 'Všečkajte to sporočilo',
	'MCHAT_FLOOD'					=> 'Tako kmalu po zadnjem sporočilu ne morete objaviti drugega sporočila.',
	'MCHAT_FOE'						=> 'To sporočilo je poslal <strong>%1$s</strong>, ki je trenutno na vašem seznamu prezrtih.',
	'MCHAT_RULES'					=> 'Pravila',
	'MCHAT_WHOIS_USER'				=> 'IP whois za %1$s',
	'MCHAT_MESS_LONG'				=> 'Vaše sporočilo je predolgo. Omejite ga na %1$d znakov.',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'Stran mChat trenutno ni aktivirana.',
	'MCHAT_NO_RULES'				=> 'Stran s pravili mChat trenutno ni aktivirana.',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Nimate dovoljenja za ogled arhiva.',
	'MCHAT_NOJAVASCRIPT'			=> 'Če želite uporabljati mChat, omogočite JavaScript.',
	'MCHAT_NOMESSAGE'				=> 'Brez sporočil',
	'MCHAT_NOMESSAGEINPUT'			=> 'Niste vnesli sporočila',
	'MCHAT_MESSAGE_DELETED'			=> 'To sporočilo je bilo izbrisano.',
	'MCHAT_OK'						=> 'V redu',
	'MCHAT_PAUSE'					=> 'Zaustavljeno',
	'MCHAT_PERMISSIONS'				=> 'Spremenite uporabniška dovoljenja',
	'MCHAT_REFRESHING'				=> 'Osveževanje…',
	'MCHAT_RESPOND'					=> 'Odgovorite uporabniku',
	'MCHAT_SMILES'					=> 'Smeški',
	'MCHAT_TOTALMESSAGES'			=> 'Skupaj sporočil: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Predvajaj zvok',
	'MCHAT_SOUND_ON'				=> 'Zvok je vklopljen',
	'MCHAT_SOUND_OFF'				=> 'Zvok je izklopljen',
	'MCHAT_ENTER'					=> 'Za alternativno dejanje uporabite Ctrl/Cmd + Enter',
	'MCHAT_ENTER_SUBMIT'			=> 'Enter pošlje sporočilo',
	'MCHAT_ENTER_LINEBREAK'			=> 'Enter doda novo vrstico',
	'MCHAT_COLLAPSE_TITLE'			=> 'Preklopi vidnost mChata',
	'MCHAT_WHO_IS_REFRESH_EXPLAIN'	=> 'Osveži vsakih <strong>%1$d</strong> sekund',
	'MCHAT_MINUTES_AGO'				=> [
		0 => 'pravkar',
		1 => 'Pred %1$d minuto',
		2 => 'Pred %1$d minutami',
	],

	// These messages are formatted with JavaScript, hence {} and no %d
	'MCHAT_CHARACTER_COUNT'			=> '<strong>{current}</strong> znakov',
	'MCHAT_CHARACTER_COUNT_LIMIT'	=> '<strong>{current}</strong> od {max} znakov',
	'MCHAT_MENTION'					=> ' @{username} ',
]);
