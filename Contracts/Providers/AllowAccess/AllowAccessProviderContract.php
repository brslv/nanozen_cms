<?php

namespace Nanozen\Contracts\Providers\AllowAccess;

/**
 * Interface AllowAccessProviderContract
 *
 * @author brslv
 * @package Nanozen\Contracts\Providers\AllowAccess 
 */
interface AllowAccessProviderContract 
{
	
	public static function to($role, $redirectLocation);

}