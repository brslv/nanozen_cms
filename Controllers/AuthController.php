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

	public function register()
	{
		$this->view()->render('auth.register');
	}

	/**
	 * @bind \Nanozen\Models\Binding\RegisterUserBinding
	 */
	public function postRegister()
	{
		// Todo: extract the register logic bellow in UserRepository.
		// $username =  $this->binding->username;
		// $password = password_hash($this->binding->password, PASSWORD_DEFAULT);
		// $email = $this->binding->email;

		// $query = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, 1)";
		
		// $stmt = $this->db()->prepare($query);
		
		// $stmt->execute([
		// 	':username' => $username,
		// 	':password' => $password,
		// 	':email' => $email,
		// ]);

		$bindedUser = $this->binding;	
		$registeredUser = $this->userRepository->add($bindedUser);
		var_dump($registeredUser);
	}
	
}