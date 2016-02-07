<?php
/**
*
* @package phpBB Extension - mChat
* @copyright (c) 2015 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\mchat\ucp;

class ucp_mchat_module
{
	function main($id, $mode)
	{
		global $cache, $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx, $request;

		$submit = (isset($_POST['submit'])) ? true : false;
		$error = $data = array();

		switch ($mode)
		{
			case 'configuration':

				$data = array(
					'user_mchat_index'			=> $request->variable('user_mchat_index', (bool) $user->data['user_mchat_index']),
					'user_mchat_sound'			=> $request->variable('user_mchat_sound', (bool) $user->data['user_mchat_sound']),
					'user_mchat_stats_index'	=> $request->variable('user_mchat_stats_index', (bool) $user->data['user_mchat_stats_index']),
					'user_mchat_topics'			=> $request->variable('user_mchat_topics', (bool) $user->data['user_mchat_topics']),
					'user_mchat_avatars'		=> $request->variable('user_mchat_avatars', (bool) $user->data['user_mchat_avatars']),
					'user_mchat_input_area'		=> $request->variable('user_mchat_input_area', (bool) $user->data['user_mchat_input_area']),
				);

				add_form_key('ucp_mchat');

				if ($submit)
				{
					if (!check_form_key('ucp_mchat'))
					{
						$error[] = 'FORM_INVALID';
					}

					if (!sizeof($error))
					{
						$sql_ary = array(
							'user_mchat_index'		=> $data['user_mchat_index'],
							'user_mchat_sound'		=> $data['user_mchat_sound'],
							'user_mchat_stats_index'	=> $data['user_mchat_stats_index'],
							'user_mchat_topics'		=> $data['user_mchat_topics'],
							'user_mchat_avatars'	=> $data['user_mchat_avatars'],
							'user_mchat_input_area'	=> $data['user_mchat_input_area'],
						);

						if (sizeof($sql_ary))
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE user_id = ' . (int) $user->data['user_id'];
							$db->sql_query($sql);
						}

						meta_refresh(3, $this->u_action);
						$message = $user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}

					// Replace "error" strings with their real, localised form
					// The /e modifier is deprecated since PHP 5.5.0
					//$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
					foreach ($error as $i => $err)
					{
						$lang = $this->user->lang($err);
						if (!empty($lang))
						{
							$error[$i] = $lang;
						}
					}
				}

				$template->assign_vars(array(
					'ERROR'			=> (sizeof($error)) ? implode('<br />', $error) : '',

					'S_DISPLAY_MCHAT'		=> $data['user_mchat_index'],
					'S_SOUND_MCHAT'			=> $data['user_mchat_sound'],
					'S_STATS_MCHAT'			=> $data['user_mchat_stats_index'],
					'S_TOPICS_MCHAT'		=> $data['user_mchat_topics'],
					'S_AVATARS_MCHAT'		=> $data['user_mchat_avatars'],
					'S_INPUT_MCHAT'			=> $data['user_mchat_input_area'],
					'S_MCHAT_TOPICS'		=> $config['mchat_new_posts_edit'] || $config['mchat_new_posts_quote'] || $config['mchat_new_posts_reply'] || $config['mchat_new_posts_topic'],
					'S_MCHAT_INDEX'			=> $config['mchat_on_index'],
					'S_MCHAT_INDEX_STATS'	=> $config['mchat_stats_index'],
					'S_MCHAT_AVATARS'		=> $config['mchat_avatars'],
				));
			break;

		}

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang['UCP_PROFILE_MCHAT'],
			'S_UCP_ACTION'		=> $this->u_action
		));

		// Set desired template
		$this->tpl_name = 'ucp_mchat';
		$this->page_title = 'UCP_PROFILE_MCHAT';
	}
}
