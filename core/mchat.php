<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

class mchat
{
	/** @var \dmzx\mchat\core\functions */
	protected $functions;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\event\dispatcher_interface */
	protected $dispatcher;

	/** @var \phpbb\extension\manager */
	protected $extension_manager;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/** @var boolean */
	protected $remove_disallowed_bbcodes = false;

	/**
	 * Constructor
	 *
	 * @param \dmzx\mchat\core\functions		$functions
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\controller\helper			$helper
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\user						$user
	 * @param \phpbb\auth\auth					$auth
	 * @param \phpbb\pagination					$pagination
	 * @param \phpbb\request\request			$request
	 * @param \phpbb\event\dispatcher_interface $dispatcher
	 * @param \phpbb\extension\manager 			$extension_manager
	 * @param string							$root_path
	 * @param string							$php_ext
	 */
	public function __construct(\dmzx\mchat\core\functions $functions, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\event\dispatcher_interface $dispatcher,\phpbb\extension\manager $extension_manager, $root_path, $php_ext)
	{
		$this->functions			= $functions;
		$this->config				= $config;
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

		if (!$this->config['mchat_on_index'])
		{
			return;
		}

		if (!$this->user->data['user_mchat_index'])
		{
			return;
		}

		$this->user->add_lang_ext('dmzx/mchat', 'mchat');

		$this->assign_bbcodes_smilies();

		$this->render_page('index');
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
			throw new \phpbb\exception\http_exception(403, 'NOT_AUTHORISED');
		}

