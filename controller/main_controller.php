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

class main_controller
{
	/** @var \dmzx\mchat\core\mchat */
	protected $mchat;

	/** @var \phpbb\request\request */
	protected $request;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\mchat		$mchat
	* @param \phpbb\request\request		$request
	*/
	public function __construct(\dmzx\mchat\core\mchat $mchat, \phpbb\request\request $request)
	{
		$this->mchat	= $mchat;
		$this->request	= $request;
	}

	/**
	* Controller for mChat
	*
	* @param $page The page to render, one of custom|archive|rules|whois
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function page($page)
	{
		return call_user_func(array($this->mchat, 'page_' . $page));
	}

	/**
	* Controller for mChat actions called with Ajax requests
	*
	* @param $action The action to perform, one of add|edit|del|clean|refresh|whois
	* @return \Symfony\Component\HttpFoundation\JsonResponse A Symfony JsonResponse object
	*/
	public function action($action)
	{
		if (!$this->request->is_ajax())
		{
			throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
		}

		$data = call_user_func(array($this->mchat, 'action_' . $action));

		return new JsonResponse($data);
	}
}
