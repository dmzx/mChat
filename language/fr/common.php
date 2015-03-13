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
	'MCHAT_ADD'					=> 'Envoyer',
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
	'MCHAT_NEW_TOPIC'			=> '<strong>Nouveau Sujet</strong>',		
	'MCHAT_NEW_REPLY'			=> '<strong>Nouvelle réponse</strong>',	
	
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
	// ACP
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'Saisissez les règles du forum ici. Chaque règle sur une nouvelle ligne.<br/>Vous êtes limité à 255 caractères.<br/><strong>Ce message peut être traduit.</strong> (vous devez éditer le fichier mchat_lang.php et saisir les instructions).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Configuration de mChat mise à jour</strong>',
	'MCHAT_CONFIG_SAVED'			=> 'La configuration du Mini-Chat a été mise à jour.',
	'MCHAT_TITLE'					=> 'Mini-Chat',
	'MCHAT_VERSION'					=> 'Version :',
	'MCHAT_ENABLE'					=> 'Activer le MOD mChat',
	'MCHAT_ENABLE_EXPLAIN'			=> 'Activer ou désactiver le MOD dans sa globalité.',
	'MCHAT_AVATARS'					=> 'Afficher les avatars',
	'MCHAT_AVATARS_EXPLAIN'			=> 'Si activée, les avatars redimensionnés des utilisateurs seront affichés.',	
	'MCHAT_ON_INDEX'				=> 'mChat sur l’index',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'Permettre l’affichage de mChat sur la page d’index.',
	'MCHAT_INDEX_HEIGHT'			=> 'Hauteur sur la page d’index',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'La hauteur, en pixels, de mChat sur la page d’index de votre forum.<br/><em>Vous êtes limité de 50 à 1000 pixels</em>.',
	'MCHAT_LOCATION'				=> 'Emplacement sur le forum',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Choisir l’emplacement de mChat sur la page d’index.',
	'MCHAT_TOP_OF_FORUM'			=> 'En haut du forum',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'En bas du forum',
	'MCHAT_REFRESH'					=> 'Actualiser',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Nombre de secondes avant que mChat ne soit automatiquement actualisé.<br/><em>Vous êtes limité de 5 à 60 secondes</em>.',
	'MCHAT_PRUNE'					=> 'Activer le délestage',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Mettez Oui pour activer la fonction de délestage.<br/><em>Survient seulement si un utilisateur affiche les pages personnalisées ou d’archives</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Nombre de messages',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Le nombre de messages à retenir dans mChat.',	
	'MCHAT_MESSAGE_LIMIT'			=> 'Limite de messages',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Le nombre maximum de messages à afficher dans la zone du mini-chat.<br/><em>Recommandation : de 10 à 30 messages</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Limite de messages sur la page d’index',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Le nombre maximum de messages à afficher dans la zone du mini-chat sur la page d’index.<br /><em>Recommandation : de 10 à 50 messages</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Limite de l’archivage',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Le nombre maximum de messages à afficher par page dans la page d’archives.<br/><em>Recommandation : de 25 à 50 messages</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Intervalle de flood',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Le nombre de secondes qu’un utilisateur doit attendre avant de poster un autre message dans le mini-chat.<br/><em>Recommandation : de 5 à 30 secondes. Mettez 0 pour désactiver cette fonction</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Page personnalisée',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Permettre l’utilisation de la page personnalisée.',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Hauteur de la page personnalisée',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'La hauteur du mini-chat, en pixels, sur la page personnalisée de mChat.<br/><em>Vous êtes limité de 50 à 1000 pixels</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Format de la date',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'La syntaxe utilisée est identique à la fonction <a href="http://www.php.net/date">date()</a> de PHP.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Personnaliser…',
	'MCHAT_WHOIS'					=> 'Qui est-ce?',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Permettre l’affichage des utilisateurs qui discutent sur le mini-chat.',
	'MCHAT_WHOIS_REFRESH'			=> 'Actualisation du &laquo; Qui est-ce? &raquo;',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Nombre de secondes avant que les statistiques du &laquo; Qui est-ce? &raquo; ne soient actualisées.<br/><em>Vous êtes limité de 30 à 300 secondes</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Désactiver les BBcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Ici, vous pouvez saisir les BBCodes qui ne pourront <strong>pas</strong> être utilisés dans un message.<br/>Séparez les BBcodes par une barre verticale. Par exemple: <br/>b|i|u|code|list|list=|flash|quote et/ou des %sbbcodes personnalisés%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Message statique',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Ici, vous pouvez définir un message statique à afficher pour les utilisateurs du mini-chat. Le code HTML est autorisé.<br/>Mettez rien pour désactiver cet affichage. Vous êtes limité à 255 caractères.<br/><strong>Ce message peut-être traduit</strong> (vous devez éditer le fichier mchat_lang.php et saisir les instructions).',
	'MCHAT_USER_TIMEOUT'			=> 'Délai d’attente de l’utilisateur',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Configurez la durée, en secondes, jusqu’à ce qu’une session d’utilisateur se termine dans le mini-chat. Mettez 0 pour désactiver cette fonction.<br/><em>Vous êtes limité à l’%soption de configuration du forum pour les sessions%s, qui est actuellement fixée à %s secondes</em>.',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Outre-passer la limite des smileys',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Mettez sur Oui pour outre-passer les paramètres de limitation de smileys des forums pour les messages du mini-chat.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Outre-passer la limite du nombre de caractères minimal',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Mettez sur Oui pour outre-passer la limite du nombre de caractères minimal des forums, pour les messsages du mini-chat.',
	'MCHAT_NEW_POSTS'				=> 'Afficher les nouveaux messages',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Mettez sur Oui pour permettre les nouveaux sujets d’être affichés dans le mini-chat.<br/><strong>Vous devez avoir installé l’add-on de notification des nouveaux messages</strong> (qui se trouve dans le répertoire &laquo; contrib &raquo; de l’archive du MOD).',
	'MCHAT_MAIN'					=> 'Configuration principale',
	'MCHAT_STATS'					=> 'Qui discute ?',
	'MCHAT_STATS_INDEX'				=> 'Statistiques sur l’index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Affiche les membres qui discutent dans les statistiques du forum.',
	'MCHAT_MESSAGES'				=> 'Paramètres des messages',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause sur la saisie',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Si activée, le mini-chat ne sera pas mis à jour automatiquement lorsque l’utilisateur rédige un message dans la zone de saisie.',
	
	// error reporting
	'MCHAT_NEEDS_UPDATING'	=> 'Le MOD mChat a besoin d’être mis à jour. Le fondateur du forum doit visiter cette section pour commencer l’installation.',
	'MCHAT_WRONG_VERSION'	=> 'La mauvaise version du MOD est installée. Démarrez l’%sinstallation%s pour une nouvelle version du MOD.',
	'WARNING'	=> 'Attention',
	'TOO_LONG_DATE'		=> 'Le format de la date saisi est trop long.',
	'TOO_SHORT_DATE'	=> 'Le format de la date saisi est trop court.',
	'TOO_SMALL_REFRESH'	=> 'La valeur de l’actualisation est trop petite.',
	'TOO_LARGE_REFRESH'	=> 'La valeur de l’actualisation est trop importante.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'La limite de messages est trop petite.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'La limite de messages est trop grande.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'La limite de l’archive est trop petite.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'La limite de l’archive est trop grande.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Le temps de flood est trop petit.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Le temps de flood est trop grand.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'La longueur maximale des messages est trop petite.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'La longueur maximale des messages est trop grande.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'La longueur maximale des mots est trop petite.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'La longueur maximale des mots est trop grande.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'L’actualisation du Qui est-ce? es trop petite.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'L’actualisation du Qui est-ce? est trop grande.',	
	'TOO_SMALL_INDEX_HEIGHT'	=> 'La hauteur du mini-chat sur l’index est trop petite.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'La hauteur du mini-chat sur l’index est trop grande.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'La hauteur du mini-chat dans la page personnalisé est trop petite.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'La hauteur du mini-chat dans la page personnalisé est trop grande.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'Le message statique est trop court.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'Le message statique est trop long.',	
	'TOO_SMALL_TIMEOUT'	=> 'Le délai d’attente de l’utilisateur est trop petit.',
	'TOO_LARGE_TIMEOUT'	=> 'Le délai d’attente de l’utilisateur est trop grand.',
	'UCP_CAT_MCHAT'		=> 'mChat',
	'UCP_MCHAT_CONFIG'	=> 'mChat', //Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'La table du mini-chat a été délestée',
	'ACP_USER_MCHAT'			=> 'Paramètres du mini-chat',
	'LOG_DELETED_MCHAT'      => '<strong>Les messages de mchat ont été supprimés</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'      => '<strong>Les messages de mchat ont été édités</strong><br />» %1$s',	
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'   => 'Caractères restants: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'            => 'Top Spammers',
	'MCHAT_NEW_CHAT'            => 'Nouveau Message Dans Mchat!',
	'FONT_COLOR'				=> 'Couleur de fond',
	'FONT_COLOR_HIDE'			=> 'Cacher la couleur de fond',
	'FONT_HUGE'					=> 'Énorme',
	'FONT_LARGE'				=> 'Large',
	'FONT_NORMAL'				=> 'Normal',
	'FONT_SIZE'					=> 'Taille de la police',
	'FONT_SMALL'				=> 'Petite',
	'FONT_TINY'					=> 'Minuscule',
	'MCHAT_SEND_PM'             => 'Envoyer un message privé',
    'MCHAT_PM'                  => '(MP)',
	'MORE_SMILIES'              => 'Plus de smileys',
));