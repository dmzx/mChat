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

	'MCHAT_TITLE'				=> 'флудилка',
	'MCHAT_ADD'					=> 'Отправить',
	'MCHAT_IN'					=> 'в теме',
	'MCHAT_IN_SECTION'			=> '.',
	'MCHAT_LIKES'				=> 'Лайкнуть это сообщение',
	'MCHAT_ANNOUNCEMENT'		=> 'Объявление',
	'MCHAT_ARCHIVE'				=> 'Архив',
	'MCHAT_ARCHIVE_PAGE'		=> 'Архив флудилки',
	'MCHAT_BBCODES'				=> 'BB коды',
	'MCHAT_CLEAN'				=> 'Очистить',
	'MCHAT_CLEANED'				=> 'Все сообщения удалены',
	'MCHAT_CLEAR_INPUT'			=> 'Сброс',
	'MCHAT_COPYRIGHT'			=> '<a href="http://rmcgirr83.org">RMcGirr83</a> &copy; <a href="http://www.dmzx-web.net" title="www.dmzx-web.net">dmzx</a>',
	'MCHAT_CUSTOM_BBCODES'		=> 'Пользовательский BB кода',
	'MCHAT_DELALLMESS'			=> 'Удалить все сообщения?',
	'MCHAT_DELCONFIRM'			=> 'Вы подтверждаете удаление?',
	'MCHAT_DELITE'				=> 'Удалить',
	'MCHAT_EDIT'				=> 'Изменить',
	'MCHAT_EDITINFO'			=> 'Редактировать и нажать ОК',
	'MCHAT_ENABLE'				=> 'Извините, мини-чат в настоящее время недоступен',
	'MCHAT_ERROR'				=> 'Ошибка',
	'MCHAT_FLOOD'				=> 'Вы не можете отправить новое сообщение, так быстро после предыдущего',
	'MCHAT_FOE'					=> 'Это сообщение было сделано <strong>%1$s</strong> который у вас в игноре.',
	'MCHAT_HELP'				=> 'правила флудилки',
	'MCHAT_HIDE_LIST'			=> 'Hide List',
	'MCHAT_HOUR'				=> 'час ',
	'MCHAT_HOURS'				=> 'часы',
	'MCHAT_IP'					=> 'IP whois для',
	'MCHAT_MINUTE'				=> 'минута ',
	'MCHAT_MINUTES'				=> 'минуты ',
	'MCHAT_MESS_LONG'			=> 'Ваше сообщение очень большое.\nСоблюдайте лимит в %s символов',
	'MCHAT_NO_CUSTOM_PAGE'		=> 'В это время данная страница не активирована',
	'MCHAT_NO_RULES'			=> 'Страница правил временно не активна!',
	'MCHAT_NOACCESS'			=> 'Вы не имеете прав для записей во флудилке',
	'MCHAT_NOACCESS_ARCHIVE'	=> 'Вы не можете просматривать архив',
	'MCHAT_NOJAVASCRIPT'		=> 'Ваш браузер не поддерживает JavaScript или JavaScript отключен ',
	'MCHAT_NOMESSAGE'			=> 'Нет сообщений',
	'MCHAT_NOMESSAGEINPUT'		=> 'Вы ничего не написали',
	'MCHAT_NOSMILE'				=> 'Смайлов нет',
	'MCHAT_NOTINSTALLED_USER'	=> 'флудилка не установлена, сообщите основателю',
	'MCHAT_NOT_INSTALLED'		=> 'записи для флудилки отстутствуют в базе данных.<br />Запустите %sinstaller%s для внесения данных в базу.',
	'MCHAT_OK'					=> 'OK',
	'MCHAT_PAUSE'				=> 'Пауза',
	'MCHAT_LOAD'				=> 'Загрузка',
	'MCHAT_PERMISSIONS'			=> 'Изменить разрешения для пользователей',
	'MCHAT_REFRESHING'			=> 'Обновление...',
	'MCHAT_REFRESH_NO'			=> 'Автообновление отключено',
	'MCHAT_REFRESH_YES'			=> 'Автообновление каждые <strong>%d</strong> сек',
	'MCHAT_RESPOND'				=> 'ответить пользователю',
	'MCHAT_RESET_QUESTION'		=> 'Очистить область ввода?',
	'MCHAT_SESSION_OUT'			=> 'Время ожидания истекло',
	'MCHAT_SHOW_LIST'			=> 'Показать список',
	'MCHAT_SECOND'				=> 'следующий ',
	'MCHAT_SECONDS'				=> 'следующие ',
	'MCHAT_SESSION_ENDS'		=> 'Сеанс Флудилки закрывается в ',
	'MCHAT_SMILES'				=> 'Смайлы',
	'MCHAT_TOTALMESSAGES'		=> 'Всего сообщений: <strong>%s</strong>',
	'MCHAT_USESOUND'			=> 'Использовать звук?',
	'MCHAT_ONLINE_USERS_TOTAL'			=> 'Всего в чате <strong>%d</strong> пользователей ',
	'MCHAT_ONLINE_USER_TOTAL'			=> 'Всего в чате <strong>%d</strong> пользователей ',
	'MCHAT_NO_CHATTERS'					=> 'Никто не общается',
	'MCHAT_ONLINE_EXPLAIN'				=> 'основано на активности пользователей за %s',
	'WHO_IS_CHATTING'			=> 'Кто в чате',
	'WHO_IS_REFRESH_EXPLAIN'	=> 'обновляется каждые <strong>%d</strong> секунд',
	'MCHAT_NEW_TOPIC'			=> 'Новая тема',
	'MCHAT_NEW_REPLY'			=> 'новый ответ',
	'MCHAT_NEW_QUOTE'			=> 'ответ с цитированием',
	'MCHAT_NEW_EDIT'			=> 'редактирование',

	// UCP
	'UCP_PROFILE_MCHAT'	=> 'Профиль',
	'DISPLAY_MCHAT' 	=> 'Показывать флудилку',
	'SOUND_MCHAT'		=> 'Включить звук',
	'DISPLAY_STATS_INDEX'	=> 'Показывать кто в основном чате',
	'DISPLAY_NEW_TOPICS'	=> 'Отображение новых тем в чате',
	'DISPLAY_AVATARS'	=> 'Показать аватары в чате',
	'CHAT_AREA'		=> 'Тип входа',
	'CHAT_AREA_EXPLAIN'	=> 'Выберите тип использования чата:<br />текстовую область or<br />или входящих',
	'INPUT_AREA'		=> 'Область ввода ',
	'TEXT_AREA'			=> 'Область текста ',
	'UCP_CAT_MCHAT'		=> 'Флудилка ',
	'UCP_MCHAT_CONFIG'	=> 'Флудилка ',

	//Preferences
	'LOG_MCHAT_TABLE_PRUNED'	=> 'флудилка сокрашена',
	'ACP_USER_MCHAT'			=> 'Настройки',
	'LOG_DELETED_MCHAT'		=> '<strong>Удалять сообщения чата </strong><br />» %1$s',
	'LOG_EDITED_MCHAT'		=> '<strong>Редактировать сообщения чата</strong><br />» %1$s',
	'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> 'Осталось символов: <span class="charsLeft error"><strong>%d</strong></span>',
	'MCHAT_TOP_POSTERS'			=> 'Топ спамеры',
	'MCHAT_NEW_CHAT'			=> 'Новые сообщения!',
	'MCHAT_SEND_PM'			 => 'Отправить личное сообщение',
	'MCHAT_PM'					=> '(ЛС)',

	//Custom edits
	'REPLY_WITH_LIKE'		=>'Лайкнуть это сообщение',
	));