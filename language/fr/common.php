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
	'MCHAT_ADD'					=> 'Envoyer',
	'MCHAT_IN'					=> 'in',
	'MCHAT_IN_SECTION'			=> 'section',
	'MCHAT_LIKES'				=> 'Likes this post',
	'MCHAT_ANNOUNCEMENT'		=> 'Annonce',
	'MCHAT_ARCHIVE'				=> 'Archives',
	'MCHAT_ARCHIVE_PAGE'		=> 'Archives du mini-chat',
	'MCHAT_BBCODES'				=> 'BBCodes',
	'MCHAT_CLEAN'				=> 'Vider le mini-chat',
	'MCHAT_CLEANED'				=> 'Tous les messages ont été supprimés avec succès.',
	'MCHAT_CLEAR_INPUT'			=> 'Réinitialisation',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'BBCodes personnalisés',
	'MCHAT_DELALLMESS'			=> 'Supprimer tous les messages ?',
	'MCHAT_DELCONFIRM'			=> 'Confirmer la suppression ?',
	'MCHAT_DELITE'				=> 'Supprimer',
	'MCHAT_EDIT'				=> 'Éditer',
	'MCHAT_EDITINFO'			=> 'Éditez le message et cliquez sur OK.',
	'MCHAT_ENABLE'				=> 'Désolé, le mini-chat est actuellement indisponible.',
	'MCHAT_ERROR'				=> 'Erreur',
	'MCHAT_FLOOD'				=> 'Vous ne pouvez pas poster un autre message si peu de temps après votre dernier message.',
	'MCHAT_FOE'					=> 'Ce message a été écrit par <strong>%1$s</strong> qui est actuellement dans votre liste des ignorés.',
	'MCHAT_HELP'				=> 'Règles du mChat',
	'MCHAT_HIDE_LIST'			=> 'Masquer la liste',
	'MCHAT_HOUR'				=> 'heure ',
	'MCHAT_HOURS'				=> 'heures',
	'MCHAT_IP'					=> 'Whois pour l’IP',
	'MCHAT_MINUTE'				=> 'minute ',
	'MCHAT_MINUTES'				=> 'minutes ',
	'MCHAT_MESS_LONG'			=> 'Votre message est trop long.\nLimité à %s caractères',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'La page personnalisée du mChat n’est pas activée en ce moment!',
	'MCHAT_NO_RULES'			=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'			=> 'Vous n’avez pas les permissions pour poster dans le mini-chat.',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Vous n’avez pas les permissions pour voir les archives.',
	'MCHAT_NOJAVASCRIPT'		=> 'Votre navigateur ne supporte pas JavaScript ou JavaScript est désactivé.',
	'MCHAT_NOMESSAGE'			=> 'Aucun message',
	'MCHAT_NOMESSAGEINPUT'		=> 'Vous n’avez pas saisi de message.',
	'MCHAT_NOSMILE'				=> 'Aucun smiley n’a été trouvé.',
	'MCHAT_NOTINSTALLED_USER'	=> 'mChat n’est pas installé. Avertissez un fondateur du forum.',
	'MCHAT_NOT_INSTALLED'		=> 'La base de données de mChat saisie est introuvable.<br/>Démarrez l’%sinstallation%s pour modifier la base de données du MOD.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'En pause',
	'MCHAT_LOAD'				=> 'Chargement',
	'MCHAT_PERMISSIONS'			=> 'Modifier les permissions des utilisateurs',
	'MCHAT_REFRESHING'			=> 'Actualisation...',
	'MCHAT_REFRESH_NO'			=> 'La mise à jour automatique est désactivée',
	'MCHAT_REFRESH_YES'			=> 'Actualisation toutes les <strong>%d</strong> secondes',
	'MCHAT_RESPOND'				=> 'Répondez à l’utilisateur',
	'MCHAT_RESET_QUESTION'		=> 'Effacer la zone de saisie?',
	'MCHAT_SESSION_OUT'			=> 'La session de tchat a expirée',
	'MCHAT_SHOW_LIST'			=> 'Afficher la liste',
	'MCHAT_SECOND'				=> 'seconde ',
	'MCHAT_SECONDS'				=> 'secondes ',
	'MCHAT_SESSION_ENDS'		=> 'La session de tchat se termine dans',
	'MCHAT_SMILES'				=> 'Smileys',
	'MCHAT_TOTALMESSAGES'		=> 'Total des messages: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Utiliser le son?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Au total, il y a <strong>%d</strong> utilisateurs qui discutent ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'Au total, il y a <strong>%d</strong> utilisateur qui discute ',
	'MCHAT_NO_CHATTERS'					=> 'Personne ne tchat',
	'MCHAT_ONLINE_EXPLAIN'				=> 'basé sur l’activité des utilisateurs depuis %s',
	'WHO_IS_CHATTING'			=> 'Qui discute ?',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'Actualisation toutes les <strong>%d</strong> secondes',
	'MCHAT_NEW_TOPIC'			=> 'Made A New Topic',
	'MCHAT_NEW_REPLY'			=> 'Made A New Reply',
	'MCHAT_NEW_QUOTE'			=> 'Replied with a Quote',
	'MCHAT_NEW_EDIT'			=> 'Made A Edit',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'Préférences du mini-chat',
	'DISPLAY_MCHAT' 	=> 'Afficher le mini-chat sur l’index.',
	'SOUND_MCHAT'		=> 'Activer le son du mini-chat.',
	'DISPLAY_STATS_INDEX'	=> 'Afficher les statistiques de &laquo; Qui discute ? &raquo; sur la page d’index.',
	'DISPLAY_NEW_TOPICS'	=> 'Afficher les nouveaux sujets dans le mini-chat.',
	'DISPLAY_AVATARS'	=> 'Afficher les avatars dans le mini-chat.',
	'CHAT_AREA'		=> 'Type de saisie',
	'CHAT_AREA_EXPLAIN'	=> 'Choisissez le type de champ à utiliser pour saisir un message :<br />Une zone de zaisie ou<br />un champ de saisie',
	'INPUT_AREA'		=> 'Champ de saisie',
	'TEXT_AREA'			=> 'Zone de zaisie',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'La table du mini-chat a été délestée',
	'ACP_USER_MCHAT'			=> 'Paramètres du mini-chat',
	'LOG_DELETED_MCHAT'		=> '<strong>Les messages de mchat ont été supprimés</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Les messages de mchat ont été édités</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Caractères restants: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Top Spammers',
	'MCHAT_NEW_CHAT'			=> 'Nouveau Message Dans Mchat!',
	'MCHAT_SEND_PM'			 => 'Envoyer un message privé',
	'MCHAT_PM'					=> '(MP)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Like This Post',
));