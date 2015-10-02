<?php

namespace Nanozen\Contracts\Providers\RestrictAccess;

/**
 * Interface RestrictAccessProviderContract
 *
 * @author brslv
 * @package Nanozen\Contracts\Providers\RestrictAccess 
 */
interface RestrictAccessProviderContract 
{
	
	public static function _for($role, $redirectLocation);

}