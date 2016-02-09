<?php
/**
*
* @package Board3 Portal v2.1+ - mchat on portal
* @copyright (c) Board3 Group ( www.board3.de )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @mchat on portal by Talonos @ http://pretereo-stormrage.co.uk
*/

namespace dmzx\mchat;
/**
* @package mchat
*/
class b3pmchat extends \board3\portal\modules\module_base
{
	/**
	* Allowed columns: Just sum up your options (Exp: left + right = 10)
	* top		1
	* left		2
	* center	4
	* right		8
	* bottom	16
	*/
	public $columns = 21;

	/**
	* Default guildox
	*/
	public $name = 'PORTAL_MCHAT_TITLE';

	/**
	* Default module-image:
	* file must be in "{T_THEME_PATH}/images/portal/"
	*/
	public $image_src = '';

	/**
	* module-language file
	* file must be in "language/{$user->lang}/mods/portal/"
	*/
	    public $language = array(
        'vendor'    => 'dmzx/mchat',
        'file'        => 'common',
    );
	

    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\template\template */
    protected $template;

    /**
     * Constructor for clock module
     *
     * @param \phpbb\config\config $config phpBB config
     * @param \phpbb\template\template $template phpBB template
     */
    public function __construct($config, $template)
    {
        $this->config = $config;
        $this->template = $template;
    }



	public function get_template_center($module_id)
	{

		$this->template->assign_vars(array(

			'S_DISPLAY_MCHAT_PORTAL_PLACEHOLDER'	=> ($this->config['board3_mchat_' . $module_id]) ? true : false,
		));

		return '@dmzx_mchat/mchat_portal.html';
	}

public function get_template_acp($module_id)
   {
      return array(
         'title'   => 'PORTAL_MCHAT_TITLE',
         'vars'   => array(
            'legend1'                     => 'THIS DOES NOTHING',
				'board3_mchat_' . $module_id		=> array('lang' => 'To enable/disable Mchat portal block use Enable module: above',	'validate' => 'string', 'type' => 'radio:yes_no',	'explain' => true),
				)
      );
   }
	

	/**
	* API functions
	*/
	public function install($module_id)
	{
		$this->config->set('board3_mchat_' . $module_id, 1);
		return true;
	}

	public function uninstall($module_id, $db)
	{

		$this->config->delete('board3_mchat_' . $module_id);
		return true;
	}
}
