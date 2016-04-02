<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\migrations;

class mchat_2_0_0_rc3 extends \phpbb\db\migration\migration
{
	/** @var array */
	protected $mchat_config = null;

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v317pl1');
	}

	protected function get_config()
	{
		if ($this->mchat_config == null)
		{
			$yml_config_file = $this->phpbb_root_path . '/ext/dmzx/mchat/config/config_2_0_0.yml';
			$yml_data = \Symfony\Component\Yaml\Yaml::parse($yml_config_file);
			$this->mchat_config = $yml_data['parameters'];
		}

		return $this->mchat_config;
	}

	public function update_data()
	{
		$config = $this->get_config();
		$update_data = array();

		// Add configs
		foreach (array('dmzx.mchat.config_global', 'dmzx.mchat.config_ucp') as $section)
		{
			foreach ($config[$section] as $key => $value)
			{
				$update_data[] = array('config.add', array($key, $value['default']));
			}
		}

		// Add user permissions for customizing config values
		foreach ($config['dmzx.mchat.config_ucp'] as $key => $value)
		{
			$update_data[] = array('permission.add', array('u_' . $key, true));
		}

		return array_merge($update_data, array(
			array('config.add', array('mchat_version', '2.0.0-RC3')),

			// Add user permissions
			array('permission.add', array('u_mchat_use', true)),
			array('permission.add', array('u_mchat_view', true)),
			array('permission.add', array('u_mchat_edit', true)),
			array('permission.add', array('u_mchat_delete', true)),
			array('permission.add', array('u_mchat_ip', true)),
			array('permission.add', array('u_mchat_pm', true)),
			array('permission.add', array('u_mchat_like', true)),
			array('permission.add', array('u_mchat_quote', true)),
			array('permission.add', array('u_mchat_flood_ignore', true)),
			array('permission.add', array('u_mchat_archive', true)),
			array('permission.add', array('u_mchat_bbcode', true)),
			array('permission.add', array('u_mchat_smilies', true)),
			array('permission.add', array('u_mchat_urls', true)),

			// Add admin permissions
			array('permission.add', array('a_mchat', true)),

			// Set permissions
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_edit', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_delete', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_ip', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'u_mchat_flood_ignore', 'group')),
			array('permission.permission_set', array('ADMINISTRATORS', 'a_mchat', 'group')),

			array('permission.permission_set', array('REGISTERED', 'u_mchat_use', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_view', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_pm', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_like', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_quote', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_archive', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_bbcode', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_smilies', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_urls', 'group')),

			array('permission.permission_set', array('REGISTERED', 'u_mchat_avatars', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_capital_letter', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_character_count', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_index', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_input_area', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_location', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_message_top', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_posts', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_relative_time', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_mchat_sound', 'group')),

			// Add ACP extension category
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_CAT_MCHAT'
			)),

			// Add ACP preferences module
			array('module.add', array(
				'acp',
				'ACP_CAT_MCHAT',
				array('module_basename' => '\dmzx\mchat\acp\acp_mchat_module'),
			)),

			// Add UCP category
			array('module.add', array(
				'ucp',
				0,
				'UCP_MCHAT_CONFIG'
			)),

			// Add UCP preferences module
			array('module.add', array(
				'ucp',
				'UCP_MCHAT_CONFIG',
				array('module_basename' => '\dmzx\mchat\ucp\ucp_mchat_module'),
			)),
		));
	}

	public function update_schema()
	{
		$config = $this->get_config();
		$user_columns = array();

		foreach ($config['dmzx.mchat.config_ucp'] as $key => $value)
		{
			$user_columns['user_' . $key] = array($value['type'], $value['default']);
		}

		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'mchat'	=> array(
					'COLUMNS'		=> array(
						'message_id'			=> array('UINT', null, 'auto_increment'),
						'user_id'				=> array('UINT', 0),
						'user_ip'				=> array('VCHAR:40', ''),
						'message'				=> array('MTEXT_UNI', ''),
						'bbcode_bitfield'		=> array('VCHAR', ''),
						'bbcode_uid'			=> array('VCHAR:8', ''),
						'bbcode_options'		=> array('BOOL', '7'),
						'message_time'			=> array('INT:11', 0),
						'edit_time'				=> array('INT:11', 0),
						'forum_id'				=> array('UINT', 0),
						'post_id'				=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),

				$this->table_prefix . 'mchat_deleted_messages'	=> array(
					'COLUMNS'		=> array(
						'message_id'			=> array('UINT', null),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),

				$this->table_prefix . 'mchat_sessions'	=> array(
					'COLUMNS'		=> array(
						'user_id'				=> array('UINT', 0),
						'user_lastupdate'		=> array('TIMESTAMP', 0),
						'user_ip'				=> array('VCHAR:40', ''),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),

			'add_columns'	=> array(
				$this->table_prefix . 'users' => $user_columns,
			),
		);
	}

	public function revert_schema()
	{
		$config = $this->get_config();
		$user_columns = array();

		foreach (array_keys($config['dmzx.mchat.config_ucp']) as $key)
		{
			$user_columns[] = 'user_' . $key;
		}

		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'mchat',
				$this->table_prefix . 'mchat_deleted_messages',
				$this->table_prefix . 'mchat_sessions',
			),

			'drop_columns'	=> array(
				$this->table_prefix . 'users' => $user_columns,
			),
		);
	}
}
