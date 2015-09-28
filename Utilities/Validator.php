<?php

namespace Nanozen\Utilities;

use Nanozen\Models\Binding\RegisterUserBinding;
use Nanozen\Providers\Session\SessionProvider as Session;

/**
 * Class Validator
 *
 * @author brslv
 * @package Nanozen\Utilities 
 */
class Validator 
{

	const PASSWORD_LENGTH = 6;

	public static function validateRegistrationInformation(RegisterUserBinding $user)
	{
		$valid = true;

		if ( ! Validator::stringLength($user->username, 3, 60)) {
			Session::flash('flash_messages', Communicator::INVALID_USERNAME);
			$valid = false;
		}

		if ( ! Validator::password($user->password)) {
			Session::flash('flash_messages', Communicator::INVALID_PASSWORD);
			$valid = false;
		}

		if ( ! Validator::stringLength($user->email, 5, 255)) {
			Session::flash('flash_messages', Communicator::INVALID_EMAIL);
		}

		return $valid;
	}

	public static function password($password)
	{
		if (empty($password) || $password == '') {
			return false;
		}

		if (strlen($password) < static::PASSWORD_LENGTH) {
			return false;
		}

		return true;
	}

	public static function stringLength($string, $min = 3, $max = 10) 
	{
		if (strlen($string) < $min || strlen($string) > $max) {
			return false;
		}

		return true;
	}
}