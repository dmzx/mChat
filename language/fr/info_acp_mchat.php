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
	'ACP_MCHAT_CONFIG'				=> 'Configuration',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Mini-Chat',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Un mini-chat (aka “shout box”) pour votre forum',
	'MCHAT_TABLE_DELETED'			=> 'La table mChat a été supprimée',
	'MCHAT_TABLE_CREATED'			=> 'La table mChat a été créée',
	'MCHAT_TABLE_UPDATED'			=> 'La table mChat a été mise à jour',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Rien à faire....poursuivre',
	'UCP_CAT_MCHAT'					=> 'Préférences de mChat',
	'UCP_MCHAT_CONFIG'				=> 'Préférences de l’utilisateur de mChat',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Règles',
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
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Longueur maximale des messages',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Le nombre maximum de caractères autorisés par message posté.<br/><em>Recommandation : de 100 à 500 caractères. Mettez 0 pour désactiver cette fonction</em>.',
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
	'MCHAT_NEW_POSTS'				=> 'Activer l’affichage des messages',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Mettre sur oui et vous pouvez définir dans les options ci-dessous, quel message doit être affiché dans mchat.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Afficher un nouveau sujet Messages',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Mettre sur oui pour autoriser les nouveaux sujets messages du forum qui seront affichées dans mchat.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Activer les nouvelles réponses',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Mettre sur oui pour permettre les nouvelles réponses a afficher dans mchat.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Afficher les messages édités',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Mettre sur oui pour autoriser les messages édités depuis le forum a être affichés dans mchat.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Afficher les messages cités',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Mettre sur oui pour autoriser les messages cités depuis le forum a être affichés dans mchat.',
	'MCHAT_MAIN'					=> 'Configuration principale',
	'MCHAT_STATS'					=> 'Qui discute ?',
	'MCHAT_STATS_INDEX'				=> 'Statistiques sur l’index',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Affiche les membres qui discutent dans les statistiques du forum.',
	'MCHAT_MESSAGE_TOP'				=> 'Keep message on Bottom / Top',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'This will post the message bottom or top in the chat message area.',
	'MCHAT_BOTTOM'					=> 'Bottom',
	'MCHAT_TOP'						=> 'Top',
	'MCHAT_MESSAGES'				=> 'Paramètres des messages',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Pause sur la saisie',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Si activée, le mini-chat ne sera pas mis à jour automatiquement lorsque l’utilisateur rédige un message dans la zone de saisie.',

	// error reporting
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

		// User perms
	'ACL_U_MCHAT_USE'			=> 'Peut utiliser mChat',
	'ACL_U_MCHAT_VIEW'			=> 'Peut voir mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Peut éditer les messages de mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Peut supprimer les messages de mChat',
	'ACL_U_MCHAT_IP'			=> 'Peut voir les adresses IP sur mChat',
	'ACL_U_MCHAT_PM'			=> 'Peut utiliser les messages privés dans mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Peut utiliser la fonction aimer un message dans mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Peut citer dans mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Peut ignorer le flood sur mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Peut voir les archives',
	'ACL_U_MCHAT_BBCODE'		=> 'Peut utiliser le BBCode sur mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Peut utiliser les smileys sur mChat',
	'ACL_U_MCHAT_URLS'			=> 'Peut poster des url’s sur mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Peut gérer les paramètres de mChat',

));