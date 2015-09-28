<?php

namespace Nanozen\Repositories;

use Nanozen\Models\User;
use Nanozen\Utilities\Hash;
use Nanozen\Factories\UserFactory;
use Nanozen\Models\Binding\RegisterUserBinding;
use Nanozen\Contracts\Repositories\UserRepositoryContract;

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
	public function add(RegisterUserBinding $user)
	{
		$query = "INSERT INTO users(username, password, email, role) VALUES(:username, :password, :email, :role)";
		$stmt = $this->db()->prepare($query);

		// TODO: validate the information of $user.

		$stmt->execute([
			':username' => $user->username,
			':password' => Hash::password($user->password),
			':email' => $user->email,
			':role' => UserFactory::DEFAULT_USER_ROLE,
		]);

		$id = $this->db()->lastInsertId();

		$persistedUser = $this->get($id);
		return $persistedUser;
	}

	/**
	 * Get a user from the database, based on id.
	 *
	 * @param  int $id 
	 * @return \Nanozen\Models\User
	 */
	public function get($id) 
	{
		$query = "SELECT id, username, password, first_name, last_name, email, role, active, banned_on FROM users WHERE id = :id";
		$stmt = $this->db()->prepare($query);
		$stmt->execute([
			':id' => $id,
		]);
		$user = $stmt->fetch(\PDO::FETCH_OBJ, false);
	
		return UserFactory::make($user);
	}

}