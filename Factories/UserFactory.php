<?php

namespace Nanozen\Factories;

use Nanozen\Models\User;
use Nanozen\Models\Binding\RegisterUserBinding;

/**
* Class UserFactory
*
* @author brslv
* @package Nanozen\Factories
*/
class UserFactory
{

	const DEFAULT_USER_ROLE = 1;

	const DEFAULT_USER_ACTIVE = 1;

	public static function make($info)
	{
		$username = $info->username;
		$password = $info->password;
		$email = $info->email;
		$firstName = isset($info->firstName) ? $info->firstName : null;
		$lastName = isset($info->lastName) ? $info->lastName : null;
		$role = isset($info->role) ? $info->role : static::DEFAULT_USER_ROLE;
		$active = isset($info->active) ? $info->active : static::DEFAULT_USER_ACTIVE;
		$bannedOn = null;

		return new User($username, $password, $email, $role, $active, $firstName, $lastName, $bannedOn);
	}

}