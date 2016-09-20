<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\cron;

class mchat_prune extends \phpbb\cron\task\base
{
	/** @var \dmzx\mchat\core\functions */
	protected $functions;

	/** @var \dmzx\mchat\core\settings */
	protected $settings;

	/**
	 * Constructor
	 *
	 * @param \dmzx\mchat\core\functions	$functions
	 * @param \dmzx\mchat\core\settings		$settings
	 */
	public function __construct(\dmzx\mchat\core\functions $functions, \dmzx\mchat\core\settings $settings)
	{
		$this->functions = $functions;
		$this->settings = $settings;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return null
	 */
	public function run()
	{
		$this->functions->mchat_prune();
		$this->settings->set_cfg('mchat_prune_last_gc', time());
	}

	/**
	 * Returns whether this cron task can run, given current board configuration.
	 *
	 * If warnings are set to never expire, this cron task will not run.
	 *
	 * @return bool
	 */
	public function is_runnable()
	{
		return $this->settings->cfg('mchat_prune');
	}

	/**
	 * Returns whether this cron task should run now, because enough time
	 * has passed since it was last run (24 hours).
	 *
	 * @return bool
	 */
	public function should_run()
	{
		return $this->settings->cfg('mchat_prune_last_gc') < time() - $this->settings->cfg('mchat_prune_gc');
	}
}
