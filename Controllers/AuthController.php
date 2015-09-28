<?php

namespace Nanozen\Controllers;

use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;
use Nanozen\App\Injector;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;

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
		$registeredUser = $this->userRepository->save($bindedUser);

		if ($registeredUser) {
			// return $registeredUser;
			$this->view()->render('auth.test', ['loggedUserUsername' => $registeredUser->getUsername()]);
		} else {
			Redirect::to('/register');
		}
	}

	public function login()
	{
		$this->view()->render('auth.login');
	}

	/**
	 * @bind \Nanozen\Models\Binding\LoginUserBinding
	 */
	public function postLogin()
	{
		$bindedUser = $this->binding;
		if ($this->userRepository->login($bindedUser)) {
			echo "Logged";
		} else {
			header('Location: /login');
		}
	}

	public function logout()
	{
		if ($this->userRepository->logout()) {
			Redirect::guests('/');
		}
	}
	
}