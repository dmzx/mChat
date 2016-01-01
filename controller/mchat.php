<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\controller;

use \Symfony\Component\HttpFoundation\JsonResponse;

class mchat
{
	/** @var \dmzx\mchat\core\render_helper*/
	protected $render_helper;

	/** @var \phpbb\request\request*/
	protected $request;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\render_helper		$render_helper
	* @param \phpbb\request\request				$request
	*/
	public function __construct(\dmzx\mchat\core\render_helper $render_helper, \phpbb\request\request $request)
	{
		$this->render_helper	= $render_helper;
		$this->request			= $request;
	}

	/**
	* Controller for mChat
	*
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function handle()
	{
		$content = $this->render_helper->render_data_for_page(false);
		return $this->request->is_ajax() ? new JsonResponse($content) : $content;
	}
}
