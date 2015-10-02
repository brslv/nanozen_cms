<?php

namespace Nanozen\Factories;

use Nanozen\Models\User;
use Nanozen\Models\Binding\RegisterUserBinding;
use Nanozen\Contracts\Factories\FactoryContract;

/**
* Class UserFactory
*
* @author brslv
* @package Nanozen\Factories
*/
class UserFactory implements FactoryContract
{

	const DEFAULT_USER_ROLE = 2; // user

	const DEFAULT_USER_ACTIVE = 1;

	public static function make($info)
	{
		$id = $info->id;
		$username = $info->username;
		$password = $info->password;
		$email = $info->email;
		$firstName = isset($info->first_name) ? $info->first_name : null;
		$lastName = isset($info->last_name) ? $info->last_name : null;
		$roleId = isset($info->role_id) ? $info->role_id : static::DEFAULT_USER_ROLE;
		$active = isset($info->active) ? $info->active : static::DEFAULT_USER_ACTIVE;
		$bannedOn = null;
		$rememberToken = isset($info->remember_token) ? $info->remember_token : null;

		return new User($id, $username, $password, $email, $roleId, $active, $firstName, $lastName, $bannedOn, $rememberToken);
	}

}