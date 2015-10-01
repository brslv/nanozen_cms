<?php

namespace Nanozen\Contracts\Repositories;

/**
 * Interface BlockRepositoryContract
 * 
 * @author brslv
 * @package \Nanozen\Contracts\Repositories
 */
interface BlockRepositoryContract 
{

    function save($block);

	function find(array $params);

}
