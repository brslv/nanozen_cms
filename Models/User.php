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
    private $id;

	private $username;
	
	private $password;

	private $email;

	private $firstName;

	private $lastName;

	private $active;

	private $roleId;

    private $role;

	private $bannedOn;

    private $rememberToken;

	public function __construct(
        $id,
		$username, 
		$password, 
		$email, 
		$roleId, 
		$active, 
		$firstName = null, 
		$lastName = null, 
		$bannedOn = null,
        $rememberToken = null
	) {
        $this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->roleId = $roleId;
		$this->active = $active;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->bannedOn = $bannedOn;
        $this->rememberToken = $rememberToken;
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
     * Gets the value of roleId.
     *
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
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

    /**
     * Gets the value of rememberToken.
     *
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }
    

    /**
     * Gets the value of role.
     *
     * @return mixed
     */
    public function getRole()
    {
        if (is_null($this->role) || $this->role == "") {
            switch ($this->roleId) {
                case 1:
                    $this->role = 'editor';
                    break;
                case 2:
                    $this->role = 'user';
                    break;
                case 3:
                    return $this->role = 'admin';
                    break;
            }
        }

        return $this->role;
    }

    /**
     * Sets the value of role.
     *
     * @param mixed $role the role
     *
     * @return self
     */
    private function _setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}