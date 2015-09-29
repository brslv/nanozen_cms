<?php

namespace Nanozen\Contracts\Repositories;

use Nanozen\Models\Binding\StorePageBinding;

/**
 * Interface PageRepositoryContract
 *
 * @author brslv
 * @package Nanozen\Contracts\Repositories 
 */
interface PageRepositoryContract 
{
	
	function save(StorePageBinding $page);

	function find(array $params);

}