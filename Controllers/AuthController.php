<?php

namespace Nanozen\Controllers;

use Nanozen\App\Injector;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\AllowAccess\AllowAccessProvider as AllowAccess;
use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;
use Nanozen\Providers\RestrictAccess\RestrictAccessProvider as RestrictAccess;

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
		RestrictAccess::_for(RestrictAccess::LOGGED, '/back');

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
			Redirect::to('/login');
		} else {
			Redirect::to('/register');
		}
	}

	public function login()
	{
		RestrictAccess::_for(RestrictAccess::LOGGED, '/back');

		$this->view()->render('auth.login');
	}

	/**
	 * @bind \Nanozen\Models\Binding\LoginUserBinding
	 */
	public function postLogin()
	{
		$bindedUser = $this->binding;

		if ($this->userRepository->login($bindedUser)) {
			Redirect::loggedUser('/back');
		} else {
			header('Location: /login');
		}
	}

	public function logout()
	{
		RestrictAccess::_for(RestrictAccess::GUESTS, '/');

		if ($this->userRepository->logout()) {
			Redirect::guests('/');
		}
	}
	
}