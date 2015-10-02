<?php

namespace Nanozen\Controllers;

use Nanozen\App\Injector;
use Nanozen\Models\UserRoles;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\AllowAccess\AllowAccessProvider as AllowAccess;
use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;
use Nanozen\Providers\RestrictAccess\RestrictAccessProvider as RestrictAccess;

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
		RestrictAccess::_for(RestrictAccess::GUESTS, '/');

		$user = $this->userRepository->find(['id' => Session::get('id')]);
		$quote = quote();
		$view = 'backend.index';

		if ($user->getRole() == UserRoles::USER) {
			$view = 'backend.index_slim';
		}

		if ($user->getRole() == UserRoles::EDITOR) {
			$view = 'backend.index_editor';
		}

		$data = [
			'quote' => $quote, 
			'user' => $user,
		];

		$this->view()->render($view, $data);
	}
	
}