<?php

namespace Nanozen\Utilities;

/**
 * Class Communicator
 *
 * @author brslv
 * @package Nanozen\Utilities 
 */
class Communicator 
{
	
	const INVALID_USERNAME = 'Username length must be in the range [3...60] symbols.';

	const INVALID_PASSWORD = 'Password must be at least 6 symbols long.';

	const INVALID_EMAIL = 'Email must be in the range [5...255] symbols.';

	const INVALID_CREDENTIALS = 'Invalid credentials. Please try again.';

	const SUCCESSFULLY_LOGGED = 'You have successfully logged in.';

	const INVALID_PAGE_TITLE = "Page title must be in the range [3...40] symbols.";

	const INVALID_PAGE_CONTENT = "Page content must be at least 3 symbols long.";

	const INVALID_PAGE_ACTIVE_STATUS = "Page status must be 'visible' or 'hidden'.";
    
    const PAGE_DOES_NOT_EXIST = 'Page does not exist';
    
    const PAGE_SUCCESSFULLY_DELETED = 'Page successfully deleted.';
    
    const PAGE_SUCCESSFULLY_EDITED = 'Page successfully edited';
    
    const PAGE_EDITING_FAIL = 'Page editing failed. Please try again.';
	
}