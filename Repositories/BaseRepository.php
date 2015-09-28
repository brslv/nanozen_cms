<?php

namespace Nanozen\Repositories;

/**
 * Class BaseRepository
 *
 * @author brslv
 * @package Nanozen\Repositories
 */
class BaseRepository
{

	// TODO: Create RepositoryContract
	public $dependsOn = [
		'configProviderContract',
		'databaseProviderContract',
	];

	protected function db()
	{
		return $this->databaseProviderContract;
	}

	protected function config()
	{
		return $this->configProviderContract;
	}

}