		if (!$this->config['mchat_custom_page'])
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NO_CUSTOM_PAGE');
		}

		$this->functions->mchat_prune();

		$this->functions->mchat_add_user_session();

		$this->assign_whois();

		$this->assign_bbcodes_smilies();

		$this->template->assign_var('MCHAT_CUSTOM_PAGE', true);

		$this->render_page('custom');

		// Add to navlinks
		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->user->lang('MCHAT_TITLE'),
			'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller'),
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
		if (!$this->auth->acl_get('u_mchat_view') || !$this->auth->acl_get('u_mchat_archive'))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS_ARCHIVE');
		}

		$this->functions->mchat_prune();

		$this->template->assign_var('MCHAT_ARCHIVE_PAGE', true);

		$this->render_page('archive');

		// Add to navlinks
		$this->template->assign_block_vars_array('navlinks', array(
			array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_TITLE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller'),
			),
			array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_ARCHIVE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive')),
			),
		));

		return $this->helper->render('mchat_body.html', $this->user->lang('MCHAT_ARCHIVE_PAGE'));
	}

	/**
	 * Controller for mChat IP WHOIS
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function page_whois()
	{
		if (!$this->auth->acl_get('u_mchat_ip'))
		{
			throw new \phpbb\exception\http_exception(403, 'NOT_AUTHORISED');
		}

		if (!function_exists('user_ipwhois'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$this->template->assign_var('WHOIS', user_ipwhois($this->request->variable('ip', '')));

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
			throw new \phpbb\exception\http_exception(403, 'NOT_AUTHORISED');
		}

		$lang_rules = $this->user->lang('MCHAT_RULES_MESSAGE');
		if (!$this->config['mchat_rules'] && !$lang_rules)
		{
			throw new \phpbb\exception\http_exception(404, 'MCHAT_NO_RULES');
		}

		// If the rules are defined in the language file use them, else just use the entry in the database
		$mchat_rules = $lang_rules ?: $this->config['mchat_rules'];
		$mchat_rules = htmlspecialchars_decode($mchat_rules);
		$mchat_rules = str_replace("\n", '<br />', $mchat_rules);

		$this->template->assign_var('MCHAT_RULES', $mchat_rules);

		return $this->helper->render('mchat_rules.html', $this->user->lang('MCHAT_RULES'));
	}

	/**
	 * User submits a message
	 *
	 * @return array data sent to client as JSON
	 */
	public function action_add()
	{
		if (!$this->auth->acl_get('u_mchat_use') || !check_form_key('mchat', -1))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		if ($this->functions->mchat_is_user_flooding())
		{
			throw new \phpbb\exception\http_exception(400, 'MCHAT_NOACCESS');
		}

		$message = $this->request->variable('message', '', true);

		if ($this->user->data['user_mchat_capital_letter'])
		{
			$message = utf8_ucfirst($message);
		}

		$sql_ary = $this->process_message($message, array(
			'user_id'			=> $this->user->data['user_id'],
			'user_ip'			=> $this->user->data['session_ip'],
			'message_time'		=> time(),
		));

		$is_new_session = $this->functions->mchat_action('add', $sql_ary);

		/**
		 * Event render_helper_add
		 *
		 * @event dmzx.mchat.core.render_helper_add
		 * @since 0.1.2
		 */
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_add');

		$data = $this->action_refresh();

		if ($is_new_session)
		{
			$data['whois'] = true;
		}

		return $data;
	}

	/**
	 * User edits a message
	 *
	 * @return array data sent to client as JSON
	 */
	public function action_edit()
	{
		$message_id = $this->request->variable('message_id', 0);

		if (!$message_id || !check_form_key('mchat', -1))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		$author = $this->functions->mchat_author_for_message($message_id);

		if (!$author || !$this->auth_message('u_mchat_edit', $author['user_id'], $author['message_time']))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		$is_archive = $this->request->variable('archive', 0);
		$this->template->assign_var('MCHAT_ARCHIVE_PAGE', $is_archive);

		$message = $this->request->variable('message', '', true);

		$sql_ary = $this->process_message($message, array(
			'edit_time' => time(),
		));

		$this->functions->mchat_action('edit', $sql_ary, $message_id, $author['username']);

		/**
		 * Event render_helper_edit
		 *
		 * @event dmzx.mchat.core.render_helper_edit
		 * @since 0.1.4
		 */
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_edit');

		$sql_where = 'm.message_id = ' . (int) $message_id;
		$rows = $this->functions->mchat_get_messages($sql_where, 1);

		$this->assign_global_template_data();
		$this->assign_messages($rows, $is_archive ? 'archive' : '');

		return array('edit' => $this->render_template('mchat_messages.html'));
	}

	/**
	 * User deletes a message
	 *
	 * @return array data sent to client as JSON
	 */
	public function action_del()
	{
		$message_id = $this->request->variable('message_id', 0);

		if (!$message_id || !check_form_key('mchat', -1))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		$author = $this->functions->mchat_author_for_message($message_id);

		if (!$author || !$this->auth_message('u_mchat_delete', $author['user_id'], $author['message_time']))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		/**
		 * Event render_helper_delete
		 *
		 * @event dmzx.mchat.core.render_helper_delete
		 * @since 0.1.4
		 */
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_delete');

		$this->functions->mchat_action('del', null, $message_id, $author['username']);

		return array('del' => true);
	}

	/**
	 * User checks for new messages
	 *
	 * @return array sent to client as JSON
	 */
	public function action_refresh()
	{
		if (!$this->auth->acl_get('u_mchat_view'))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		// Keep the session alive forever if there is no user session timeout
		if (!$this->config['mchat_timeout'])
		{
			$this->user->update_session_infos();
		}

		$message_first_id = $this->request->variable('message_first_id', 0);
		$message_last_id = $this->request->variable('message_last_id', 0);
		$message_edits = $this->request->variable('message_edits', array(0));

		// Request new messages
		$sql_where = 'm.message_id > ' . (int) $message_last_id;

		// Request edited messages
		if ($this->config['mchat_live_updates'] && $message_last_id > 0)
		{
			$sql_where .= sprintf(' OR (m.message_id BETWEEN %d AND %d AND m.edit_time > 0)', (int) $message_first_id , (int) $message_last_id);
			if ($this->config['mchat_edit_delete_limit'])
			{
				$sql_where .= sprintf(' AND m.message_time > %d', time() - $this->config['mchat_edit_delete_limit']);
			}
		}

		// Exclude post notifications
		if (!$this->user->data['user_mchat_topics'])
		{
			$sql_where = '(' . $sql_where . ') AND m.forum_id = 0';
		}

		$rows = $this->functions->mchat_get_messages($sql_where);
		$rows_refresh = array();
		$rows_edit = array();

		foreach ($rows as $row)
		{
			$message_id = $row['message_id'];
			if ($message_id > $message_last_id)
			{
				$rows_refresh[] = $row;
			}
			else if (!isset($message_edits[$message_id]) || $message_edits[$message_id] < $row['edit_time'])
			{
				$rows_edit[] = $row;
			}
		}

		if ($rows_refresh || $rows_edit)
		{
			$this->assign_global_template_data();
		}

		$response = array('refresh' => true);

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
		if ($this->config['mchat_live_updates'] && $message_last_id > 0)
		{
			$deleted_message_ids = $this->functions->mchat_deleted_ids($message_first_id);
			if ($deleted_message_ids)
			{
				$response['del'] = $deleted_message_ids;
			}
		}

		return $response;
	}

	/**
	 * User requests who is chatting
	 *
	 * @return array data sent to client as JSON
	 */
	public function action_whois()
	{
		$this->assign_whois();

		return array('whois' => $this->render_template('mchat_whois.html'));
	}

	/**
	 * Adds the template variables for the header link
	 */
	public function render_page_header_link()
	{
		$this->template->assign_vars(array(
			'MCHAT_ALLOW_VIEW'		=> $this->auth->acl_get('u_mchat_view'),
			'MCHAT_NAVBAR_LINK'		=> $this->config['mchat_navbar_link'],
			'S_MCHAT_CUSTOM_PAGE'	=> $this->config['mchat_custom_page'],
			'U_MCHAT'				=> $this->helper->route('dmzx_mchat_controller'),
		));
	}

	/**
	 * Renders data for a page
	 *
	 * @param string $page The page we are rendering for, one of index|custom|archive
	 */
	protected function render_page($page)
	{
		// Add lang file
		$this->user->add_lang('posting');

		// If the static message is defined in the language file use it, else the entry in the database is used
		$lang_static_message = $this->user->lang('MCHAT_STATIC_MESSAGE');
		$static_message = $lang_static_message ?: $this->config['mchat_static_message'];

		$this->template->assign_vars(array(
			'U_MCHAT_CUSTOM_PAGE'			=> $this->helper->route('dmzx_mchat_controller'),
			'MCHAT_REFRESH_JS'				=> 1000 * $this->config['mchat_refresh'],
			'MCHAT_INPUT_TYPE'				=> $this->user->data['user_mchat_input_area'],
			'MCHAT_RULES'					=> $this->user->lang('MCHAT_RULES_MESSAGE') || $this->config['mchat_rules'],
			'MCHAT_ALLOW_USE'				=> $this->auth->acl_get('u_mchat_use'),
			'MCHAT_ALLOW_SMILES'			=> $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies'),
			'S_BBCODE_ALLOWED'				=> $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode'),
			'MCHAT_MESSAGE_TOP'				=> $this->config['mchat_message_top'],
			'MCHAT_ARCHIVE_URL'				=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive')),
			'MCHAT_INDEX_HEIGHT'			=> $this->config['mchat_index_height'],
			'MCHAT_CUSTOM_HEIGHT'			=> $this->config['mchat_custom_height'],
			'MCHAT_READ_ARCHIVE_BUTTON'		=> $this->auth->acl_get('u_mchat_archive'),
			'MCHAT_STATIC_MESS'				=> htmlspecialchars_decode($static_message),
			'L_MCHAT_COPYRIGHT'				=> base64_decode('PHNwYW4gY2xhc3M9Im1jaGF0LWNvcHlyaWdodCIgdGl0bGU9ImRtenggJmJ1bGw7IGthc2ltaSAmYnVsbDsgUk1jR2lycjgzIj4mY29weTs8L3NwYW4+'),
			'MCHAT_MESSAGE_LNGTH'			=> $this->config['mchat_max_message_lngth'],
			'MCHAT_MESS_LONG'				=> $this->user->lang('MCHAT_MESS_LONG', $this->config['mchat_max_message_lngth']),
			'MCHAT_USER_TIMEOUT_TIME'		=> gmdate('H:i:s', (int) $this->config['mchat_timeout']),
			'MCHAT_WHOIS_REFRESH'			=> $this->config['mchat_whois'] ? 1000 * $this->config['mchat_whois_refresh'] : 0,
			'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> $this->user->lang('MCHAT_WHO_IS_REFRESH_EXPLAIN', $this->config['mchat_whois_refresh']),
			'MCHAT_PAUSE_ON_INPUT'			=> $this->config['mchat_pause_on_input'],
			'MCHAT_REFRESH_YES'				=> $this->user->lang('MCHAT_REFRESH_YES', $this->config['mchat_refresh']),
			'MCHAT_LIVE_UPDATES'			=> $this->config['mchat_live_updates'],
			'S_MCHAT_LOCATION'				=> $this->config['mchat_location'],
			'S_MCHAT_SOUND_YES'				=> $this->user->data['user_mchat_sound'],
			'U_MORE_SMILIES'				=> generate_board_url() . append_sid("/{$this->root_path}/posting.{$this->php_ext}", 'mode=smilies'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'rules')),
			'S_MCHAT_ON_INDEX'				=> $this->config['mchat_on_index'] && $this->user->data['user_mchat_index'],
		));

		$md_manager = $this->extension_manager->create_extension_metadata_manager('dmzx/mchat', $this->template);
		$md_manager->get_metadata('all');
		$md_manager->output_template_data();

		// The template needs some language variables if we display relative time for messages
		if ($this->config['mchat_relative_time'] && $page != 'archive')
		{
			$minutes_limit = $this->get_relative_minutes_limit();
			for ($i = 0; $i < $minutes_limit; $i++)
			{
				$this->template->assign_block_vars('mchattime', array(
					'KEY'		=> $i,
					'LANG'		=> $this->user->lang('MCHAT_MINUTES_AGO', $i),
					'IS_LAST'	=> $i + 1 === $minutes_limit,
				));
			}
		}

		// Get actions which the user is allowed to perform on the current page
		$actions = array_keys(array_filter(array(
			'edit'		=> $this->auth_message('u_mchat_edit', true, time()),
			'del'		=> $this->auth_message('u_mchat_delete', true, time()),
			'refresh'	=> $page != 'archive' && $this->auth->acl_get('u_mchat_view'),
			'add'		=> $page != 'archive' && $this->auth->acl_get('u_mchat_use'),
			'whois'		=> $page != 'archive' && $this->config['mchat_whois'],
		)));

		foreach ($actions as $i => $action)
		{
			$this->template->assign_block_vars('mchaturl', array(
				'ACTION'	=> $action,
				'URL'		=> $this->helper->route('dmzx_mchat_action_controller', array('action' => $action)),
				'IS_LAST'	=> $i + 1 === count($actions),
			));
		}

		$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'm.forum_id = 0';
		$limit = $page == 'archive' ? $this->config['mchat_archive_limit'] : $this->config[$page == 'index' ? 'mchat_message_num' : 'mchat_message_limit'];
		$start = $page == 'archive' ? $this->request->variable('start', 0) : 0;
		$rows = $this->functions->mchat_get_messages($sql_where, $limit, $start);

		$this->assign_global_template_data();
		$this->assign_messages($rows, $page);

		// Render pagination
		if ($page == 'archive')
		{
			$archive_url = $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive'));
			$total_messages = $this->functions->mchat_total_message_count();
			$this->pagination->generate_template_pagination($archive_url, 'pagination', 'start', $total_messages, $limit, $start);
			$this->template->assign_var('MCHAT_TOTAL_MESSAGES', $this->user->lang('MCHAT_TOTALMESSAGES', $total_messages));
		}

		// Render legend
		if ($page != 'index' && $this->config['mchat_whois'])
		{
			$legend = $this->functions->mchat_legend();
			$this->template->assign_var('LEGEND', implode(', ', $legend));
		}

		if ($this->auth->acl_get('u_mchat_use'))
		{
			add_form_key('mchat');
		}

		/**
		* Event render_helper_aft
		*
		* @event dmzx.mchat.core.render_helper_aft
		* @since 0.1.2
		*/
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_aft');
	}

	/**
	 * Assigns common template data that is required for displaying messages
	 */
	protected function assign_global_template_data()
	{
		$this->template->assign_vars(array(
			'MCHAT_ALLOW_IP'				=> $this->auth->acl_get('u_mchat_ip'),
			'MCHAT_ALLOW_PM'				=> $this->auth->acl_get('u_mchat_pm'),
			'MCHAT_ALLOW_LIKE'				=> $this->auth->acl_get('u_mchat_like'),
			'MCHAT_ALLOW_QUOTE'				=> $this->auth->acl_get('u_mchat_quote'),
			'MCHAT_EDIT_DELETE_LIMIT'		=> 1000 * $this->config['mchat_edit_delete_limit'],
			'MCHAT_EDIT_DELETE_IGNORE'		=> $this->config['mchat_edit_delete_limit'] && $this->auth->acl_get('m_'),
			'MCHAT_RELATIVE_TIME'			=> $this->config['mchat_relative_time'],
			'MCHAT_USER_TIMEOUT'			=> 1000 * $this->config['mchat_timeout'],
			'S_MCHAT_AVATARS'				=> $this->display_avatars(),
			'EXT_URL'						=> generate_board_url() . '/ext/dmzx/mchat/',
			'STYLE_PATH'					=> generate_board_url() . '/styles/' . $this->user->style['style_path'],
		));
	}

	/**
	 * Returns true if we need do display avatars in the messages, otherwise false
	 *
	 * @return bool
	 */
	protected function display_avatars()
	{
		return $this->config['mchat_avatars'] && $this->user->optionget('viewavatars') && $this->user->data['user_mchat_avatars'];
	}

	/**
	 * Assigns all message rows to the template
	 *
	 * @param array $rows
	 * @param string $page
	 */
	protected function assign_messages($rows, $page = '')
	{
		if (!$rows)
		{
			return;
		}

		// Reverse the array if messages appear at the bottom
		if (!$this->config['mchat_message_top'])
		{
			$rows = array_reverse($rows);
		}

		$foes = $this->functions->mchat_foes();

		$this->template->destroy_block_vars('mchatrow');

		$user_avatars = array();

		foreach ($rows as $i => $row)
		{
			if (!isset($user_avatars[$row['user_id']]))
			{
				$display_avatar = $this->display_avatars() && $row['user_avatar'];
				$user_avatars[$row['user_id']] = !$display_avatar ? '' : phpbb_get_user_avatar(array(
					'avatar'		=> $row['user_avatar'],
					'avatar_type'	=> $row['user_avatar_type'],
					'avatar_width'	=> $row['user_avatar_width'] >= $row['user_avatar_height'] ? 40 : 0,
					'avatar_height'	=> $row['user_avatar_width'] >= $row['user_avatar_height'] ? 0 : 40,
				));
			}
		}

		$board_url = generate_board_url() . '/';

		foreach ($rows as $i => $row)
		{
			// Auth checks
			if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			$message_edit = $row['message'];
			decode_message($message_edit, $row['bbcode_uid']);

			if (in_array($row['user_id'], $foes))
			{
				$row['message'] = $this->user->lang('MCHAT_FOE', get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')));
			}

			$username_full = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST'));

			// Fix profile link root path by replacing relative paths with absolute board URL
			if ($this->request->is_ajax())
			{
				$username_full = preg_replace('#(?<=href=")[\./]+?/(?=\w)#', $board_url, $username_full);
			}

			$message_age = time() - $row['message_time'];
			$minutes_ago = $this->get_minutes_ago($message_age, $page);
			$datetime = $this->user->format_date($row['message_time'], $this->config['mchat_date']);

			$this->template->assign_block_vars('mchatrow', array(
				'MCHAT_ALLOW_BAN'		=> $this->auth->acl_get('a_authusers'),
				'MCHAT_ALLOW_EDIT'		=> $this->auth_message('u_mchat_edit', $row['user_id'], $row['message_time']),
				'MCHAT_ALLOW_DEL'		=> $this->auth_message('u_mchat_delete', $row['user_id'], $row['message_time']),
				'MCHAT_USER_AVATAR'		=> $user_avatars[$row['user_id']],
				'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$board_url}{$this->root_path}memberlist.{$this->php_ext}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
				'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
				'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$board_url}{$this->root_path}ucp.{$this->php_ext}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
				'MCHAT_MESSAGE_EDIT'	=> $message_edit,
				'MCHAT_MESSAGE_ID'		=> $row['message_id'],
				'MCHAT_USERNAME_FULL'	=> $username_full,
				'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_WHOIS_USER'		=> $this->user->lang('MCHAT_WHOIS_USER', $row['user_ip']),
				'MCHAT_U_IP'			=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'whois', 'ip' => $row['user_ip'])),
				'MCHAT_U_BAN'			=> append_sid("{$board_url}{$this->root_path}adm/index.{$this->php_ext}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
				'MCHAT_MESSAGE'			=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'MCHAT_TIME'			=> $minutes_ago === -1 ? $datetime : $this->user->lang('MCHAT_MINUTES_AGO', $minutes_ago),
				'MCHAT_DATETIME'		=> $datetime,
				'MCHAT_MINUTES_AGO'		=> $minutes_ago,
				'MCHAT_RELATIVE_UPDATE'	=> 60 - $message_age % 60,
				'MCHAT_MESSAGE_TIME'	=> $row['message_time'],
				'MCHAT_EDIT_TIME'		=> $row['edit_time'],
			));
		}
	}

	/**
	 * Calculates the number of minutes that have passed since the message was posted. If relative time is disabled
	 * or the message is older than 59 minutes or we render for the archive, -1 is returned.
	 *
	 * @param int $message_age
	 * @param string $page
	 * @return int
	 */
	protected function get_minutes_ago($message_age, $page)
	{
		if ($this->config['mchat_relative_time'] && $page != 'archive')
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
		$timeout = $this->config['session_length'];

		if ($this->config['mchat_timeout'])
		{
			$timeout = $this->config['mchat_timeout'];
		}

		return min(max((int) ceil($timeout / 60), 1), 60);
	}

	/**
	 * Assigns BBCodes and smilies to the template
	 */
	protected function assign_bbcodes_smilies()
	{
		// Display BBCodes
		if ($this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode'))
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
					'allow'			=> $this->config['allow_post_links'],
					'template_var'	=> 'S_LINKS_ALLOWED',
				),
				'flash'	=> array(
					'allow'			=> $this->config['allow_post_flash'],
					'template_var'	=> 'S_BBCODE_FLASH',
				),
			);

			foreach ($bbcode_template_vars as $bbcode => $option)
			{
				$is_disallowed = preg_match('#(^|\|)' . $bbcode . '($|\|)#Usi', $this->config['mchat_bbcode_disallowed']) || !$option['allow'];
				$this->template->assign_var($option['template_var'], !$is_disallowed);
			}

			$this->template->assign_var('S_DISALLOWED_BBCODES', str_replace('=', '-', $this->config['mchat_bbcode_disallowed']));

			if (!function_exists('display_custom_bbcodes'))
			{
				include($this->root_path . 'includes/functions_display.' . $this->php_ext);
			}

			$this->remove_disallowed_bbcodes = true;
			display_custom_bbcodes();
		}

		// Display smilies
		if ($this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies'))
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
	 * Assigns whois and stats at the bottom of the index page
	 */
	protected function assign_whois()
	{
		if ($this->config['mchat_whois'] || $this->config['mchat_stats_index'] && $this->user->data['user_mchat_stats_index'])
		{
			$mchat_stats = $this->functions->mchat_active_users();
			$this->template->assign_vars(array(
				'MCHAT_INDEX_STATS'		=> $this->config['mchat_stats_index'] && $this->user->data['user_mchat_stats_index'],
				'MCHAT_USERS_COUNT'		=> $mchat_stats['mchat_users_count'],
				'MCHAT_USERS_LIST'		=> $mchat_stats['online_userlist'] ?: '',
				'MCHAT_ONLINE_EXPLAIN'	=> $mchat_stats['refresh_message'],
			));
		}
	}

	/**
	 * Checks whether an author has edit or delete permissions for a message
	 *
	 * @param string $permission One of u_mchat_edit|u_mchat_delete
	 * @param int $author_id The user id of the message
	 * @param int $message_time The message created time
	 * @return bool
	 */
	protected function auth_message($permission, $author_id, $message_time)
	{
		if (!$this->auth->acl_get($permission))
		{
			return false;
		}

		if ($this->auth->acl_get('m_'))
		{
			return true;
		}

		$can_edit_delete = $this->config['mchat_edit_delete_limit'] == 0 || $message_time >= time() - $this->config['mchat_edit_delete_limit'];
		return $can_edit_delete && $this->user->data['user_id'] == $author_id && $this->user->data['is_registered'];
	}

	/**
	 * Performs bound checks on the message and returns an array containing the message,
	 * BBCode options and additional data ready to be sent to the database
	 *
	 * @param string $message
	 * @param array $merge_ary
	 * @return array
	 */
	protected function process_message($message, $merge_ary)
	{
		// Must have something other than bbcode in the message
		$message_chars = trim(preg_replace('#\[/?[^\[\]]+\]#mi', '', $message));
		if (!utf8_strlen($message_chars))
		{
			throw new \phpbb\exception\http_exception(501, 'MCHAT_NOACCESS');
		}

		// Must not exceed character limit, excluding whitespaces
		if ($this->config['mchat_max_message_lngth'])
		{
			$message_chars = preg_replace('#\s#m', '', $message);
			if (utf8_strlen($message_chars) > $this->config['mchat_max_message_lngth'])
			{
				throw new \phpbb\exception\http_exception(413, 'MCHAT_MESS_LONG', array($this->config['mchat_max_message_lngth']));
			}
		}

		// We override the $this->config['min_post_chars'] entry?
		if ($this->config['mchat_override_min_post_chars'])
		{
			$old_cfg['min_post_chars'] = $this->config['min_post_chars'];
			$this->config['min_post_chars'] = 0;
		}

		// We do the same for the max number of smilies?
		if ($this->config['mchat_override_smilie_limit'])
		{
			$old_cfg['max_post_smilies'] = $this->config['max_post_smilies'];
			$this->config['max_post_smilies'] = 0;
		}

		$mchat_bbcode	= $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_urls		= $this->config['allow_post_links'] && $this->auth->acl_get('u_mchat_urls');
		$mchat_smilies	= $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies');

		// Add function part code from http://wiki.phpbb.com/Parsing_text
		$uid = $bitfield = $options = '';
		generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_bbcode, $mchat_urls, $mchat_smilies);

		// Not allowed bbcodes
		if (!$mchat_bbcode)
		{
			$message = preg_replace('#\[/?[^\[\]]+\]#Usi', '', $message);
		}

		// Disallowed bbcodes
		if ($this->config['mchat_bbcode_disallowed'])
		{
			$bbcode_replace = array(
				'#\[(' . $this->config['mchat_bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
				'#\[/(' . $this->config['mchat_bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
			);

			$message = preg_replace($bbcode_replace, '', $message);
		}

		// Reset the config settings
		if (isset($old_cfg['min_post_chars']))
		{
			$this->config['min_post_chars'] = $old_cfg['min_post_chars'];
		}

		if (isset($old_cfg['max_post_smilies']))
		{
			$this->config['max_post_smilies'] = $old_cfg['max_post_smilies'];
		}

		return array_merge($merge_ary, array(
			'message'			=> str_replace("'", '&#39;', $message),
			'bbcode_bitfield'	=> $bitfield,
			'bbcode_uid'		=> $uid,
			'bbcode_options'	=> $options,
		));
	}

	/**
	 * Renders a template file and returns it
	 *
	 * @param string $template_file
	 * @return string
	 */
	protected function render_template($template_file)
	{
		$this->template->set_filenames(array('body' => $template_file));
		$content = $this->template->assign_display('body', '', true);

		return trim(str_replace(array("\r", "\n"), '', $content));
	}
}
