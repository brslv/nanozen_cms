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

    /**
     * Gets the value of username.
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the value of password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets the value of firstName.
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Gets the value of lastName.
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Gets the value of active.
     *
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Gets the value of role.
     *
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Gets the value of bannedOn.
     *
     * @return mixed
     */
    public function getBannedOn()
    {
        return $this->bannedOn;
    }
}