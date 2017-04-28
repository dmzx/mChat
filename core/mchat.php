<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

use phpbb\auth\auth;
use phpbb\collapsiblecategories\operator\operator as cc_operator;
use phpbb\controller\helper;
use phpbb\event\dispatcher_interface;
use phpbb\exception\http_exception;
use phpbb\extension\manager;
use phpbb\pagination;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb\textformatter\parser_interface;
use phpbb\user;
use Symfony\Component\HttpFoundation\JsonResponse;

class mchat
{
	/** @var functions */
	protected $functions;

	/** @var settings */
	protected $settings;

	/** @var helper */
	protected $helper;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var auth */
	protected $auth;

	/** @var pagination */
	protected $pagination;

	/** @var request_interface */
	protected $request;

	/** @var dispatcher_interface */
	protected $dispatcher;

	/** @var manager */
	protected $extension_manager;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/** @var parser_interface */
	protected $parser;

	/** @var cc_operator */
	protected $cc_operator;

	/** @var boolean */
	protected $remove_disallowed_bbcodes = false;

	/** @var array */
	protected $active_users = null;

	/** @var array */
	protected $foes = null;

	/**
	 * Constructor
	 *
	 * @param functions				$functions
	 * @param settings				$settings
	 * @param helper				$helper
	 * @param template				$template
	 * @param user					$user
	 * @param auth					$auth
	 * @param pagination			$pagination
	 * @param request_interface		$request
	 * @param dispatcher_interface	$dispatcher
	 * @param manager				$extension_manager
	 * @param string				$root_path
	 * @param string				$php_ext
	 * @param parser_interface		$parser
	 * @param cc_operator			$cc_operator
	 */
	public function __construct(
		functions $functions,
		settings $settings,
		helper $helper,
		template $template,
		user $user,
		auth $auth,
		pagination $pagination,
		request_interface $request,
		dispatcher_interface $dispatcher,
		manager $extension_manager,
		$root_path,
		$php_ext,
		parser_interface $parser = null,
		cc_operator $cc_operator = null
	)
	{
		$this->functions			= $functions;
		$this->settings				= $settings;
		$this->helper				= $helper;
		$this->template				= $template;
		$this->user					= $user;
		$this->auth					= $auth;
		$this->pagination			= $pagination;
		$this->request				= $request;
		$this->dispatcher			= $dispatcher;
		$this->extension_manager	= $extension_manager;
		$this->root_path			= $root_path;
		$this->php_ext				= $php_ext;
		$this->parser				= $parser;
		$this->cc_operator			= $cc_operator;

		$this->template->assign_vars(array(
			'IS_PHPBB31' => $this->settings->is_phpbb31,
			'IS_PHPBB32' => $this->settings->is_phpbb32,
		));
	}

	/**
	 * Render mChat on the index page
	 */
	public function page_index()
	{
		if (!$this->auth->acl_get('u_mchat_view'))
		{
			return;
		}

		$this->assign_whois();

		if (!$this->settings->cfg('mchat_index'))
		{
			return;
		}

		$this->user->add_lang_ext('dmzx/mchat', 'mchat');

		$this->assign_bbcodes_smilies();

		$this->render_page('index');

		$this->template->assign_var('MCHAT_IS_INDEX', true);
	}

	/**
	 * Render the mChat custom page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function page_custom()
	{
		if (!$this->auth->acl_get('u_mchat_view'))
		{
			if (!$this->user->data['is_registered'])
			{
				login_box();
			}

			throw new http_exception(403, 'NOT_AUTHORISED');
		}

		$this->user->add_lang_ext('dmzx/mchat', 'mchat');

		if (!$this->settings->cfg('mchat_custom_page'))
		{
			throw new http_exception(404, 'MCHAT_NO_CUSTOM_PAGE');
		}

		$this->functions->mchat_add_user_session();

		$this->assign_whois();

		$this->assign_bbcodes_smilies();

		$this->template->assign_var('MCHAT_IS_CUSTOM_PAGE', true);

		$this->render_page('custom');

		// Add to navlinks
		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->user->lang('MCHAT_TITLE'),
			'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_page_custom_controller'),
		));

		return $this->helper->render('mchat_body.html', $this->user->lang('MCHAT_TITLE'));
	}

	/**
	 * Render the mChat archive
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function page_archive()
	{
		$this->user->add_lang_ext('dmzx/mchat', 'mchat');

		if (!$this->auth->acl_get('u_mchat_view') || !$this->auth->acl_get('u_mchat_archive'))
		{
			if (!$this->user->data['is_registered'])
			{
				login_box();
			}

			throw new http_exception(403, 'MCHAT_NOACCESS_ARCHIVE');
		}

		$this->template->assign_var('MCHAT_IS_ARCHIVE_PAGE', true);

		$this->render_page('archive');

		// Add to navlinks
		$this->template->assign_block_vars_array('navlinks', array(
			array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_TITLE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_page_custom_controller'),
			),
			array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_ARCHIVE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_page_archive_controller'),
			),
		));

		return $this->helper->render('mchat_body.html', $this->user->lang('MCHAT_ARCHIVE_PAGE'));
	}

	/**
	 * Controller for mChat IP WHOIS
	 *
	 * @param string $ip
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function page_whois($ip)
	{
		if (!$this->auth->acl_get('u_mchat_ip'))
		{
			if (!$this->user->data['is_registered'])
			{
				login_box();
			}

			throw new http_exception(403, 'NOT_AUTHORISED');
		}

		$this->user->add_lang_ext('dmzx/mchat', 'mchat');

		if (!function_exists('user_ipwhois'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$this->template->assign_var('WHOIS', user_ipwhois($ip));

		return $this->helper->render('viewonline_whois.html', $this->user->lang('WHO_IS_ONLINE'));
	}

	/**
	 * Controller for mChat Rules page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function page_rules()
	{
		if (!$this->auth->acl_get('u_mchat_view'))
		{
			if (!$this->user->data['is_registered'])
			{
				login_box();
			}

			throw new http_exception(403, 'NOT_AUTHORISED');
		}

		$this->user->add_lang_ext('dmzx/mchat', 'mchat');

		$lang_rules = $this->user->lang('MCHAT_RULES_MESSAGE');

		if (!$this->settings->cfg('mchat_rules') && !$lang_rules)
		{
			throw new http_exception(404, 'MCHAT_NO_RULES');
		}

		// If the rules are defined in the language file use them, else just use the entry in the database
		$mchat_rules = $lang_rules ?: $this->settings->cfg('mchat_rules');
		$mchat_rules = htmlspecialchars_decode($mchat_rules);
		$mchat_rules = str_replace("\n", '<br />', $mchat_rules);

		$this->template->assign_var('MCHAT_RULES', $mchat_rules);

		return $this->helper->render('mchat_rules.html', $this->user->lang('MCHAT_RULES'));
	}

	/**
	 * Initialize AJAX action
	 *
	 * @param string $permission Permission that is required to perform the current action
	 * @param bool $check_form_key
	 */
	protected function init_action($permission, $check_form_key = true)
	{
		if (!$this->request->is_ajax() || !$this->auth->acl_get($permission) || ($check_form_key && !check_form_key('mchat', -1)))
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		// Fix avatars & smilies
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}

