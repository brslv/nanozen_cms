<?php

namespace Nanozen\Controllers;

use Nanozen\App\Injector;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;

/**
 * Class PagesController
 *
 * @author brslv
 * @package Nanozen\Controllers 
 */
class PagesController extends BaseController
{

	private $pageRepository;

	public function __construct()
	{
	    $this->pageRepository = Injector::call('\Nanozen\Repositories\PageRepository');
	}
	
	public function create()
	{

		$this->view()->render('pages.create');
	}

	/**
	 * Stores a page to the database.
	 *
	 * @bind \Nanozen\Models\Binding\StorePageBinding
	 */
	public function store()
	{

		$bindedPage = $this->binding;
		$persistedPage = $this->pageRepository->save($bindedPage);

		if ($persistedPage) {
			Redirect::to('/back');
		} else {
			Redirect::to('/pages/create');
		}

		// -- create a page model
		// -- create a repository
		
		// -- create a page factory
		// -- store the page
		// -- return a page model from the newly created page.
	}

}