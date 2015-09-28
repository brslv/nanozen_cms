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

	const DEFAULT_USER_ROLE = 2; // user

	const DEFAULT_USER_ACTIVE = 1;

	public static function make($info)
	{
		$username = $info->username;
		$password = $info->password;
		$email = $info->email;
		$firstName = isset($info->firstName) ? $info->firstName : null;
		$lastName = isset($info->lastName) ? $info->lastName : null;
		$roleId = isset($info->roleId) ? $info->roleId : static::DEFAULT_USER_ROLE;
		$active = isset($info->active) ? $info->active : static::DEFAULT_USER_ACTIVE;
		$bannedOn = null;
		$rememberToken = isset($info->rememberToken) ? $info->rememberToken : null;

		return new User($username, $password, $email, $roleId, $active, $firstName, $lastName, $bannedOn, $rememberToken);
	}

}