		$this->user->add_lang_ext('dmzx/mchat', 'mchat');
	}

	/**
	 * User submits a message
	 *
	 * @param bool $return_raw
	 * @return array data sent to client as JSON
	 */
	public function action_add($return_raw = false)
	{
		$this->init_action('u_mchat_use');

		if ($this->functions->mchat_is_user_flooding())
		{
			throw new http_exception(400, 'MCHAT_FLOOD');
		}

		$message = $this->request->variable('message', '', true);

		if ($this->settings->cfg('mchat_capital_letter'))
		{
			$message = utf8_ucfirst($message);
		}

		$message_data = $this->process_message($message);

		$message_data = array_merge($message_data, array(
			'user_id'		=> $this->user->data['user_id'],
			'user_ip'		=> $this->user->data['session_ip'],
			'message_time'	=> time(),
		));

		/**
		 * Event to modify a new message before it is inserted in the database
		 *
		 * @event dmzx.mchat.action_add_before
		 * @var	string	message			The message that is about to be processed and added to the database
		 * @var array	message_data	Array containing additional information that is added to the database
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'message',
			'message_data',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_add_before', compact($vars)));

		$is_new_session = $this->functions->mchat_action('add', $message_data);

		$response = $this->action_refresh(true);

		if ($is_new_session)
		{
			$response = array_merge($response, $this->action_whois(true));
		}

		/**
		 * Event to modify message data of a user's new message before it is sent back to the user
		 *
		 * @event dmzx.mchat.action_add_after
		 * @var	string	message			The message that was added to the database
		 * @var array	message_data	Array containing additional information that was added to the database
		 * @var bool	is_new_session	Indicating whether the message triggered a new mChat session to be created for the user
		 * @var array	response		The data that is sent back to the user
		 * @var boolean	return_raw		Whether to return a raw array or a JsonResponse object
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'message',
			'message_data',
			'is_new_session',
			'response',
			'return_raw',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_add_after', compact($vars)));

		return $return_raw ? $response : new JsonResponse($response);
	}

	/**
	 * User edits a message
	 *
	 * @param bool $return_raw
	 * @return array data sent to client as JSON
	 */
	public function action_edit($return_raw = false)
	{
		$this->init_action('u_mchat_use');

		$message_id = $this->request->variable('message_id', 0);

		if (!$message_id)
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		$author = $this->functions->mchat_author_for_message($message_id);

		if (!$author)
		{
			throw new http_exception(410, 'MCHAT_MESSAGE_DELETED');
		}

		// If post_id is not 0 it's a notification and notifications can't be edited
		if ($author['post_id'] || !$this->auth_message('edit', $author['user_id'], $author['message_time']))
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		$this->template->assign_var('MCHAT_IS_ARCHIVE_PAGE', $this->request->variable('archive', false));

		$message = $this->request->variable('message', '', true);
		$sql_ary = $this->process_message($message);
		$this->functions->mchat_action('edit', $sql_ary, $message_id);

		$rows = $this->functions->mchat_get_messages($message_id);

		$this->assign_global_template_data();
		$this->assign_messages($rows);

		$response = array('edit' => $this->render_template('mchat_messages.html'));

		/**
		 * Event to modify the data of an edited message
		 *
		 * @event dmzx.mchat.action_edit_after
		 * @var int		message_id	The ID of the edited message
		 * @var	string	message		The content of the edited message that was added to the database
		 * @var array	author		Information about the message author
		 * @var array	response	The data that is sent back to the user
		 * @var boolean	return_raw	Whether to return a raw array or a JsonResponse object
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'message_id',
			'message',
			'author',
			'response',
			'return_raw',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_edit_after', compact($vars)));

		return $return_raw ? $response : new JsonResponse($response);
	}

	/**
	 * User deletes a message
	 *
	 * @param bool $return_raw
	 * @return array data sent to client as JSON
	 */
	public function action_del($return_raw = false)
	{
		$this->init_action('u_mchat_use');

		$message_id = $this->request->variable('message_id', 0);

		if (!$message_id)
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		$author = $this->functions->mchat_author_for_message($message_id);

		if (!$author)
		{
			throw new http_exception(410, 'MCHAT_MESSAGE_DELETED');
		}

		if (!$this->auth_message('delete', $author['user_id'], $author['message_time']))
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		$this->functions->mchat_action('del', null, $message_id);

		$response = array('del' => true);

		/**
		 * Event that is triggered after an mChat message was deleted
		 *
		 * @event dmzx.mchat.action_delete_after
		 * @var int		message_id	The ID of the deleted message
		 * @var array	author		Information about the message author
		 * @var array	response	The data that is sent back to the user
		 * @var boolean	return_raw	Whether to return a raw array or a JsonResponse object
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'message_id',
			'author',
			'response',
			'return_raw',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_delete_after', compact($vars)));

		return $return_raw ? $response : new JsonResponse($response);
	}

	/**
	 * User checks for new messages
	 *
	 * @param bool $return_raw
	 * @return array sent to client as JSON
	 */
	public function action_refresh($return_raw = false)
	{
		$this->init_action('u_mchat_view', false);

		// Keep the session alive forever if there is no session timeout
		$keep_session_alive = !$this->settings->cfg('mchat_timeout');

		// Whether to check the log table for new entries
		$need_log_update = $this->settings->cfg('mchat_live_updates');

		/**
		 * Event that is triggered before new mChat messages are checked
		 *
		 * @event dmzx.mchat.action_refresh_before
		 * @var bool	keep_session_alive	Whether to the user's phpBB session
		 * @var bool	need_log_update		Whether to check the log table for new entries
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'keep_session_alive',
			'need_log_update',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_refresh_before', compact($vars)));

		if ($keep_session_alive)
		{
			$this->user->update_session_infos();
		}

		$response = array('refresh' => true);
		$log_edit_del_ids = array(
			'edit'	=> array(),
			'del'	=> array(),
		);

		if ($need_log_update)
		{
			$log_id = $this->request->variable('log', 0);
			$log_rows = $this->functions->mchat_get_logs($log_id);

			$response['log'] = $log_rows['id'];
			unset($log_rows['id']);

			$edit_delete_limit = $this->settings->cfg('mchat_edit_delete_limit');
			$time_limit = $edit_delete_limit ? time() - $edit_delete_limit : 0;

			foreach ($log_rows as $log_row)
			{
				$log_type = $log_row['log_type'];

				if (isset($this->functions->log_types[$log_type]))
				{
					if ($log_row['user_id'] != $this->user->data['user_id'] && $log_row['log_time'] > $time_limit)
					{
						$log_type_name = $this->functions->log_types[$log_type];
						$log_edit_del_ids[$log_type_name][] = (int) $log_row['message_id'];
					}
				}

				/**
				 * Event that allows processing log messages
				 *
				 * @event dmzx.mchat.action_refresh_process_log_row
				 * @var array	response	The data that is sent back to the user (still incomplete at this point)
				 * @var array	log_row		The log data
				 * @since 2.0.0-RC6
				 */
				$vars = array(
					'response',
					'log_row',
				);
				extract($this->dispatcher->trigger_event('dmzx.mchat.action_refresh_process_log_row', compact($vars)));
			}
		}

		$last_id = $this->request->variable('last', 0);
		$total = 0;
		$offset = 0;

		/**
		 * Event that allows modifying data before new mChat messages are fetched
		 *
		 * @event dmzx.mchat.action_refresh_get_messages_before
		 * @var array	response			The data that is sent back to the user (still incomplete at this point)
		 * @var array	log_edit_del_ids	An array containing IDs of messages that have been edited or deleted since the user's last refresh
		 * @var int		last_id				The latest message that the user has
		 * @var int		total				Limit the number of messages to fetch
		 * @var int		offset				The number of messages to skip
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'response',
			'log_edit_del_ids',
			'last_id',
			'total',
			'offset',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_refresh_get_messages_before', compact($vars)));

		$rows = $this->functions->mchat_get_messages($log_edit_del_ids['edit'], $last_id, $total, $offset);
		$rows_refresh = array();
		$rows_edit = array();

		foreach ($rows as $row)
		{
			if ($row['message_id'] > $last_id)
			{
				$rows_refresh[] = $row;
			}
			else if (in_array($row['message_id'], $log_edit_del_ids['edit']))
			{
				$rows_edit[] = $row;
			}
		}

		if ($rows_refresh || $rows_edit)
		{
			$this->assign_global_template_data();
		}

		// Assign new messages
		if ($rows_refresh)
		{
			$this->assign_messages($rows_refresh);
			$response['add'] = $this->render_template('mchat_messages.html');
		}

		// Assign edited messages
		if ($rows_edit)
		{
			$this->assign_messages($rows_edit);
			$response['edit'] = $this->render_template('mchat_messages.html');
		}

		// Assign deleted messages
		if ($log_edit_del_ids['del'])
		{
			$response['del'] = $log_edit_del_ids['del'];
		}

		/**
		 * Event to modify the data that is sent to the user after checking for new mChat message
		 *
		 * @event dmzx.mchat.action_refresh_after
		 * @var array	rows		The rows that where fetched from the database
		 * @var array	response	The data that is sent back to the user
		 * @var boolean	return_raw	Whether to return a raw array or a JsonResponse object
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'rows',
			'response',
			'return_raw',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_refresh_after', compact($vars)));

		return $return_raw ? $response : new JsonResponse($response);
	}

	/**
	 * User requests who is chatting
	 *
	 * @param bool $return_raw
	 * @return array data sent to client as JSON
	 */
	public function action_whois($return_raw = false)
	{
		$this->init_action('u_mchat_view', false);

		$this->assign_whois();

		$response = array('whois' => $this->render_template('mchat_whois.html'));

		if ($this->settings->cfg('mchat_navbar_link_count') && $this->settings->cfg('mchat_navbar_link') && $this->settings->cfg('mchat_custom_page') && $this->active_users)
		{
			$response['navlink'] = $this->active_users['users_count_title'];
			$response['navlink_title'] = strip_tags($this->active_users['users_total']);
		}

		/**
		 * Event to modify the result of the Who Is Online update
		 *
		 * @event dmzx.mchat.action_whois_after
		 * @var array	response	The data that is sent back to the user
		 * @var boolean	return_raw	Whether to return a raw array or a JsonResponse object
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'response',
			'return_raw',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.action_whois_after', compact($vars)));

		return $return_raw ? $response : new JsonResponse($response);
	}

	/**
	 * Adds the template variables for the header link
	 */
	public function render_page_header_link()
	{
		if (!$this->auth->acl_get('u_mchat_view'))
		{
			return;
		}

		$navbar_link = $this->settings->cfg('mchat_navbar_link');
		$custom_page = $this->settings->cfg('mchat_custom_page');

		$template_data = array(
			'MCHAT_NAVBAR_LINK'	=> $navbar_link,
			'MCHAT_CUSTOM_PAGE'	=> $custom_page,
			'MCHAT_TITLE'		=> $this->user->lang('MCHAT_TITLE'),
			'MCHAT_TITLE_HINT'	=> $this->user->lang('MCHAT_TITLE'),
			'U_MCHAT'			=> $this->helper->route('dmzx_mchat_page_custom_controller'),
		);

		if ($navbar_link && $custom_page && $this->settings->cfg('mchat_navbar_link_count'))
		{
			if ($this->active_users === null)
			{
				$this->active_users = $this->functions->mchat_active_users();
			}

			$template_data['MCHAT_TITLE'] = $this->active_users['users_count_title'];
			$template_data['MCHAT_TITLE_HINT'] = strip_tags($this->active_users['users_total']);
		}

		$this->template->assign_vars($template_data);
	}

	/**
	 * Renders data for a page
	 *
	 * @param string $page The page we are rendering for, one of index|custom|archive
	 */
	protected function render_page($page)
	{
		/**
		 * Event that is triggered before mChat is rendered
		 *
		 * @event dmzx.mchat.render_page_before
		 * @var string	page	The page that is rendered, one of index|custom|archive
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'page',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.render_page_before', compact($vars)));

		// Add lang file
		$this->user->add_lang('posting');

		// If the static message is defined in the language file use it, else the entry in the database is used
		$lang_static_message = $this->user->lang('MCHAT_STATIC_MESSAGE');
		$static_message = $lang_static_message ?: $this->settings->cfg('mchat_static_message');

		$this->template->assign_vars(array(
			'MCHAT_PAGE'					=> $page,
			'MCHAT_ALLOW_SMILES'			=> $this->settings->cfg('allow_smilies') && $this->auth->acl_get('u_mchat_smilies'),
			'MCHAT_INPUT_AREA'				=> $this->settings->cfg('mchat_input_area'),
			'MCHAT_MESSAGE_TOP'				=> $this->settings->cfg('mchat_message_top'),
			'MCHAT_INDEX_HEIGHT'			=> $this->settings->cfg('mchat_index_height'),
			'MCHAT_CUSTOM_HEIGHT'			=> $this->settings->cfg('mchat_custom_height'),
			'MCHAT_LIVE_UPDATES'			=> $this->settings->cfg('mchat_live_updates'),
			'MCHAT_LOCATION'				=> $this->settings->cfg('mchat_location'),
			'MCHAT_CHARACTER_COUNT'			=> $this->settings->cfg('mchat_character_count'),
			'MCHAT_SOUND'					=> $this->settings->cfg('mchat_sound'),
			'MCHAT_SOUND_DISABLED'			=> !$this->settings->cfg('mchat_sound') && !$this->settings->cfg('mchat_sound', true),
			'MCHAT_INDEX'					=> $this->settings->cfg('mchat_index'),
			'MCHAT_PAUSE_ON_INPUT'			=> $this->settings->cfg('mchat_pause_on_input'),
			'MCHAT_MESSAGE_LNGTH'			=> $this->settings->cfg('mchat_max_message_lngth'),
			'MCHAT_WHOIS_INDEX'				=> $this->settings->cfg('mchat_whois_index'),
			'MCHAT_WHOIS_REFRESH'			=> $this->settings->cfg('mchat_whois_index') || $this->settings->cfg('mchat_stats_index') ? $this->settings->cfg('mchat_whois_refresh') * 1000 : 0,
			'MCHAT_REFRESH_JS'				=> $this->settings->cfg('mchat_refresh') * 1000,
			'MCHAT_ARCHIVE'					=> $this->auth->acl_get('u_mchat_archive'),
			'MCHAT_RULES'					=> $this->user->lang('MCHAT_RULES_MESSAGE') || $this->settings->cfg('mchat_rules'),
			'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> $this->user->lang('MCHAT_WHO_IS_REFRESH_EXPLAIN', $this->settings->cfg('mchat_whois_refresh')),
			'MCHAT_SESSION_TIMELEFT'		=> $this->user->lang('MCHAT_SESSION_ENDS', gmdate($this->settings->cfg('mchat_timeout') >= 3600 ? 'H:i:s' : 'i:s', $this->settings->cfg('mchat_timeout'))),
			'MCHAT_LOG_ID'					=> $this->functions->get_latest_log_id(),
			'MCHAT_STATIC_MESS'				=> htmlspecialchars_decode($static_message),
			'A_MCHAT_MESS_LONG'				=> addslashes($this->user->lang('MCHAT_MESS_LONG', $this->settings->cfg('mchat_max_message_lngth'))),
			'A_MCHAT_REFRESH_YES'			=> addslashes($this->user->lang('MCHAT_REFRESH_YES', $this->settings->cfg('mchat_refresh'))),
			'A_COOKIE_NAME'					=> addslashes($this->settings->cfg('cookie_name', true) . '_'),
			'U_MCHAT_CUSTOM_PAGE'			=> $this->helper->route('dmzx_mchat_page_custom_controller'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_page_rules_controller'),
			'U_MCHAT_ARCHIVE_URL'			=> $this->helper->route('dmzx_mchat_page_archive_controller'),
		));

		// The template needs some language variables if we display relative time for messages
		if ($this->settings->cfg('mchat_relative_time'))
		{
			$minutes_limit = $this->get_relative_minutes_limit();
			for ($i = 0; $i < $minutes_limit; $i++)
			{
				$this->template->assign_block_vars('mchattime', array(
					'KEY'		=> $i,
					'A_LANG'	=> addslashes($this->user->lang('MCHAT_MINUTES_AGO', $i)),
					'IS_LAST'	=> $i + 1 === $minutes_limit,
				));
			}
		}

		// Get actions which the user is allowed to perform on the current page
		$actions = array_keys(array_filter(array(
			'edit'		=> $this->auth_message('edit', true, time()),
			'del'		=> $this->auth_message('delete', true, time()),
			'refresh'	=> $page !== 'archive' && $this->auth->acl_get('u_mchat_view'),
			'add'		=> $page !== 'archive' && $this->auth->acl_get('u_mchat_use'),
			'whois'		=> $page !== 'archive' && ($this->settings->cfg('mchat_whois_index') || $this->settings->cfg('mchat_stats_index')),
		)));

		foreach ($actions as $i => $action)
		{
			$this->template->assign_block_vars('mchaturl', array(
				'ACTION'	=> $action,
				'URL'		=> $this->helper->route('dmzx_mchat_action_' . $action . '_controller', array(), false),
				'IS_LAST'	=> $i + 1 === count($actions),
			));
		}

		$limit = $this->settings->cfg('mchat_message_num_' . $page);
		$start = $page === 'archive' ? $this->request->variable('start', 0) : 0;
		$rows = $this->functions->mchat_get_messages(array(), 0, $limit, $start);

		$this->assign_global_template_data();
		$this->assign_messages($rows, $page);

		// Render pagination
		if ($page === 'archive')
		{
			$archive_url = $this->helper->route('dmzx_mchat_page_archive_controller');
			$total_messages = $this->functions->mchat_total_message_count();

			/**
			 * Event to modify mChat pagination on the archive page
			 *
			 * @event dmzx.mchat.render_page_pagination_before
			 * @var string	archive_url		Pagination base URL
			 * @var int		total_messages	Total number of messages
			 * @var int		limit			Number of messages to display per page
			 * @var int		start			The message which should be considered currently active, used to determine the page we're on
			 * @since 2.0.0-RC6
			 */
			$vars = array(
				'archive_url',
				'total_messages',
				'limit',
				'start',
			);
			extract($this->dispatcher->trigger_event('dmzx.mchat.render_page_pagination_before', compact($vars)));

			$this->pagination->generate_template_pagination($archive_url, 'pagination', 'start', $total_messages, $limit, $start);
			$this->template->assign_var('MCHAT_TOTAL_MESSAGES', $this->user->lang('MCHAT_TOTALMESSAGES', $total_messages));
		}

		// Render legend
		if ($page !== 'index')
		{
			$legend = $this->functions->mchat_legend();
			$this->template->assign_var('LEGEND', implode($this->user->lang('COMMA_SEPARATOR'), $legend));
		}

		// Make mChat collapsible
		if ($page === 'index' && $this->cc_operator !== null)
		{
			$cc_fid = 'mchat';
			$this->template->assign_vars(array(
				'MCHAT_IS_COLLAPSIBLE'	=> true,
				'S_MCHAT_HIDDEN'		=> in_array($cc_fid, $this->cc_operator->get_user_categories()),
				'U_MCHAT_COLLAPSE_URL'	=> $this->helper->route('phpbb_collapsiblecategories_main_controller', array(
					'forum_id'	=> $cc_fid,
					'hash'		=> generate_link_hash('collapsible_' . $cc_fid),
				)),
			));
		}

		$this->assign_authors();

		if ($this->auth->acl_get('u_mchat_use'))
		{
			add_form_key('mchat');
		}

		/**
		 * Event that is triggered after mChat was rendered
		 *
		 * @event dmzx.mchat.render_page_after
		 * @var string	page	The page that was rendered, one of index|custom|archive
		 * @var array	actions	Array containing URLs to actions the user is allowed to perform
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'page',
			'actions',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.render_page_after', compact($vars)));
	}

	/**
	 * Assigns author names and homepages for copyright
	 */
	protected function assign_authors()
	{
		$md_manager = $this->extension_manager->create_extension_metadata_manager('dmzx/mchat', $this->template);
		$meta = $md_manager->get_metadata();

		$author_homepages = array();

		foreach (array_slice($meta['authors'], 0, 2) as $author)
		{
			$author_homepages[] = sprintf('<a href="%1$s" title="%2$s">%2$s</a>', $author['homepage'], $author['name']);
		}

		$this->template->assign_vars(array(
			'MCHAT_DISPLAY_NAME'		=> $meta['extra']['display-name'],
			'MCHAT_AUTHOR_HOMEPAGES'	=> implode(' &amp; ', $author_homepages),
		));
	}

	/**
	 * Assigns common template data that is required for displaying messages
	 */
	public function assign_global_template_data()
	{
		$template_data = array(
			'S_BBCODE_ALLOWED'			=> $this->auth->acl_get('u_mchat_bbcode') && $this->settings->cfg('allow_bbcode'),
			'MCHAT_ALLOW_USE'			=> $this->auth->acl_get('u_mchat_use'),
			'MCHAT_ALLOW_IP'			=> $this->auth->acl_get('u_mchat_ip'),
			'MCHAT_ALLOW_PM'			=> $this->auth->acl_get('u_mchat_pm'),
			'MCHAT_ALLOW_LIKE'			=> $this->auth->acl_get('u_mchat_like'),
			'MCHAT_ALLOW_QUOTE'			=> $this->auth->acl_get('u_mchat_quote'),
			'MCHAT_ALLOW_PERMISSIONS'	=> $this->auth->acl_get('a_authusers'),
			'MCHAT_EDIT_DELETE_LIMIT'	=> 1000 * $this->settings->cfg('mchat_edit_delete_limit'),
			'MCHAT_EDIT_DELETE_IGNORE'	=> $this->settings->cfg('mchat_edit_delete_limit') && ($this->auth->acl_get('u_mchat_moderator_edit') || $this->auth->acl_get('u_mchat_moderator_delete')),
			'MCHAT_RELATIVE_TIME'		=> $this->settings->cfg('mchat_relative_time'),
			'MCHAT_TIMEOUT'				=> 1000 * $this->settings->cfg('mchat_timeout'),
			'S_MCHAT_AVATARS'			=> $this->display_avatars(),
			'EXT_URL'					=> generate_board_url() . '/ext/dmzx/mchat/',
			'STYLE_PATH'				=> generate_board_url() . '/styles/' . rawurlencode($this->user->style['style_path']),
		);

		/**
		 * Event that allows adding global templte data for mChat
		 *
		 * @event dmzx.mchat.global_modify_template_data
		 * @var array	template_data		The data that is about to be assigned to the template
		 * @since 2.0.0-RC6
		 */
		$vars = array(
			'template_data',
		);
		extract($this->dispatcher->trigger_event('dmzx.mchat.global_modify_template_data', compact($vars)));

		$this->template->assign_vars($template_data);
	}

	/**
	 * Returns true if we need do display avatars in the messages, otherwise false
	 *
	 * @return bool
	 */
	protected function display_avatars()
	{
		return $this->settings->cfg('mchat_avatars') && $this->user->optionget('viewavatars') && $this->settings->cfg('mchat_avatars');
	}

	/**
	 * Assigns all message rows to the template
	 *
	 * @param array $rows
	 * @param string $page
	 */
	public function assign_messages($rows, $page = '')
	{
		$rows = array_filter($rows, array($this, 'has_read_auth'));

		if (!$rows)
		{
			return;
		}

		// At this point the rows are sorted by ID bottom to top.
		// We need to reverse the array if they need to be sorted top to bottom.
		$reverse = false;
		$mchat_message_top = $this->settings->cfg('mchat_message_top');
		if ($page === 'archive')
		{
			$mchat_archive_sort = $this->settings->cfg('mchat_archive_sort');
			if ($mchat_archive_sort == settings::ARCHIVE_SORT_TOP_BOTTOM || $mchat_archive_sort == settings::ARCHIVE_SORT_USER && !$mchat_message_top)
			{
				$reverse = true;
			}
		}
		else if (!$mchat_message_top)
		{
			$reverse = true;
		}

		if ($reverse)
		{
			$rows = array_reverse($rows);
		}

		if ($this->foes === null)
		{
			$this->foes = $this->functions->mchat_foes();
		}

		// Remove template data from previous render
		$this->template->destroy_block_vars('mchatrow');

		$user_avatars = array();

		// Cache avatars
		$display_avatar = $this->display_avatars();
		foreach ($rows as $row)
		{
			if (!isset($user_avatars[$row['user_id']]))
			{
				$user_avatars[$row['user_id']] = !$display_avatar || !$row['user_avatar'] ? '' : phpbb_get_user_avatar(array(
					'avatar'		=> $row['user_avatar'],
					'avatar_type'	=> $row['user_avatar_type'],
					'avatar_width'	=> $row['user_avatar_width'] >= $row['user_avatar_height'] ? 40 : 0,
					'avatar_height'	=> $row['user_avatar_width'] >= $row['user_avatar_height'] ? 0 : 40,
				));
			}
		}

		$board_url = generate_board_url() . '/';

		$this->process_notifications($rows, $board_url);

		foreach ($rows as $row)
		{
			$username_full = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST'));

			// Fix profile link root path by replacing relative paths with absolute board URL
			if ($this->request->is_ajax())
			{
				$username_full = preg_replace('#(?<=href=")[\./]+?/(?=\w)#', $board_url, $username_full);
			}

			if (in_array($row['user_id'], $this->foes))
			{
				$row['message'] = $this->user->lang('MCHAT_FOE', $username_full);
			}

			$message_age = time() - $row['message_time'];
			$minutes_ago = $this->get_minutes_ago($message_age);
			$absolute_datetime = $this->user->format_date($row['message_time'], $this->settings->cfg('mchat_date'), true);
			// If relative time is selected, also display "today" / "yesterday", else display absolute time.
			if ($this->settings->cfg('mchat_relative_time'))
			{
				$datetime = $this->user->format_date($row['message_time'], $this->settings->cfg('mchat_date'), false);
			}
			else
			{
				$datetime = $this->user->format_date($row['message_time'], $this->settings->cfg('mchat_date'), true);
			}

			$is_poster = $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'];

			$message_for_edit = generate_text_for_edit($row['message'], $row['bbcode_uid'], $row['bbcode_options']);

			$template_data = array(
				'MCHAT_ALLOW_EDIT'			=> $this->auth_message('edit', $row['user_id'], $row['message_time']),
				'MCHAT_ALLOW_DEL'			=> $this->auth_message('delete', $row['user_id'], $row['message_time']),
				'MCHAT_USER_AVATAR'			=> $user_avatars[$row['user_id']],
				'U_VIEWPROFILE'				=> $row['user_id'] != ANONYMOUS ? append_sid("{$board_url}{$this->root_path}memberlist.{$this->php_ext}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
				'MCHAT_IS_POSTER'			=> $is_poster,
				'MCHAT_IS_NOTIFICATION'		=> (bool) $row['post_id'],
				'MCHAT_PM'					=> !$is_poster && $this->settings->cfg('allow_privmsg') && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$board_url}{$this->root_path}ucp.{$this->php_ext}", 'i=pm&amp;mode=compose&amp;mchat_pm_quote_message=' . (int) $row['message_id'] . '&amp;u=' . $row['user_id']) : '',
				'MCHAT_MESSAGE_EDIT'		=> $message_for_edit['text'],
				'MCHAT_MESSAGE_ID'			=> $row['message_id'],
				'MCHAT_USERNAME_FULL'		=> $username_full,
				'MCHAT_USERNAME'			=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME_COLOR'		=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_WHOIS_USER'			=> $this->user->lang('MCHAT_WHOIS_USER', $row['user_ip']),
				'MCHAT_U_IP'				=> $this->helper->route('dmzx_mchat_page_whois_controller', array('ip' => $row['user_ip'])),
				'MCHAT_U_PERMISSIONS'		=> append_sid("{$board_url}{$this->root_path}adm/index.{$this->php_ext}", 'i=permissions&amp;mode=setting_user_global&amp;user_id%5B0%5D=' . $row['user_id'], true, $this->user->session_id),
				'MCHAT_MESSAGE'				=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'MCHAT_TIME'				=> $minutes_ago === -1 ? $datetime : $this->user->lang('MCHAT_MINUTES_AGO', $minutes_ago),
				'MCHAT_DATETIME'			=> $absolute_datetime,
				'MCHAT_MINUTES_AGO'			=> $minutes_ago,
				'MCHAT_RELATIVE_UPDATE'		=> 60 - $message_age % 60,
				'MCHAT_MESSAGE_TIME'		=> $row['message_time'],
			);

			/**
			 * Event to modify the template data of an mChat message before it is sent to the template
			 *
			 * @event dmzx.mchat.message_modify_template_data
			 * @var array	template_data		The data that is about to be assigned to the template
			 * @var string	username_full		The link to the user profile, e.g. <a href="...">Username</a>
			 * @var bool	is_notification		Whether or not this message is a notification
			 * @var array	row					The raw message data as fetched from the database
			 * @var int		message_age			The number of seconds that have passed since the message was posted
			 * @var int		minutes_ago			The number of minutes that have passed since the message was posted, or -1
			 * @var string	datetime			The full date in the user-specific date format
			 * @var bool	is_poster			Whether or not the current user posted this message
			 * @var array	message_for_edit	The data for editing the message
			 * @since 2.0.0-RC6
			 */
			$vars = array(
				'template_data',
				'username_full',
				'is_notification',
				'row',
				'message_age',
				'minutes_ago',
				'datetime',
				'is_poster',
				'message_for_edit',
			);
			extract($this->dispatcher->trigger_event('dmzx.mchat.message_modify_template_data', compact($vars)));

			$this->template->assign_block_vars('mchatrow', $template_data);
		}
	}

	/**
	 * Returns true of the user is allowed to read the given message row
	 *
	 * @param array $row
	 * @return bool
	 */
	protected function has_read_auth($row)
	{
		if ($row['forum_id'])
		{
			// No permission to read forum
			if (!$this->auth->acl_get('f_read', $row['forum_id']))
			{
				return false;
			}

			// Post is not approved and no approval permission
			if ($row['post_visibility'] != ITEM_APPROVED && !$this->auth->acl_get('m_approve', $row['forum_id']))
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * Checks the post rows for notifications and converts their language keys
	 *
	 * @param array $rows The rows to modify
	 * @param string $board_url
	 */
	protected function process_notifications(&$rows, $board_url)
	{
		$notification_post_ids = array();

		// All language keys of valid notifications. We need to check for them here because
		// notifications in < 2.0.0-RC6 are plain text and don't need to be processed here.
		$notification_lang = array(
			'MCHAT_NEW_POST',
			'MCHAT_NEW_QUOTE',
			'MCHAT_NEW_EDIT',
			'MCHAT_NEW_REPLY',
			'MCHAT_NEW_LOGIN',
		);

		foreach ($rows as $i => $row)
		{
			// If post_id is 0 it's not a notification.
			if ($row['post_id'] && in_array($row['message'], $notification_lang))
			{
				if ($row['forum_id'])
				{
					$notification_post_ids[] = $row['post_id'];
				}
				else
				{
					$rows[$i] = $this->process_notification($row, $board_url);
				}
			}
		}

		$notification_post_data = $this->functions->mchat_get_post_data($notification_post_ids);

		if ($notification_post_data)
		{
			foreach ($rows as $i => $row)
			{
				if (in_array($row['post_id'], $notification_post_ids))
				{
					$rows[$i] = $this->process_notification($row, $board_url, $notification_post_data[$row['post_id']]);
				}
			}
		}
	}

	/**
	 * Converts the message field of the post row so that it can be passed to generate_text_for_display()
	 *
	 * @param array $row
	 * @param string $board_url
	 * @param array $post_data
	 * @return array
	 */
	protected function process_notification($row, $board_url, $post_data = null)
	{
		$args = array($row['message']);

		// If forum_id is 0 it's a login notification.
		// If forum_id is not 0 it's a post notification, we need to fetch forum name and post subject.
		if ($row['forum_id'])
		{
			$viewtopic_url = append_sid($board_url . 'viewtopic.' . $this->php_ext, array(
				'p' => $row['post_id'],
				'#' => 'p' . $row['post_id'],
			));

			// We prefer $post_data because it was fetched from the forums table just now.
			// $row might contain outdated data if a post was moved to a new forum.
			$forum_id = isset($post_data['forum_id']) ? $post_data['forum_id'] : $row['forum_id'];

			$viewforum_url = append_sid($board_url . 'viewforum.' . $this->php_ext, array(
				'f' => $forum_id,
			));

			if ($post_data)
			{
				$args[] = '[url=' . $viewtopic_url . ']' . $post_data['post_subject'] . '[/url]';
				$args[] = '[url=' . $viewforum_url . ']' . $post_data['forum_name'] . '[/url]';
			}
			else
			{
				$args[0] .= '_DELETED';
			}
		}
		else if ($row['post_id'] == functions::LOGIN_HIDDEN)
		{
			$row['username'] = '<em>' . $row['username'] . '</em>';
		}

		$row['message'] = call_user_func_array(array($this->user, 'lang'), $args);

		// Quick'n'dirty check if BBCodes are in the message
		if (strpos($row['message'], '[') !== false)
		{
			generate_text_for_storage($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'], true, true, true);
		}

		return $row;
	}

	/**
	 * Calculates the number of minutes that have passed since the message was posted.
	 * If relative time is disabled or the message is older than 59 minutes, -1 is returned.
	 *
	 * @param int $message_age
	 * @return int
	 */
	protected function get_minutes_ago($message_age)
	{
		if ($this->settings->cfg('mchat_relative_time'))
		{
			$minutes_ago = floor($message_age / 60);
			if ($minutes_ago < $this->get_relative_minutes_limit())
			{
				return $minutes_ago;
			}
		}

		return -1;
	}

	/**
	 * Calculates the amount of time after which messages switch from displaying relative time
	 * to displaying absolute time. Uses mChat's timeout if it's not zero, otherwise phpBB's
	 * global session timeout, but never shorter than 1 minute and never longer than 60 minutes.
	 *
	 * @return int
	 */
	protected function get_relative_minutes_limit()
	{
		$timeout = $this->settings->cfg('mchat_timeout');

		if (!$timeout)
		{
			$timeout = $this->settings->cfg('session_length');
		}

		return min(max((int) ceil($timeout / 60), 1), 60);
	}

	/**
	 * Assigns BBCodes and smilies to the template
	 */
	protected function assign_bbcodes_smilies()
	{
		// Display BBCodes
		if ($this->settings->cfg('allow_bbcode') && $this->auth->acl_get('u_mchat_bbcode'))
		{
			$bbcode_template_vars = array(
				'quote'	=> array(
					'allow'			=> true,
					'template_var'	=> 'S_BBCODE_QUOTE',
				),
				'img'	=> array(
					'allow'			=> true,
					'template_var'	=> 'S_BBCODE_IMG',
				),
				'url'	=> array(
					'allow'			=> $this->settings->cfg('allow_post_links'),
					'template_var'	=> 'S_LINKS_ALLOWED',
				),
				'flash'	=> array(
					'allow'			=> $this->settings->cfg('allow_post_flash'),
					'template_var'	=> 'S_BBCODE_FLASH',
				),
			);

			foreach ($bbcode_template_vars as $bbcode => $option)
			{
				$is_disallowed = preg_match('#(^|\|)' . $bbcode . '($|\|)#Usi', $this->settings->cfg('mchat_bbcode_disallowed')) || !$option['allow'];
				$this->template->assign_var($option['template_var'], !$is_disallowed);
			}

			$this->template->assign_var('A_MCHAT_DISALLOWED_BBCODES', addslashes($this->settings->cfg('mchat_bbcode_disallowed')));

			if (!function_exists('display_custom_bbcodes'))
			{
				include($this->root_path . 'includes/functions_display.' . $this->php_ext);
			}

			$this->remove_disallowed_bbcodes = true;
			display_custom_bbcodes();
		}

		// Display smilies
		if ($this->settings->cfg('allow_smilies') && $this->auth->acl_get('u_mchat_smilies'))
		{
			if (!function_exists('generate_smilies'))
			{
				include($this->root_path . 'includes/functions_posting.' . $this->php_ext);
			}

			generate_smilies('inline', 0);
		}
	}

	/**
	 * Appends a condition to the WHERE key of the SQL array to not fetch disallowed BBCodes from the database
	 *
	 * @param array $sql_ary
	 * @return array
	 */
	public function remove_disallowed_bbcodes($sql_ary)
	{
		// Add disallowed BBCodes to the template only if we're rendering for mChat
		if ($this->remove_disallowed_bbcodes)
		{
			$sql_ary['WHERE'] = $this->functions->mchat_sql_append_forbidden_bbcodes($sql_ary['WHERE']);
		}

		return $sql_ary;
	}

	/**
	 * Sets the default values when a user registers a new account as configured in the global user settings
	 *
	 * @param array $sql_ary
	 * @return array
	 */
	public function set_user_default_values($sql_ary)
	{
		foreach (array_keys($this->settings->ucp_settings()) as $config_name)
		{
			$sql_ary['user_' . $config_name] = $this->settings->cfg($config_name, true);
		}

		return $sql_ary;
	}

	/**
	 * Inserts a message with posting information into the database
	 *
	 * @param string $mode One of post|quote|edit|reply|login
	 * @param int $forum_id Can be 0 if mode is login.
	 * @param int $post_id Can be 0 if mode is login.
	 */
	public function insert_posting($mode, $forum_id = 0, $post_id = 0)
	{
		$is_hidden_login = $this->request->is_set_post('viewonline') || !$this->user->data['user_allow_viewonline'];
		$this->functions->mchat_insert_posting($mode, $forum_id, $post_id, $is_hidden_login);
	}

	/**
	 * Fetches the message text of the given ID, quotes it using the current user name and assigns it to the template
	 *
	 * @param int $mchat_message_id
	 */
	public function quote_message_text($mchat_message_id)
	{
		if (!$this->auth->acl_get('u_mchat_view'))
		{
			return;
		}

		$rows = $this->functions->mchat_get_messages($mchat_message_id);
		$row = reset($rows);

		if (!$row || !$this->has_read_auth($row))
		{
			return;
		}

		if ($row['post_id'])
		{
			$rows = array($row);
			$this->process_notifications($rows, generate_board_url() . '/');
			$row = reset($rows);
		}

		$message_for_edit = generate_text_for_edit($row['message'], $row['bbcode_uid'], $row['bbcode_options']);
		$message = '[quote=&quot;' . $row['username'] . '&quot;]' . $message_for_edit['text'] . "[/quote]\n";

		$this->template->assign_var('MESSAGE', $message);
	}

	/**
	 * Remove expired sessions from the database
	 */
	public function session_gc()
	{
		$this->functions->mchat_session_gc();
	}

	/**
	 * Assigns whois and stats at the bottom of the index page
	 */
	protected function assign_whois()
	{
		if ($this->settings->cfg('mchat_whois_index') || $this->settings->cfg('mchat_stats_index'))
		{
			if ($this->active_users === null)
			{
				$this->active_users = $this->functions->mchat_active_users();
			}

			$this->template->assign_vars(array(
				'MCHAT_STATS_INDEX'		=> $this->settings->cfg('mchat_stats_index'),
				'MCHAT_USERS_TOTAL'		=> $this->active_users['users_total'],
				'MCHAT_USERS_LIST'		=> $this->active_users['online_userlist'] ?: '',
				'MCHAT_ONLINE_EXPLAIN'	=> $this->active_users['refresh_message'],
			));
		}
	}

	/**
	 * Checks whether an author has edit or delete permissions for a message
	 *
	 * @param string $mode One of edit|delete
	 * @param int $author_id The user id of the message
	 * @param int $message_time The message created time
	 * @return bool
	 */
	protected function auth_message($mode, $author_id, $message_time)
	{
		if ($this->auth->acl_get('u_mchat_moderator_' . $mode))
		{
			return true;
		}

		if (!$this->user->data['is_registered'] || $this->user->data['user_id'] != $author_id || !$this->auth->acl_get('u_mchat_' . $mode))
		{
			return false;
		}

		return !$this->settings->cfg('mchat_edit_delete_limit') || $message_time >= time() - $this->settings->cfg('mchat_edit_delete_limit');
	}

	/**
	 * Performs bound checks on the message and returns an array containing the message
	 * and BBCode options ready to be sent to the database
	 *
	 * @param string $message
	 * @return array
	 */
	protected function process_message($message)
	{
		// Must have something other than bbcode in the message
		$message_without_bbcode = trim(preg_replace('#\[\/?[^\[\]]+\]#m', '', $message));
		if (!utf8_strlen($message_without_bbcode))
		{
			throw new http_exception(400, 'MCHAT_NOMESSAGEINPUT');
		}

		// Must not exceed character limit
		if ($this->settings->cfg('mchat_max_message_lngth'))
		{
			$message_without_entities = htmlspecialchars_decode($message, ENT_COMPAT);
			if (utf8_strlen($message_without_entities) > $this->settings->cfg('mchat_max_message_lngth'))
			{
				throw new http_exception(400, 'MCHAT_MESS_LONG', array($this->settings->cfg('mchat_max_message_lngth')));
			}
		}

		if ($this->settings->cfg('mchat_override_min_post_chars'))
		{
			$this->settings->set_cfg('min_post_chars', 0, true);
		}

		if ($this->settings->cfg('mchat_override_smilie_limit'))
		{
			$this->settings->set_cfg('max_post_smilies', 0, true);
		}

		$disallowed_bbcodes = array_filter(explode('|', $this->settings->cfg('mchat_bbcode_disallowed')));

		$mchat_bbcode		= $this->settings->cfg('allow_bbcode') && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_magic_urls	= $this->settings->cfg('allow_post_links') && $this->auth->acl_get('u_mchat_urls');
		$mchat_smilies		= $this->settings->cfg('allow_smilies') && $this->auth->acl_get('u_mchat_smilies');

		// These arguments for generate_text_for_storage() are ignored in 3.1.x
		$mchat_img = $mchat_flash = $mchat_quote = $mchat_url = $mchat_bbcode;

		// Disallowed bbcodes for 3.2.x
		if ($disallowed_bbcodes && $this->parser !== null)
		{
			$mchat_img		&= !in_array('img', $disallowed_bbcodes);
			$mchat_flash	&= !in_array('flash', $disallowed_bbcodes);
			$mchat_quote	&= !in_array('quote', $disallowed_bbcodes);
			$mchat_url		&= !in_array('url', $disallowed_bbcodes);

			foreach ($disallowed_bbcodes as $bbcode)
			{
				$this->parser->disable_bbcode($bbcode);
			}
		}

		$uid = $bitfield = $options = '';
		generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_bbcode, $mchat_magic_urls, $mchat_smilies, $mchat_img, $mchat_flash, $mchat_quote, $mchat_url);

		// Disallowed bbcodes for 3.1.x
		if ($disallowed_bbcodes && $this->parser === null)
		{
			$bbcode_replace = array(
				'#\[(' . str_replace('*', '\*', $this->settings->cfg('mchat_bbcode_disallowed')) . ')[^\[\]]+\]#Usi',
				'#\[/(' . str_replace('*', '\*', $this->settings->cfg('mchat_bbcode_disallowed')) . ')[^\[\]]+\]#Usi',
			);

			$message = preg_replace($bbcode_replace, '', $message);
		}

		return array(
			'message'			=> str_replace("'", '&#39;', $message),
			'bbcode_bitfield'	=> $bitfield,
			'bbcode_uid'		=> $uid,
			'bbcode_options'	=> $options,
		);
	}

	/**
	 * Renders a template file and returns it
	 *
	 * @param string $template_file
	 * @return string
	 */
	public function render_template($template_file)
	{
		$this->template->set_filenames(array('body' => $template_file));
		$content = $this->template->assign_display('body', '', true);

		return trim(str_replace(array("\r", "\n"), '', $content));
	}
}
