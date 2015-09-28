<?php

namespace Nanozen\Controllers;

use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;
use Nanozen\App\Injector;

/**
 * Class AuthController
 * 
 * @author brslv
 * @package Nanozen\Controllers
 */
class AuthController extends BaseController
{

	protected $userRepository;

	public function __construct()
	{
		$this->userRepository = Injector::call('\Nanozen\Repositories\UserRepository');
	}	

	/**
	 * Displays a registration form.
	 * 
	 * @return void
	 */
	public function register()
	{
		$this->view()->render('auth.register');
	}

	/**
	 * @bind \Nanozen\Models\Binding\RegisterUserBinding
	 * @return \Nanozen\Models\User
	 */
	public function postRegister()
	{
		$bindedUser = $this->binding;
		$registeredUser = $this->userRepository->add($bindedUser);

		return $registeredUser;
	}
	
}