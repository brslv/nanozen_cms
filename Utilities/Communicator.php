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
	const ERROR = "An error occured. Please, try again.";
    
	const INVALID_USERNAME = 'Username length must be in the range [3...60] symbols.';

	const INVALID_PASSWORD = 'Password must be at least 6 symbols long.';

	const INVALID_EMAIL = 'Email must be in the range [5...255] symbols.';

	const INVALID_CREDENTIALS = 'Invalid credentials. Please, try again.';

	const SUCCESSFULLY_LOGGED = 'You have successfully logged in.';

	const INVALID_PAGE_TITLE = "Page title must be in the range [3...40] symbols.";

	const INVALID_PAGE_CONTENT = "Page content must be at least 3 symbols long.";

	const INVALID_PAGE_ACTIVE_STATUS = "Page status must be 'visible' or 'hidden'.";
    
    const PAGE_DOES_NOT_EXIST = 'Page does not exist.';
    
    const PAGE_SUCCESSFULLY_DELETED = 'Page successfully deleted.';
    
    const PAGE_SUCCESSFULLY_EDITED = 'Page successfully edited.';
    
    const PAGE_EDITING_FAIL = 'Page editing failed. Please try again.';
    
    const INVALID_BLOCK_TITLE = 'Block title must be in range [3...255].';
    
    const INVALID_BLOCK_CONTENT = "Block content must be at least 3 symbols long.";
    
    const INVALID_BLOCK_TO_PAGE_ATTACHMENT = "Cannot attach the block to the given page. Try with another page.";
    
    const INVALID_PAGE_REGION = "Invalid page region";
    
    const BLOCK_SUCCESSFULLY_CREATED = "A block has been created successfully.";
    
    const BLOCK_SUCCESSFULLY_EDITED = 'Block successfully edited.';
    
    const BLOCK_EDITING_FAIL = 'Block editing failed. Please, try again.';
    
    const BLOCK_SUCCESSFULLY_DELETED = 'Block successfully deleted.';
    
    const BLOCK_DOES_NOT_EXIST = 'Block does not exist.';
    
    const SET_HOMEPAGE_FAIL = 'An error occured while trying to change your homepage. Please, try again.';

    const SETTINGS_UPDATE_APP_TITLE_FAIL = "Site title must be in the range [2...30] symbols.";

    const SETTINGS_UPDATE_APP_DESCRIPTION_FAIL = "Site description must be in the range [3...40] symbols.";
    
    const SETTINGS_SUCCESSFULLY_EDITED = 'Settings successfully edited.';

    const INVALID_COLOR = 'This color seems to be invalid';

    const IMAGE_EXTENSION_NOT_SUPPORTED = 'We have detected unsupported image extension.';

    const IMAGE_SIZE_NOT_SUPPORTED = 'The maximum allowed image size is 2MB';

    const IMAGE_UPLOAD_SUCCESSFULL = 'Successfully uploaded image.';

    const IMAGE_UPLOAD_FAIL = 'Image uploading failed. Please try again.';

    const BACKGROUND_IMAGE_REMOVED_SUCCESSFULLY = "Background image removed successfully.";

    const BACKGROUND_IMAGE_REMOVE_FAIL = "Removing background failed. Please try again.";
	
}