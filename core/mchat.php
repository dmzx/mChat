<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

class mchat
{
	/** @var \dmzx\mchat\core\functions_mchat */
	protected $functions_mchat;

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

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/** @var boolean */
	protected $is_mchat_rendered = false;

	/**
	 * Constructor
	 *
	 * @param \dmzx\mchat\core\functions_mchat	$functions_mchat
	 * @param \phpbb\config\config				$config
	 * @param \phpbb\controller\helper			$helper
	 * @param \phpbb\template\template			$template
	 * @param \phpbb\user						$user
	 * @param \phpbb\auth\auth					$auth
	 * @param \phpbb\pagination					$pagination
	 * @param \phpbb\request\request			$request
	 * @param \phpbb\event\dispatcher_interface $dispatcher
	 * @param string							$root_path
	 * @param string							$php_ext
	 */
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\event\dispatcher_interface $dispatcher, $root_path, $php_ext)
	{
		$this->functions_mchat	= $functions_mchat;
		$this->config			= $config;
		$this->helper			= $helper;
		$this->template			= $template;
		$this->user				= $user;
		$this->auth				= $auth;
		$this->pagination		= $pagination;
		$this->request			= $request;
		$this->dispatcher		= $dispatcher;
		$this->root_path		= $root_path;
		$this->php_ext			= $php_ext;
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
		if (!$this->auth->acl_get('u_mchat_view') || !$this->config['mchat_custom_page'])
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NO_CUSTOM_PAGE');
		}

		$this->functions_mchat->mchat_prune();

		$this->functions_mchat->mchat_add_user_session();

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

		$this->functions_mchat->mchat_prune();

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
			throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
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
		if (empty($this->config['mchat_rules']) && !$this->user->lang('MCHAT_RULES_MESSAGE'))
		{
			throw new \phpbb\exception\http_exception(404, 'MCHAT_NO_RULES');
		}

		// If the rules are defined in the language file use them, else just use the entry in the database
		$mchat_rules = $this->user->lang('MCHAT_RULES_MESSAGE');
		$mchat_rules = !empty($mchat_rules) ? $mchat_rules : $this->config['mchat_rules'];
		$mchat_rules = explode("\n", $mchat_rules);
		$mchat_rules = array_map('htmlspecialchars_decode', $mchat_rules);
		$mchat_rules = implode('<br />', $mchat_rules);

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

		if ($this->functions_mchat->mchat_is_user_flooding())
		{
			throw new \phpbb\exception\http_exception(400, 'MCHAT_NOACCESS');
		}

		$message = $this->request->variable('message', '', true);

		$sql_ary = $this->process_message(utf8_ucfirst($message), array(
			'user_id'			=> $this->user->data['user_id'],
			'user_ip'			=> $this->user->data['session_ip'],
			'message_time'		=> time(),
		));

		$this->functions_mchat->mchat_action('add', $sql_ary);

		/**
		 * Event render_helper_add
		 *
		 * @event dmzx.mchat.core.render_helper_add
		 * @since 0.1.2
		 */
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_add');

		return $this->action_refresh();
	}

	/**
	 * User edits a message
	 *
	 * @return array data sent to client as JSON
	 */
	public function action_edit()
	{
		// Fix avatar path when editing archived messages
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}

		$message_id = $this->request->variable('message_id', 0);

		if (!$message_id || !check_form_key('mchat', -1))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		$author = $this->functions_mchat->mchat_author_for_message($message_id);

		if (!$author || !$this->auth_message('u_mchat_edit', $author['user_id'], $author['message_time']))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		$message = $this->request->variable('message', '', true);

		$sql_ary = $this->process_message($message, array(
			'edit_time' => time(),
		));

		// TODO Don't update the message if the user submitted it unedited
		$this->functions_mchat->mchat_action('edit', $sql_ary, $message_id, $author['username']);

		/**
		 * Event render_helper_edit
		 *
		 * @event dmzx.mchat.core.render_helper_edit
		 * @since 0.1.4
		 */
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_edit');

		$sql_where = 'm.message_id = ' . (int) $message_id;
		$rows = $this->functions_mchat->mchat_get_messages($sql_where, 1);

		$this->assign_global_template_data();
		$this->assign_messages($rows);

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

		$author = $this->functions_mchat->mchat_author_for_message($message_id);

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

		$this->functions_mchat->mchat_action('del', null, $message_id, $author['username']);

		return array('del' => true);
	}

	/**
	 * User checks for new messages
	 *
	 * @return array sent to client as JSON
	 */
	public function action_refresh()
	{
		$message_first_id = $this->request->variable('message_first_id', 0);
		$message_last_id = $this->request->variable('message_last_id', 0);
		$message_edits = $this->request->variable('message_edits', array(0));

		// Request new messages
		$sql_where = 'm.message_id > ' . (int) $message_last_id;

		// Request edited messages
		if ($this->config['mchat_live_updates'] && $message_last_id > 0)
		{
			$sql_time_limit = $this->config['mchat_edit_delete_limit'] ? sprintf(' AND m.message_time > %d', time() - $this->config['mchat_edit_delete_limit']) : '';
			$sql_where .= sprintf(' OR (m.message_id BETWEEN %d AND %d AND m.edit_time > 0%s)', (int) $message_first_id , (int) $message_last_id, $sql_time_limit);
		}

		// Exclude post notifications
		if (!$this->user->data['user_mchat_topics'])
		{
			$sql_where = '(' . $sql_where . ') AND m.forum_id = 0';
		}

		$rows = $this->functions_mchat->mchat_get_messages($sql_where);
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

		// Assign new messages
		$this->assign_global_template_data();
		$this->assign_messages($rows_refresh);
		$response = array('refresh' => true, 'add' => $this->render_template('mchat_messages.html'));

		// Assign edited messages
		if (!empty($rows_edit))
		{
			$response['edit'] = array();
			foreach ($rows_edit as $row)
			{
				$this->assign_messages(array($row));
				$response['edit'][$row['message_id']] = $this->render_template('mchat_messages.html');
			}
		}

		// Request deleted messages
		if ($this->config['mchat_live_updates'] && $message_last_id > 0)
		{
			$deleted_message_ids = $this->functions_mchat->mchat_missing_ids($message_first_id, $message_last_id);
			if (!empty($deleted_message_ids))
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
			'S_MCHAT_CUSTOM_PAGE'	=> $this->config['mchat_custom_page'],
			'U_MCHAT'				=> $this->helper->route('dmzx_mchat_controller'),
		));
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
		if ($this->is_mchat_rendered)
		{
			$sql_ary['WHERE'] = $this->functions_mchat->mchat_sql_append_forbidden_bbcodes($sql_ary['WHERE']);
		}

		return $sql_ary;
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
		$static_message = !empty($lang_static_message) ? $lang_static_message : $this->config['mchat_static_message'];

		$this->template->assign_vars(array(
			'MCHAT_FILE_NAME'				=> $this->helper->route('dmzx_mchat_controller'),
			'MCHAT_REFRESH_JS'				=> 1000 * $this->config['mchat_refresh'],
			'MCHAT_INPUT_TYPE'				=> $this->user->data['user_mchat_input_area'],
			'MCHAT_RULES'					=> $this->user->lang('MCHAT_RULES_MESSAGE') || !empty($this->config['mchat_rules']),
			'MCHAT_ALLOW_USE'				=> $this->auth->acl_get('u_mchat_use'),
			'MCHAT_ALLOW_SMILES'			=> $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies'),
			'MCHAT_ALLOW_BBCODES'			=> $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode'),
			'MCHAT_MESSAGE_TOP'				=> $this->config['mchat_message_top'],
			'MCHAT_ARCHIVE_URL'				=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive')),
			'MCHAT_INDEX_HEIGHT'			=> $this->config['mchat_index_height'],
			'MCHAT_CUSTOM_HEIGHT'			=> $this->config['mchat_custom_height'],
			'MCHAT_READ_ARCHIVE_BUTTON'		=> $this->auth->acl_get('u_mchat_archive'),
			'MCHAT_STATIC_MESS'				=> htmlspecialchars_decode($static_message),
			'L_MCHAT_COPYRIGHT'				=> base64_decode('PGEgaHJlZj0iaHR0cDovL3JtY2dpcnI4My5vcmciPlJNY0dpcnI4MzwvYT4gJmNvcHk7IDxhIGhyZWY9Imh0dHA6Ly93d3cuZG16eC13ZWIubmV0IiB0aXRsZT0id3d3LmRtengtd2ViLm5ldCI+ZG16eDwvYT4='),
			'MCHAT_MESSAGE_LNGTH'			=> $this->config['mchat_max_message_lngth'],
			'MCHAT_MESS_LONG'				=> sprintf($this->user->lang('MCHAT_MESS_LONG'), $this->config['mchat_max_message_lngth']),
			'MCHAT_USER_TIMEOUT_TIME'		=> gmdate('H:i:s', (int) $this->config['mchat_timeout']),
			'MCHAT_WHOIS_REFRESH'			=> $this->config['mchat_whois'] ? 1000 * $this->config['mchat_whois_refresh'] : 0,
			'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> sprintf($this->user->lang('WHO_IS_REFRESH_EXPLAIN'), $this->config['mchat_whois_refresh']),
			'MCHAT_PAUSE_ON_INPUT'			=> $this->config['mchat_pause_on_input'],
			'MCHAT_REFRESH_YES'				=> sprintf($this->user->lang('MCHAT_REFRESH_YES'), $this->config['mchat_refresh']),
			'MCHAT_LIVE_UPDATES'			=> $this->config['mchat_live_updates'],
			'S_MCHAT_LOCATION'				=> $this->config['mchat_location'],
			'S_MCHAT_SOUND_YES'				=> $this->user->data['user_mchat_sound'],
			'U_MORE_SMILIES'				=> generate_board_url() . append_sid("/{$this->root_path}/posting.{$this->php_ext}", 'mode=smilies'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'rules')),
			'S_MCHAT_ON_INDEX'				=> $this->config['mchat_on_index'] && !empty($this->user->data['user_mchat_index']),
		));

		$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'm.forum_id = 0';
		$limit = $page == 'archive' ? $this->config['mchat_archive_limit'] : $this->config[$page == 'index' ? 'mchat_message_num' : 'mchat_message_limit'];
		$start = $page == 'archive' ? $this->request->variable('start', 0) : 0;
		$rows = $this->functions_mchat->mchat_get_messages($sql_where, $limit, $start);

		$this->assign_global_template_data();
		$this->assign_messages($rows);

		// Render pagination
		if ($page == 'archive')
		{
			$archive_url = $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive'));
			$total_messages = $this->functions_mchat->mchat_total_message_count();
			$this->pagination->generate_template_pagination($archive_url, 'pagination', 'start', $total_messages, $limit, $start);
			$this->template->assign_var('MCHAT_TOTAL_MESSAGES', sprintf($this->user->lang('MCHAT_TOTALMESSAGES'), $total_messages));
		}

		// Render legend
		if ($page != 'index' && $this->config['mchat_whois'])
		{
			$legend = $this->functions_mchat->mchat_legend();
			$this->template->assign_var('LEGEND', implode(', ', $legend));
		}

		if ($this->auth->acl_get('u_mchat_use'))
		{
			add_form_key('mchat');
		}

		$this->is_mchat_rendered = true;

		/**
		* Event render_helper_aft
		*
		* @event dmzx.mchat.core.render_helper_aft
		* @since 0.1.2
		*/
		$this->dispatcher->dispatch('dmzx.mchat.core.render_helper_aft');
	}

	/**
	 * Assigns all message rows to the template
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
	 */
	protected function assign_messages($rows)
	{
		if (empty($rows))
		{
			return;
		}

		// Reverse the array if messages appear at the bottom
		if (!$this->config['mchat_message_top'])
		{
			$rows = array_reverse($rows);
		}

		$foes = $this->functions_mchat->mchat_foes();

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

		foreach ($rows as $i => $row)
		{
			// Auth checks
			if ($row['forum_id'] != 0 && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			$message_edit = $row['message'];
			decode_message($message_edit, $row['bbcode_uid']);
			$message_edit = str_replace('"', '&quot;', $message_edit);
			$message_edit = mb_ereg_replace("'", '&#146;', $message_edit);

			if (in_array($row['user_id'], $foes))
			{
				$row['message'] = sprintf($this->user->lang('MCHAT_FOE'), get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')));
			}

			$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
			$message = str_replace("'", '&rsquo;', $row['message']);

			$this->template->assign_block_vars('mchatrow', array(
				'S_ROW_COUNT'			=> $i,
				'MCHAT_ALLOW_BAN'		=> $this->auth->acl_get('a_authusers'),
				'MCHAT_ALLOW_EDIT'		=> $this->auth_message('u_mchat_edit', $row['user_id'], $row['message_time']),
				'MCHAT_ALLOW_DEL'		=> $this->auth_message('u_mchat_delete', $row['user_id'], $row['message_time']),
				'MCHAT_USER_AVATAR'		=> $user_avatars[$row['user_id']],
				'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? generate_board_url() . append_sid("/{$this->root_path}memberlist.{$this->php_ext}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
				'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
				'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? generate_board_url() . append_sid("/{$this->root_path}ucp.{$this->php_ext}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
				'MCHAT_MESSAGE_EDIT'	=> $message_edit,
				'MCHAT_MESSAGE_ID'		=> $row['message_id'],
				'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_WHOIS_USER'		=> $this->user->lang('MCHAT_WHOIS_USER', $row['user_ip']),
				'MCHAT_U_IP'			=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'whois', 'ip' => $row['user_ip'])),
				'MCHAT_U_BAN'			=> generate_board_url() . append_sid("/{$this->root_path}adm/index.{$this->php_ext}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
				'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
				'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $this->config['mchat_date']),
				'MCHAT_MESSAGE_TIME'	=> $row['message_time'],
				'MCHAT_EDIT_TIME'		=> $row['edit_time'],
			));
		}
	}

	/**
	 * Assigns BBCodes and smilies to the template
	 */
	protected function assign_bbcodes_smilies()
	{
		// Display custom bbcodes
		if ($this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode'))
		{
			$default_bbcodes = array('B', 'I', 'U', 'QUOTE', 'CODE', 'LIST', 'IMG', 'URL', 'SIZE', 'COLOR', 'EMAIL', 'FLASH');

			// Let's remove the default bbcodes
			$disallowed_bbcode_array = explode('|', strtoupper($this->config['mchat_bbcode_disallowed']));

			foreach ($default_bbcodes as $default_bbcode)
			{
				if (!in_array($default_bbcode, $disallowed_bbcode_array))
				{
					$this->template->assign_vars(array(
						'S_MCHAT_BBCODE_' . $default_bbcode => true,
					));
				}
			}

			if (!function_exists('display_custom_bbcodes'))
			{
				include($this->root_path . 'includes/functions_display.' . $this->php_ext);
			}

			display_custom_bbcodes();
		}

		// Smile row
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
	 * Assigns whois and stats at the bottom of the index page
	 */
	protected function assign_whois()
	{
		if ($this->config['mchat_whois'] || $this->config['mchat_stats_index'] && $this->user->data['user_mchat_stats_index'])
		{
			$mchat_stats = $this->functions_mchat->mchat_active_users();
			$this->template->assign_vars(array(
				'MCHAT_INDEX_STATS'		=> $this->config['mchat_stats_index'] && $this->user->data['user_mchat_stats_index'],
				'MCHAT_USERS_COUNT'		=> $mchat_stats['mchat_users_count'],
				'MCHAT_USERS_LIST'		=> !empty($mchat_stats['online_userlist']) ? $mchat_stats['online_userlist'] : '',
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
		if (!$message || !utf8_strlen($message_chars))
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
