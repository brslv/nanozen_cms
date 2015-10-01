<?php

namespace Nanozen\Contracts\Repositories;

use Nanozen\Models\Binding\PageBinding;

/**
 * Interface PageRepositoryContract
 *
 * @author brslv
 * @package Nanozen\Contracts\Repositories 
 */
interface PageRepositoryContract 
{
	
	function save(PageBinding $page);

	function find(array $params);

}