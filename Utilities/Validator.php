<?php

namespace Nanozen\Utilities;

use Nanozen\Models\Binding\StorePageBinding;
use Nanozen\Models\Binding\UpdatePageBinding;
use Nanozen\Models\Binding\RegisterUserBinding;
use Nanozen\Models\Binding\StoreContentBoxBlockBinding;
use Nanozen\Providers\Session\SessionProvider as Session;

/**
 * Class Validator
 *
 * @author brslv
 * @package Nanozen\Utilities 
 */
class Validator 
{

	const PASSWORD_LENGTH = 6;

	public static function validatePageCreationInformation($page)
	{
		$valid = true;

		if ( ! Validator::stringLength($page->title, 3, 40)) {
			Session::flash('flash_messages', Communicator::INVALID_PAGE_TITLE);
			$valid = false;
		}

		if ( ! Validator::stringLength($page->content, 3, 65000)) {
			Session::flash('flash_messages', Communicator::INVALID_PAGE_CONTENT);
			$valid = false;
		}

		if ( ! Validator::inRange($page->active, 0, 1)) {
			Session::flash('flash_messages', Communicator::INVALID_PAGE_ACTIVE_STATUS);
			$valid = false;
		}

		return $valid;
	}

	public static function validateRegistrationInformation(RegisterUserBinding $user)
	{
		$valid = true;

		if ( ! Validator::stringLength($user->username, 3, 60)) {
			Session::flash('flash_messages', Communicator::INVALID_USERNAME);
			$valid = false;
		}

		if ( ! Validator::password($user->password)) {
			Session::flash('flash_messages', Communicator::INVALID_PASSWORD);
			$valid = false;
		}

		if ( ! Validator::stringLength($user->email, 5, 255)) {
			Session::flash('flash_messages', Communicator::INVALID_EMAIL);
			$valid = false;
		}

		return $valid;
	}
    
    public static function validateBlockCreationInformation($block)
    {
        if (get_class($block) == 'Nanozen\Models\Binding\StoreContentBoxBlockBinding') {
            return self::validateContentBoxCreationInformation($block);
        }
    }
    
    private static function validateContentBoxCreationInformation(StoreContentBoxBlockBinding $block)
    {
        $valid = true;
        
        if ( ! self::stringLength($block->title, 3, 255)) {
            Session::flash('flash_messages', Communicator::INVALID_BLOCK_TITLE);
			$valid = false;
        }
        
        if ( ! self::stringLength($block->content, 3, 65000000)) {
            Session::flash('flash_messages', Communicator::INVALID_BLOCK_CONTENT);
			$valid = false;
        }
        
        if ( ! self::min($block->blockTypeId, 1)) {
            Session::flash('flash_messages', Communicator::INVALID_BLOCK_TO_PAGE_ATTACHMENT);
			$valid = false;
        }
        
        if ( ! self::inRange($block->region, 1, 3)) {
            Session::flash('flash_messages', Communicator::INVALID_PAGE_REGION);
			$valid = false;
        }
        
        return $valid;
    }

    public static function password($password)
	{
		if (empty($password) || $password == '') {
			return false;
		}

		if (strlen($password) < static::PASSWORD_LENGTH) {
			return false;
		}

		return true;
	}

	public static function stringLength($string, $min = 3, $max = 10) 
	{
		if (strlen($string) < $min || strlen($string) > $max) {
			return false;
		}

		return true;
	}

	public static function inRange($number, $bottom, $top) 
	{
		return $number >= $bottom && $number <= $top;
	}
    
    public static function min($number, $min) 
    {
        return $number >= $min;
    }
}