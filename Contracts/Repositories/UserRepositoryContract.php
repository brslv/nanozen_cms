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
	
	function add(RegisterUserBinding $user);

	function get($id);

}