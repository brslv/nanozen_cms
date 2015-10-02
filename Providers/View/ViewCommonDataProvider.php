<?php

namespace Nanozen\Providers\View;

use Nanozen\App\Injector;
use Nanozen\Factories\PageFactory;
use Nanozen\Factories\BlockFactory;
use Nanozen\Providers\Session\SessionProvider as Session;

/**
 * Class ViewCommonDataProvider
 * 
 * @author brslv
 * @package Nanozen\Providers\View
 */
class ViewCommonDataProvider
{
	
	use FetchesViewCommonDataProviderDependencies;
	
	protected $commonData;
	
	public function getCommonData()
	{
		// Invoke your methods bellow:
		// e.g: $this->users();
		$this->loadAllSettings();
		$this->loadBackgroundStyle();
		$this->loadUserInformation();
		$this->loadAllPages();
        $this->loadAllActivePages();
        $this->loadAllBlocks();
        $this->loadAllActiveBlocks();
        $this->loadBlockTypesTitles();
		
		// Return logic, nothing fancy, leave it as is:
		if (is_null($this->commonData)) {
			return [];
		}
		
		return $this->commonData;
	}
	
	public function setCommonData(array $data)
	{
		$this->commonData = $data;
		
		return $this;
	}
	
	/**
	 * Below you can provide some methods to
	 * populate the common data array.
	 * 
	 * Remember - this array is then passed to all the views,
	 * so each thing you put in it,
	 * will be available 
	 * in each view.
	 * 
	 * In this class you can freely use
	 * 		- db() 		-> to access the database
	 * 		- config() 	-> to access the currently active config array
	 *  
	 * =============================================================== 
	 * ---------------------------------------------------------------
	 * Example:
	 * ---------------------------------------------------------------
	 * ===============================================================
	 * 
	 *  private function users() 
	 *	{
	 *		$users = $this->db()->query("SELECT * FROM users");
	 *		
	 *		$this->commonData['users'] = $users;
	 *	}
	 */
	
	private function loadAllSettings()
	{
		$settings = $this->db()->query('SELECT id, name, value FROM options')->fetch();

		foreach ($settings as $setting) {
			$this->commonData[$setting->name] = $setting->value;
		}
	}

	private function loadUserInformation()
	{
        $userRepository = Injector::call('\Nanozen\Repositories\UserRepository');

        if ($userRepository->hasLogged()) {
			$user = $userRepository->find(['id' => Session::get('id')]);
        	$this->commonData['user'] = $user;
        }
	}

	private function loadBackgroundStyle()
	{
		$backgroundColor = $this->commonData['app_background_color'];
		$backgroundImage = $this->commonData['app_background_image'];

		$this->commonData['backgroundStyle'] = "";

		if (isset($backgroundColor) && trim($backgroundColor) != "") {
			$this->commonData['backgroundStyle'] .= 'background-color: ' . $backgroundColor . '; ';	
		} 

		if (isset($backgroundImage) && trim($backgroundImage) != "") {
			$this->commonData['backgroundStyle'] .= "background-image: url('uploads/{$backgroundImage}'); background-repeat: none; background-size: cover;";
		}
	}

    /**
     * Loads all pages - active and inactive (hidden/visible).
     */
	private function loadAllPages()
	{
        $pagesObjectsArray = $this->getPagesByActiveStatus(false);

		$this->commonData['allPages'] = $pagesObjectsArray;
	}
    
    /**
     * Loads only active pages (visible).
     */
    private function loadAllActivePages()
    {
        $pagesObjectsArray = $this->getPagesByActiveStatus(true);

		$this->commonData['activePages'] = $pagesObjectsArray;
    }
    
    private function getPagesByActiveStatus($active = false)
    {
        $pagesRepository = Injector::call('\Nanozen\Repositories\PageRepository');
		$pages = $pagesRepository->all($active);
		$pagesObjectsArray = [];

		foreach ($pages as $page) {
			$pagesObjectsArray[] = PageFactory::make($page);
		}
        
        return $pagesObjectsArray;
    }
    
    /**
     * Loads all blocks - active and inactive (hidden/visible).
     */
	private function loadAllBlocks()
	{
        $blocksObjectsArray = $this->getBlocksByActiveStatus(false);
        
		$this->commonData['allBlocks'] = $blocksObjectsArray;
	}
    
    /**
     * Loads only active blocks (visible).
     */
    private function loadAllActiveBlocks()
    {
        $blocksObjectsArray = $this->getBlocksByActiveStatus(true);

		$this->commonData['activeBlocks'] = $blocksObjectsArray;
    }
	
    private function getBlocksByActiveStatus($active = false)
    {
        $blocksRepository = Injector::call('\Nanozen\Repositories\BlockRepository');
		$blocks = $blocksRepository->all($active);
		$blocksRepository = [];

		foreach ($blocks as $block) {
			$blocksRepository[] = BlockFactory::make($block);
		}
        
        return $blocksRepository;
    }
    
    private function loadBlockTypesTitles()
    {
        $this->commonData['blockTypesTitles'] = 
                $this->db()->query("SELECT title FROM block_types")->fetch(\PDO::FETCH_ASSOC);
    }

}