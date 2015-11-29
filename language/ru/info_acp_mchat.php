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
	'ACP_MCHAT_CONFIG'				=> 'Конфигурация',
	'ACP_CAT_MCHAT'					=> 'mChat',
	'ACP_MCHAT_TITLE'				=> 'Флудилка',
	'ACP_MCHAT_TITLE_EXPLAIN'		=> 'Чат (как “кричалка”) для вашего форума',
	'MCHAT_TABLE_DELETED'			=> 'Таблицы mChat были успешно удалены',
	'MCHAT_TABLE_CREATED'			=> 'Таблицы mChat были успешно Созданы',
	'MCHAT_TABLE_UPDATED'			=> 'Таблицы mChat были успешно Обновлены',
	'MCHAT_NOTHING_TO_UPDATE'		=> 'Ничего не делайте....процесс идёт',
	'UCP_CAT_MCHAT'					=> 'mChat Настройки',
	'UCP_MCHAT_CONFIG'				=> 'настройки пользователей mChat',

	// ACP entries
	'ACP_MCHAT_RULES'				=> 'Правила',
	'ACP_MCHAT_RULES_EXPLAIN'		=> 'введите Правила форума здесь. Каждое правило с новой строки.<br />Вы ограничены 255 символами.<br /><strong>это сообщение можно перевести.</strong> (вы должны отредактировать mchat_lang.php файл и прочитать инструкцию).',
	'LOG_MCHAT_CONFIG_UPDATE'		=> '<strong>Обновить конфигурацию mChat </strong>',
	'MCHAT_CONFIG_SAVED'			=> 'конфигурация флудилки была обновлена',
	'MCHAT_TITLE'					=> 'Флудилка',
	'MCHAT_VERSION'					=> 'Версия:',
	'MCHAT_ENABLE'					=> 'Включить mChat расширение',
	'MCHAT_ENABLE_EXPLAIN'			=> 'включить или отключить расширение на глобальном уровне.',
	'MCHAT_AVATARS'					=> 'отображать аватары',
	'MCHAT_AVATARS_EXPLAIN'			=> 'если установлено "да", изменения аватары пользователей будут отображаться',
	'MCHAT_ON_INDEX'				=> 'mChat на Главной',
	'MCHAT_ON_INDEX_EXPLAIN'		=> 'разрешить отображение mChat на Главной странице.',
	'MCHAT_INDEX_HEIGHT'			=> 'Высота главной страницы',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'	=> 'Высота окна чата в пикселях на главной странице форума.<br /><em>Ограничение 50 до 1000</em>.',
	'MCHAT_LOCATION'				=> 'Адрес на форуме',
	'MCHAT_LOCATION_EXPLAIN'		=> 'Выберите расположение mChat на главной странице .',
	'MCHAT_TOP_OF_FORUM'			=> 'Верх форума',
	'MCHAT_BOTTOM_OF_FORUM'			=> 'Низ форума',
	'MCHAT_REFRESH'					=> 'Обновить',
	'MCHAT_REFRESH_EXPLAIN'			=> 'Количество секунд, через которое чат автоматически обновляется..<br /><em>от 5 до 60 секунд</em>.',
	'MCHAT_PRUNE'					=> 'Включить сокращения',
	'MCHAT_PRUNE_EXPLAIN'			=> 'Установите Да, чтобы включить функцию сокращения.<br /><em>OВозможно при просмотре пользовательских либо архивных страниц</em>.',
	'MCHAT_PRUNE_NUM'				=> 'Количество сообщений',
	'MCHAT_PRUNE_NUM_EXPLAIN'		=> 'Количество сообщений, сохраняемых в чате.',
	'MCHAT_MESSAGE_LIMIT'			=> 'Лимит сообщений',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'	=> 'Максимальное количество сообщений, отображаемых в области чата.<br /><em>Рекомендуется от 10 до 30</em>.',
	'MCHAT_MESSAGE_NUM'				=> 'Лимит сообщений на главной странице',
	'MCHAT_MESSAGE_NUM_EXPLAIN'	=> 'Максимальное количество сообщений, отображаемых в области чата на главной странице форума.<br /><em>Рекомендуется от 10 до 50</em>.',
	'MCHAT_ARCHIVE_LIMIT'			=> 'Лимит архива',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'	=> 'Максимальное количество сообщений, отображаемых на архивной странице.<br /> <em>Рекомендуется от 25 до 50</em>.',
	'MCHAT_FLOOD_TIME'				=> 'Флуд таймер',
	'MCHAT_FLOOD_TIME_EXPLAIN'		=> 'Количество секунд которое пользователь должен ждать, прежде чем отправлять другое сообщение в чате.<br /><em>Рекомендуется от 5 до 30, Установите 0 чтобы выключить</em>.',
	'MCHAT_MAX_MESSAGE_LENGTH'			=> 'Максимальная длина сообщения',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'	=> 'Максимальное количество символов, разрешенных в сообщении ответа.<br /><em>Рекомендуется от 100 до 500, установите 0 чтоб снять ограничения</em>.',
	'MCHAT_CUSTOM_PAGE'				=> 'Пользовательские страницы',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'		=> 'Разрешить использование пользовательских страниц',
	'MCHAT_CUSTOM_HEIGHT'			=> 'Высота пользовательской страницы',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'	=> 'Высота окна чата в пикселях на отдельной странице mChat.<br /><em>Лимит от 50 до 1000</em>.',
	'MCHAT_DATE_FORMAT'				=> 'Формат даты',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Синтаксис идентичен РНР <a href="http://www.php.net/date">date()</a> function.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Дополнительно…',
	'MCHAT_WHOIS'					=> 'О пользователе',
	'MCHAT_WHOIS_EXPLAIN'			=> 'Разрешить отображение пользователей, которые в чате',
	'MCHAT_WHOIS_REFRESH'			=> 'Обновление подробностей о пользователе',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> 'Количество секунд Обновления подробностей о пользователе <br /><em>Лимит от 30 до 300 сек</em>.',
	'MCHAT_BBCODES_DISALLOWED'		=> 'Запрещенные BB коды',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'	=> 'Здесь вы можете ввести BBCodes, которые <strong>не</strong> используются в сообщениях.<br />Отдельные BBCodes с вертикальной чертой, например: <br />b|i|u|code|list|list=|flash|quote и/или a %scustom bbcode tag name%s',
	'MCHAT_STATIC_MESSAGE'			=> 'Статические сообщения',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'	=> 'Здесь вы можете определить статические сообщения отображаемые для пользователей чата.	HTML-код доступен.<br />Очистите чтоб отключить отображение.	Лимит 255 символов.<br /><strong>Это сообщение может быть переведено.</strong>	(Вы должны отредактировать файл mchat_lang.php согласно инструкции).',
	'MCHAT_USER_TIMEOUT'			=> 'Время ожидания пользователя',
	'MCHAT_USER_TIMEOUT_EXPLAIN'	=> 'Установите количество времени, в секундах, пока сессия пользователи в чате не заканчивается. Установите 0 чтоб не использовать.<br /><em>Ваш лимит %s в настройках форума %s сейчас %s сек</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'	=> 'Ограничение числа смайлов в сообщении',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Установите для ограничения количества смайлов для чата',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'	=> 'Установить минимальное число символов в сообщении',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Установите ДА если значения минимального количества символов для чата и форума разное',
	'MCHAT_NEW_POSTS'				=> 'Включить отображение сообщений',
	'MCHAT_NEW_POSTS_EXPLAIN'		=> 'Нажмите ДА чтоб сообщения форума, отображались в чате.',
	'MCHAT_NEW_POSTS_TOPIC'				=> 'Отображать о новых темах',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'		=> 'Нажмите ДА, для отображения новых тем форума в чате.',
	'MCHAT_NEW_POSTS_REPLY'				=> 'Отображать ответы',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'		=> 'Нажмите ДА, для отображения форумных ответов в чате.',
	'MCHAT_NEW_POSTS_EDIT'				=> 'Отображать редактирование сообщений',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'		=> 'Нажмите ДА, для отображения редактируемых сообщений в чате.',
	'MCHAT_NEW_POSTS_QUOTE'				=> 'Отображать цитируемые сообщения',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'		=> 'Нажмите ДА, для отображения форумных ответов с цитатами в чате.',
	'MCHAT_MAIN'					=> 'Основная конфигурация',
	'MCHAT_STATS'					=> 'Подробности в чате',
	'MCHAT_STATS_INDEX'				=> 'Информация на главной странице',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Показать, кто в чате с учётом посетителей флудилки',
	'MCHAT_MESSAGE_TOP'				=> 'Отображать сообщения вверху или внизу',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Настройка отображения последнего сообщения сверху или снизу чата.',
	'MCHAT_BOTTOM'					=> 'Внизу',
	'MCHAT_TOP'						=> 'Вверху',
	'MCHAT_MESSAGES'				=> 'Настройка сообщений',
	'MCHAT_PAUSE_ON_INPUT'			=> 'Пауза при вводе',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'	=> 'Если установленно Да, то чат будет не обновлятся автоматически если пользователь начал писать сообщение',

	// error reporting
	'TOO_LONG_DATE'		=> 'Формат даты слишком длинный.',
	'TOO_SHORT_DATE'	=> 'Формат даты слишком короткий.',
	'TOO_SMALL_REFRESH'	=> 'Значение обновления слишком мало.',
	'TOO_LARGE_REFRESH'	=> 'Значение обновления слишком большое.',
	'TOO_SMALL_MESSAGE_LIMIT'	=> 'Ограничение сообщение значение слишком мало.',
	'TOO_LARGE_MESSAGE_LIMIT'	=> 'Ограничение сообщение значение слишком велико.',
	'TOO_SMALL_ARCHIVE_LIMIT'	=> 'Ограничение Архив значение слишком мало.',
	'TOO_LARGE_ARCHIVE_LIMIT'	=> 'Ограничение Архив значение слишком большое.',
	'TOO_SMALL_FLOOD_TIME'	=> 'Значение времени флуда мало.',
	'TOO_LARGE_FLOOD_TIME'	=> 'Значение времени флуда велико.',
	'TOO_SMALL_MAX_MESSAGE_LNGTH'	=> 'Максимальное значение длины сообщение слишком мало.',
	'TOO_LARGE_MAX_MESSAGE_LNGTH'	=> 'Максимальное значение длины сообщение слишком большое.',
	'TOO_SMALL_MAX_WORDS_LNGTH'	=> 'Максимальное значение длины слова слишком мало.',
	'TOO_LARGE_MAX_WORDS_LNGTH'	=> 'Максимальное значение длины слова слишком большое.',
	'TOO_SMALL_WHOIS_REFRESH'	=> 'Значение Whois обновления слишком мало.',
	'TOO_LARGE_WHOIS_REFRESH'	=> 'Значение Whois обновления слишком большое.',
	'TOO_SMALL_INDEX_HEIGHT'	=> 'Значение высоты на главной мало.',
	'TOO_LARGE_INDEX_HEIGHT'	=> 'Значение высоты на главной велико.',
	'TOO_SMALL_CUSTOM_HEIGHT'	=> 'The custom height value is too small.',
	'TOO_LARGE_CUSTOM_HEIGHT'	=> 'The custom height value is too large.',
	'TOO_SHORT_STATIC_MESSAGE'	=> 'статическое значение сообщения слишком короткое.',
	'TOO_LONG_STATIC_MESSAGE'	=> 'статическое значение сообщения слишком длинное.',
	'TOO_SMALL_TIMEOUT'	=> 'значение тайм-аута пользователя слишком мал.',
	'TOO_LARGE_TIMEOUT'	=> 'значение тайм-аута пользователя слишком большой.',

	// User perms
	'ACL_U_MCHAT_USE'			=> 'Можно использовать mChat',
	'ACL_U_MCHAT_VIEW'			=> ' Можно просматривать mChat',
	'ACL_U_MCHAT_EDIT'			=> 'Может редактировать сообщения mChat',
	'ACL_U_MCHAT_DELETE'		=> 'Может удалить mChat сообщения',
	'ACL_U_MCHAT_IP'			=> 'Можно видеть mChat IP-адреса',
	'ACL_U_MCHAT_PM'			=> 'Можно использовать личное сообщение mChat',
	'ACL_U_MCHAT_LIKE'			=> 'Можно использовать, как сообщения в mChat',
	'ACL_U_MCHAT_QUOTE'			=> 'Можно использовать кавычки сообщение mChat',
	'ACL_U_MCHAT_FLOOD_IGNORE'	=> 'Может игнорировать флуд контроль mChat',
	'ACL_U_MCHAT_ARCHIVE'		=> 'Может просматривать Архив mChat',
	'ACL_U_MCHAT_BBCODE'		=> 'Можно использовать BBCode в mChat',
	'ACL_U_MCHAT_SMILIES'		=> 'Можно использовать смайлики в mChat',
	'ACL_U_MCHAT_URLS'			=> 'Может создавать URL-адреса в mChat',

	// Admin perms
	'ACL_A_MCHAT'				=> 'Может управлять настройками mChat',

));