<?php

namespace Nanozen\Repositories;

use Nanozen\Models\User;
use Nanozen\Utilities\Hash;
use Nanozen\Factories\UserFactory;
use Nanozen\Models\Binding\LoginUserBinding;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Models\Binding\RegisterUserBinding;
use Nanozen\Contracts\Repositories\UserRepositoryContract;
use Nanozen\Providers\Error\ErrorProvider as Error;

/**
* Class UserRepository
*
* @author brslv
* @package Nanozen\Repositories
*/
class UserRepository extends BaseRepository implements UserRepositoryContract
{

	/**
	 * Registers a user.
	 * 
	 * @param RegisterUserBinding $user The RegisterUserBinding, containing all the register information.
	 */
	public function save(RegisterUserBinding $user)
	{
		$query = "INSERT INTO users(username, password, email, role_id) VALUES(:username, :password, :email, :role_id)";
		$stmt = $this->db()->prepare($query);

		// TODO: validate the information of $user.

		$stmt->execute([
			':username' => $user->username,
			':password' => Hash::password($user->password),
			':email' => $user->email,
			':role_id' => UserFactory::DEFAULT_USER_ROLE,
		]);

		$id = $this->db()->lastInsertId();

		$persistedUser = $this->find(['id' => $id]);
		return $persistedUser;
	}

	/**
	 * Get a user from the database, based on id.
	 *
	 * @param  int $id 
	 * @return \Nanozen\Models\User
	 */
	public function find(array $params) 
	{
		if (empty($params)) {
			throw new \Exception('Params cannot be empty.');
		}

		$query = $this->constructQuery($params);
		$executableArray = $this->constructExecutableArray($params);

		$stmt = $this->db()->prepare($query);
		$stmt->execute($executableArray);
		$user = $stmt->fetch(\PDO::FETCH_OBJ, false);
	
		return UserFactory::make($user);
	}

	private function constructQuery($params) 
	{
		$query = "SELECT id, username, password, first_name, last_name, email, role_id, active, banned_on, remember_token FROM users WHERE ";
		$counter = 0;
		$paramsCount = count($params);

		foreach ($params as $key => $value) {
			$counter++;
			$query .= $key . ' = :' . $key;	

			if ($counter == $paramsCount - 1) {
				$query .= ', ';
			}
		}

		return $query;
	}

	private function constructExecutableArray($params)
	{
		$executableArray = [];

		foreach ($params as $key => $value) {
			$executableArray[':' . $key] = $value;
		}

		return $executableArray;
	}

	/**
	 * Logs in user.
	 *
	 * @param  LoginUserBinding $user
	 * @return bool
	 */
	public function login(LoginUserBinding $user)
	{
		$username = $user->username;
		$password = $user->password;

		$user = $this->find(['username' => $username]);
		
		if ($user && Hash::verifyPassword($password, $user->getPassword())) {
			$firstName = $user->getFirstName();
			$lastName = $user->getLastName();
			$email = $user->getEmail();
			$roleId = $user->getRoleId();
			$active = $user->getActive();
			$bannedOn = $user->getBannedOn();
			$rememberToken = $user->getRememberToken();

			Session::put('username', $username);
			Session::put('firstName', $firstName);
			Session::put('lastName', $lastName);
			Session::put('email', $email);
			Session::put('roleId', $roleId);
			Session::put('active', $active);
			Session::put('bannedOn', $bannedOn);
			Session::put('rememberToken', $rememberToken);

			return true;
		}

		// TODO: implement error messages.

		Session::flash('flash_messages', 'Invalid credentials. Please try again.');
		return false;
	}

	/**
	 * Logs out users
	 * 
	 * @return bool
	 */
	public function logout()
	{
		if ($this->hasLogged()) {
			Session::remove('username');	
			Session::remove('firstName');
			Session::remove('lastName');
			Session::remove('email');
			Session::remove('roleId');
			Session::remove('active');
			Session::remove('bannedOn');
			Session::remove('rememberToken');

			return true;
		}

		return false;
	}
    
    /**
     * Checks if a user is logged.
     * 
     * @return boolean [description]
     */
    public function hasLogged()
    {
        return Session::has('username');
    }

}