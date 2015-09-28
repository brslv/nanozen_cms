<?php

namespace Nanozen\Controllers;

use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\App\Injector;

/**
 * Class BackendController
 *
 * @author brslv
 * @package Nanozen\Controllers 
 */
class BackendController extends BaseController
{

	protected $userRepository;

	public function __construct()
	{
		$this->userRepository = Injector::call('\Nanozen\Repositories\UserRepository');
	}	

	public function index()
	{
		Redirect::guests('/');
		$username = Session::get('username');
		$role = Session::get('role');
		$quote = quote();

		$data = [
			'quote' => $quote, 
			'username' => $username, 
			'role' => $role,
		];

		$this->view()->render('backend.index', $data);
	}
	
}