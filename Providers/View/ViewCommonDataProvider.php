<?php

namespace Nanozen\Providers\View;

use Nanozen\App\Injector;
use Nanozen\Factories\PageFactory;

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
		$this->loadAppTitle();
		$this->loadAppDescription();
		$this->loadAllPages();
        $this->loadAllActivePages();
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
	
	private function loadAppTitle()
	{
		$stmt= $this->db()->prepare("SELECT value FROM options WHERE name = :name LIMIT 1");
		$stmt->execute([':name' => 'app_title']);
		$appTitle = $stmt->fetch(null, false)->value;

		$this->commonData['appTitle'] = $appTitle;
	}

	private function loadAppDescription()
	{
		$stmt = $this->db()->prepare("SELECT value FROM options WHERE name = :name");
		$stmt->execute([':name' => 'app_description']);
		$appDescription = $stmt->fetch(null, false)->value;

		$this->commonData['appDescription'] = $appDescription;
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
    
    private function loadBlockTypesTitles()
    {
        $this->commonData['blockTypesTitles'] = 
                $this->db()->query("SELECT title FROM block_types")->fetch(\PDO::FETCH_ASSOC);
    }
	

}