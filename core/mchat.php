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

	/** @var \dmzx\mchat\core\settings */
	protected $settings;

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

	/** @var \phpbb\collapsiblecategories\operator\operator */
	protected $cc_operator;

	/** @var boolean */
	protected $remove_disallowed_bbcodes = false;

	/**
	 * Constructor
	 *
	 * @param \dmzx\mchat\core\functions						$functions
	 * @param \dmzx\mchat\core\settings							$settings
	 * @param \phpbb\controller\helper							$helper
	 * @param \phpbb\template\template							$template
	 * @param \phpbb\user										$user
	 * @param \phpbb\auth\auth									$auth
	 * @param \phpbb\pagination									$pagination
	 * @param \phpbb\request\request							$request
	 * @param \phpbb\event\dispatcher_interface 				$dispatcher
	 * @param \phpbb\extension\manager 							$extension_manager
	 * @param string											$root_path
	 * @param string											$php_ext
	 * @param \phpbb\collapsiblecategories\operator\operator	$cc_operator
	 */
	public function __construct(\dmzx\mchat\core\functions $functions, \dmzx\mchat\core\settings $settings, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\event\dispatcher_interface $dispatcher, \phpbb\extension\manager $extension_manager, $root_path, $php_ext, \phpbb\collapsiblecategories\operator\operator $cc_operator = null)
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
			throw new \phpbb\exception\http_exception(403, 'NOT_AUTHORISED');
		}

		if (!$this->settings->cfg('mchat_custom_page'))
		{
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NO_CUSTOM_PAGE');
		}

		$this->functions->mchat_prune();

		$this->functions->mchat_add_user_session();

		$this->assign_whois();

		$this->assign_bbcodes_smilies();

		$this->template->assign_var('MCHAT_IS_CUSTOM_PAGE', true);

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

		$this->template->assign_var('MCHAT_IS_ARCHIVE_PAGE', true);

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
		if (!$this->settings->cfg('mchat_rules') && !$lang_rules)
		{
			throw new \phpbb\exception\http_exception(404, 'MCHAT_NO_RULES');
		}

		// If the rules are defined in the language file use them, else just use the entry in the database
		$mchat_rules = $lang_rules ?: $this->settings->cfg('mchat_rules');
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

		if ($this->settings->cfg('mchat_capital_letter'))
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

		$this->template->assign_var('MCHAT_IS_ARCHIVE_PAGE', $this->request->variable('archive', false));

		$message = $this->request->variable('message', '', true);

		$sql_ary = $this->process_message($message, array(
			'edit_time' => time(),
		));

		$this->functions->mchat_action('edit', $sql_ary, $message_id);

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

		$this->functions->mchat_action('del', null, $message_id);

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
		if (!$this->settings->cfg('mchat_timeout'))
		{
			$this->user->update_session_infos();
		}

		$message_first_id = $this->request->variable('message_first_id', 0);
		$message_last_id = $this->request->variable('message_last_id', 0);
		$message_edits = $this->request->variable('message_edits', array(0));

		// Request new messages
		$sql_where = 'm.message_id > ' . (int) $message_last_id;

		// Request edited messages
		if ($this->settings->cfg('mchat_live_updates') && $message_last_id > 0)
		{
			$sql_where .= sprintf(' OR (m.message_id BETWEEN %d AND %d AND m.edit_time > 0)', (int) $message_first_id , (int) $message_last_id);
			if ($this->settings->cfg('mchat_edit_delete_limit'))
			{
				$sql_where .= sprintf(' AND m.message_time > %d', time() - $this->settings->cfg('mchat_edit_delete_limit'));
			}
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
		if ($this->settings->cfg('mchat_live_updates') && $message_last_id > 0)
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
			'MCHAT_NAVBAR_LINK'		=> $this->settings->cfg('mchat_navbar_link'),
			'MCHAT_CUSTOM_PAGE'		=> $this->settings->cfg('mchat_custom_page'),
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
		$static_message = $lang_static_message ?: $this->settings->cfg('mchat_static_message');

		$u_mchat_use = $this->auth->acl_get('u_mchat_use');

		$this->template->assign_vars(array(
			'MCHAT_ALLOW_USE'				=> $u_mchat_use,
			'S_BBCODE_ALLOWED'				=> $this->settings->cfg('allow_bbcode') && $this->auth->acl_get('u_mchat_bbcode'),
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
			'MCHAT_WHOIS_REFRESH'			=> $this->settings->cfg('mchat_whois') ? $this->settings->cfg('mchat_whois_refresh') * 1000 : 0,
			'MCHAT_REFRESH_JS'				=> $this->settings->cfg('mchat_refresh') * 1000,
			'MCHAT_ARCHIVE'					=> $this->auth->acl_get('u_mchat_archive'),
			'MCHAT_RULES'					=> $this->user->lang('MCHAT_RULES_MESSAGE') || $this->settings->cfg('mchat_rules'),
			'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> $this->user->lang('MCHAT_WHO_IS_REFRESH_EXPLAIN', $this->settings->cfg('mchat_whois_refresh')),
			'MCHAT_SESSION_TIMELEFT'		=> $this->user->lang('MCHAT_SESSION_ENDS', gmdate('H:i:s', (int) $this->settings->cfg('mchat_timeout'))),
			'MCHAT_STATIC_MESS'				=> htmlspecialchars_decode($static_message),
			'A_MCHAT_MESS_LONG'				=> addslashes($this->user->lang('MCHAT_MESS_LONG', $this->settings->cfg('mchat_max_message_lngth'))),
			'A_MCHAT_REFRESH_YES'			=> addslashes($this->user->lang('MCHAT_REFRESH_YES', $this->settings->cfg('mchat_refresh'))),
			'U_MCHAT_CUSTOM_PAGE'			=> $this->helper->route('dmzx_mchat_controller'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'rules')),
			'U_MCHAT_ARCHIVE_URL'			=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive')),
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
			'edit'		=> $this->auth_message('u_mchat_edit', true, time()),
			'del'		=> $this->auth_message('u_mchat_delete', true, time()),
			'refresh'	=> $page !== 'archive' && $this->auth->acl_get('u_mchat_view'),
			'add'		=> $page !== 'archive' && $u_mchat_use,
			'whois'		=> $page !== 'archive' && $this->settings->cfg('mchat_whois'),
		)));

		foreach ($actions as $i => $action)
		{
			$this->template->assign_block_vars('mchaturl', array(
				'ACTION'	=> $action,
				'URL'		=> $this->helper->route('dmzx_mchat_action_controller', array('action' => $action)),
				'IS_LAST'	=> $i + 1 === count($actions),
			));
		}

		$limit = $this->settings->cfg('mchat_message_num_' . $page);
		$start = $page === 'archive' ? $this->request->variable('start', 0) : 0;
		$rows = $this->functions->mchat_get_messages('', $limit, $start);

		$this->assign_global_template_data();
		$this->assign_messages($rows);

		// Render pagination
		if ($page === 'archive')
		{
			$archive_url = $this->helper->route('dmzx_mchat_page_controller', array('page' => 'archive'));
			$total_messages = $this->functions->mchat_total_message_count();
			$this->pagination->generate_template_pagination($archive_url, 'pagination', 'start', $total_messages, $limit, $start);
			$this->template->assign_var('MCHAT_TOTAL_MESSAGES', $this->user->lang('MCHAT_TOTALMESSAGES', $total_messages));
		}

		// Render legend
		if ($page !== 'index' && $this->settings->cfg('mchat_whois'))
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

		if ($u_mchat_use)
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
	 * Assigns author names and homepages for copyright
	 */
	protected function assign_authors()
	{
		$md_manager = $this->extension_manager->create_extension_metadata_manager('dmzx/mchat', $this->template);
		$meta = $md_manager->get_metadata();

		$author_names = array();
		$author_homepages = array();

		foreach ($meta['authors'] as $author)
		{
			$author_names[] = $author['name'];
			$author_homepages[] = sprintf('<a href="%1$s" title="%2$s">%2$s</a>', $author['homepage'], $author['name']);
		}

		$this->template->assign_vars(array(
			'MCHAT_DISPLAY_NAME'		=> $meta['extra']['display-name'],
			'MCHAT_AUTHOR_NAMES'		=> implode(' &bull; ', $author_names),
			'MCHAT_AUTHOR_HOMEPAGES'	=> implode(' &bull; ', $author_homepages),
		));
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
			'MCHAT_ALLOW_PERMISSIONS'		=> $this->auth->acl_get('a_authusers'),
			'MCHAT_EDIT_DELETE_LIMIT'		=> 1000 * $this->settings->cfg('mchat_edit_delete_limit'),
			'MCHAT_EDIT_DELETE_IGNORE'		=> $this->settings->cfg('mchat_edit_delete_limit') && $this->auth->acl_get('m_'),
			'MCHAT_RELATIVE_TIME'			=> $this->settings->cfg('mchat_relative_time'),
			'MCHAT_USER_TIMEOUT'			=> 1000 * $this->settings->cfg('mchat_timeout'),
			'S_MCHAT_AVATARS'				=> $this->display_avatars(),
			'EXT_URL'						=> generate_board_url() . '/ext/dmzx/mchat/',
			'STYLE_PATH'					=> generate_board_url() . '/styles/' . rawurlencode($this->user->style['style_path']),
		));
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
	 */
	protected function assign_messages($rows)
	{
		// Auth checks
		foreach ($rows as $i => $row)
		{
			if ($row['forum_id'])
			{
				// No permission to read forum
				if (!$this->auth->acl_get('f_read', $row['forum_id']))
				{
					unset($rows[$i]);
				}

				// Post is not approved and no approval permission
				if ($row['post_visibility'] !== ITEM_APPROVED && !$this->auth->acl_get('m_approve', $row['forum_id']))
				{
					unset($rows[$i]);
				}
			}
		}

		if (!$rows)
		{
			return;
		}

		// Reverse the array if messages appear at the bottom
		if (!$this->settings->cfg('mchat_message_top'))
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
			$message_for_edit = generate_text_for_edit($row['message'], $row['bbcode_uid'], $row['bbcode_options']);

			$username_full = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST'));

			// Fix profile link root path by replacing relative paths with absolute board URL
			if ($this->request->is_ajax())
			{
				$username_full = preg_replace('#(?<=href=")[\./]+?/(?=\w)#', $board_url, $username_full);
			}

			if (in_array($row['user_id'], $foes))
			{
				$row['message'] = $this->user->lang('MCHAT_FOE', $username_full);
			}

			$message_age = time() - $row['message_time'];
			$minutes_ago = $this->get_minutes_ago($message_age);
			$datetime = $this->user->format_date($row['message_time'], $this->settings->cfg('mchat_date'));

			$is_poster = $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'];

			$this->template->assign_block_vars('mchatrow', array(
				'MCHAT_ALLOW_EDIT'			=> $this->auth_message('u_mchat_edit', $row['user_id'], $row['message_time']),
				'MCHAT_ALLOW_DEL'			=> $this->auth_message('u_mchat_delete', $row['user_id'], $row['message_time']),
				'MCHAT_USER_AVATAR'			=> $user_avatars[$row['user_id']],
				'U_VIEWPROFILE'				=> $row['user_id'] != ANONYMOUS ? append_sid("{$board_url}{$this->root_path}memberlist.{$this->php_ext}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
				'MCHAT_IS_POSTER'			=> $is_poster,
				'MCHAT_PM'					=> !$is_poster && $this->settings->cfg('allow_privmsg') && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$board_url}{$this->root_path}ucp.{$this->php_ext}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
				'MCHAT_MESSAGE_EDIT'		=> $message_for_edit['text'],
				'MCHAT_MESSAGE_ID'			=> $row['message_id'],
				'MCHAT_USERNAME_FULL'		=> $username_full,
				'MCHAT_USERNAME'			=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME_COLOR'		=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_WHOIS_USER'			=> $this->user->lang('MCHAT_WHOIS_USER', $row['user_ip']),
				'MCHAT_U_IP'				=> $this->helper->route('dmzx_mchat_page_controller', array('page' => 'whois', 'ip' => $row['user_ip'])),
				'MCHAT_U_PERMISSIONS'		=> append_sid("{$board_url}{$this->root_path}adm/index.{$this->php_ext}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
				'MCHAT_MESSAGE'				=> generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'MCHAT_TIME'				=> $minutes_ago === -1 ? $datetime : $this->user->lang('MCHAT_MINUTES_AGO', $minutes_ago),
				'MCHAT_DATETIME'			=> $datetime,
				'MCHAT_MINUTES_AGO'			=> $minutes_ago,
				'MCHAT_RELATIVE_UPDATE'		=> 60 - $message_age % 60,
				'MCHAT_MESSAGE_TIME'		=> $row['message_time'],
				'MCHAT_EDIT_TIME'			=> $row['edit_time'],
			));
		}
	}

	/**
	 * Calculates the number of minutes that have passed since the message was posted. If relative time is disabled
	 * or the message is older than 59 minutes or we render for the archive, -1 is returned.
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

			$this->template->assign_var('A_MCHAT_DISALLOWED_BBCODES', addslashes(str_replace('=', '-', $this->settings->cfg('mchat_bbcode_disallowed'))));

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
		foreach (array_keys($this->settings->ucp) as $config_name)
		{
			$sql_ary['user_' . $config_name] = $this->settings->cfg($config_name, true);
		}

		return $sql_ary;
	}

	/** Inserts a message with posting information into the database
	 *
	 * @param string $mode One of post|quote|edit|reply
	 * @param $data The post data
	 */
	public function insert_posting($mode, $data)
	{
		$this->functions->mchat_insert_posting($mode, $data);
	}

	/**
	 * Assigns whois and stats at the bottom of the index page
	 */
	protected function assign_whois()
	{
		if ($this->settings->cfg('mchat_whois') || $this->settings->cfg('mchat_stats_index') && $this->settings->cfg('mchat_stats_index'))
		{
			$mchat_stats = $this->functions->mchat_active_users();
			$this->template->assign_vars(array(
				'MCHAT_STATS_INDEX'		=> $this->settings->cfg('mchat_stats_index') && $this->settings->cfg('mchat_stats_index'),
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

		$can_edit_delete = !$this->settings->cfg('mchat_edit_delete_limit') || $message_time >= time() - $this->settings->cfg('mchat_edit_delete_limit');
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

		// Must not exceed character limit
		if ($this->settings->cfg('mchat_max_message_lngth'))
		{
			if (utf8_strlen($message_chars) > $this->settings->cfg('mchat_max_message_lngth'))
			{
				throw new \phpbb\exception\http_exception(413, 'MCHAT_MESS_LONG', array($this->settings->cfg('mchat_max_message_lngth')));
			}
		}

		$cfg_min_post_chars = $this->settings->cfg('min_post_chars');
		$cfg_max_post_smilies = $this->settings->cfg('max_post_smilies');

		// We override the $this->settings->cfg('min_post_chars') entry?
		if ($this->settings->cfg('mchat_override_min_post_chars'))
		{
			$this->settings->set_cfg('min_post_chars', 0);
		}

		// We do the same for the max number of smilies?
		if ($this->settings->cfg('mchat_override_smilie_limit'))
		{
			$this->settings->cfg('max_post_smilies', 0);
		}

		$mchat_bbcode	= $this->settings->cfg('allow_bbcode') && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_urls		= $this->settings->cfg('allow_post_links') && $this->auth->acl_get('u_mchat_urls');
		$mchat_smilies	= $this->settings->cfg('allow_smilies') && $this->auth->acl_get('u_mchat_smilies');

		// Add function part code from http://wiki.phpbb.com/Parsing_text
		$uid = $bitfield = $options = '';
		generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_bbcode, $mchat_urls, $mchat_smilies);

		// Not allowed bbcodes
		if (!$mchat_bbcode)
		{
			$message = preg_replace('#\[/?[^\[\]]+\]#Usi', '', $message);
		}

		// Disallowed bbcodes
		if ($this->settings->cfg('mchat_bbcode_disallowed'))
		{
			$bbcode_replace = array(
				'#\[(' . $this->settings->cfg('mchat_bbcode_disallowed') . ')[^\[\]]+\]#Usi',
				'#\[/(' . $this->settings->cfg('mchat_bbcode_disallowed') . ')[^\[\]]+\]#Usi',
			);

			$message = preg_replace($bbcode_replace, '', $message);
		}

		// Reset the config settings
		$this->settings->set_cfg('min_post_chars', $cfg_min_post_chars);
		$this->settings->set_cfg('max_post_smilies', $cfg_max_post_smilies);

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
