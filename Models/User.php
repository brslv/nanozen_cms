<?php

namespace Nanozen\Models;

/**
 * Class User
 *
 * @author brslv
 * @package Nanozen\Models 
 */
class User 
{

	private $username;
	
	private $password;

	private $email;

	private $firstName;

	private $lastName;

	private $active;

	private $role;

	private $bannedOn;

	public function __construct(
		$username, 
		$password, 
		$email, 
		$role, 
		$active, 
		$firstName = null, 
		$lastName = null, 
		$bannedOn = null
	) {
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->role = $role;
		$this->active = $active;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->bannedOn = $bannedOn;
	}

}