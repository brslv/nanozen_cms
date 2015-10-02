<?php

namespace Nanozen\Providers\RestrictAccess;

use Nanozen\App\Injector;
use Nanozen\Repositories\UserRepository;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Contracts\Providers\RestrictAccess\RestrictAccessProviderContract;

/**
 * Class RestrictAccessProvider
 *
 * @author brslv
 * @package Nanozen\Providers\RestrictAccess 
 */
class RestrictAccessProvider implements RestrictAccessProviderContract
{
	
	const GUESTS = 'guests';

	const LOGGED = 'logged';

	public static function _for($role, $redirectLocation)
	{
		$userRepository = Injector::call('\Nanozen\Repositories\UserRepository');

		if ($role == self::LOGGED) {
			if ($userRepository->hasLogged()) {
				Redirect::to($redirectLocation);
				return;
			}

			return;
		}

		if ($role == self::GUESTS) {
			if ( ! $userRepository->hasLogged()) {
				Redirect::to($redirectLocation);
				return;
			}

			return;
		}

		$loggedUser = $userRepository->find(['id' => Session::get('id')]);

		if (is_string($role) && $role != "") {
			if (self::checkSingleRole($role, $loggedUser)) {
				Redirect::to($redirectLocation);
			}
		}

		if (is_array($role) && ! empty($role)) {
			if (self::checkForManyRoles($role, $loggedUser)) {
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