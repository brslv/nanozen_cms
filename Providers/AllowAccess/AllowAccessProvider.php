<?php

namespace Nanozen\Providers\AllowAccess;

use Nanozen\App\Injector;
use Nanozen\Repositories\UserRepository;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Contracts\Providers\AllowAccess\AllowAccessProviderContract;

/**
 * Class AllowAccess
 *
 * @author brslv
 * @package Nanozen\Providers\AllowAccess 
 */
class AllowAccessProvider implements AllowAccessProviderContract
{

	public static function to($role, $redirectLocation)
	{

		$userRepository = Injector::call('\Nanozen\Repositories\UserRepository');

		if ( ! $userRepository->hasLogged()) {
			return Redirect::to($redirectLocation);
		}

		$loggedUser = $userRepository->find(['id' => Session::get('id')]);

		if (is_string($role) && $role != "") {
			if ( ! self::checkSingleRole($role, $loggedUser)) {
				Redirect::to($redirectLocation);
			}
		}

		if (is_array($role) && ! empty($role)) {
			if ( ! self::checkForManyRoles($role, $loggedUser)) {
				Redirect::to($redirectLocation);
			}
		}

		return true;
	}

	private static function checkSingleRole($role, $loggedUser) 
	{
		return $loggedUser->getRole() == $role;
	}

	private static function checkForManyRoles($roles, $loggedUser) 
	{
		$isRole = false;
		$loggedUserRole = $loggedUser->getRole();

		foreach ($roles as $r) {
			if ($loggedUserRole == $r) {
				$isRole = true;	
				break;
			}	
		}

		return $isRole;
	}

}