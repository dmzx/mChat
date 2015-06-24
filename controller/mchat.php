<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\controller;

class mchat
{
	/** @var \dmzx\mchat\core\render_helper */
	protected $render_helper;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\request\request */
	protected $request;

	/**
	* Constructor
	*
	 * @param \dmzx\mchat\core\render_helper	$render_helper
	 * @param \phpbb\controller\helper			$helper
	 * @param \phpbb\request\request			$request
	*/
	public function __construct(\dmzx\mchat\core\render_helper $render_helper, \phpbb\controller\helper $helper, \phpbb\request\request $request)
	{
		$this->render_helper = $render_helper;
		$this->helper = $helper;
		$this->request = $request;
	}

	/**
	* Controller for mChat
	*
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function handle()
	{
		$ret = $this->render_helper->render_data_for_page();

		// If this was an ajax request, we just create an json_response and return that. It's not ours to handle here.
		if ($this->request->is_ajax() && is_array($ret) && isset($ret['json']) && $ret['json'] === true)
		{
			return new \Symfony\Component\HttpFoundation\JsonResponse(
				$ret
			);
		}

		// If error occured, render it
		if (isset($ret['error']) && $ret['error'] == true)
		{
			return $this->helper->error($ret['error_text'], $ret['error_type']);
		}

		return $this->helper->render($ret['filename'], $ret['lang_title']);
	}
}