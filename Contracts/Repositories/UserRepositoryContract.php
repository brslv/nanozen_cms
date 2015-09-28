<?php

namespace Nanozen\Contracts\Repositories;

use Nanozen\Models\Binding\RegisterUserBinding;

/**
 * Interface UserRepositoryContract
 *
 * @author brslv
 * @package Nanozen\Contracts\Repositories
 */
interface UserRepositoryContract 
{
	
	function save(RegisterUserBinding $user);

	function find(array $params);

}