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
    
    /**
     * @var \Nanozen\Repositories\PageRepository
     */
	private $pageRepository;

	public function __construct()
	{
	    $this->pageRepository = Injector::call('\Nanozen\Repositories\PageRepository');
	}
	
	public function create()
	{
		Redirect::guests('/');

		$this->view()->render('pages.create');
	}

	/**
	 * Stores a page to the database.
	 *
	 * @bind \Nanozen\Models\Binding\StorePageBinding
	 */
	public function store()
	{
		Redirect::guests('/');

		$bindedPage = $this->binding;
		$persistedPage = $this->pageRepository->save($bindedPage);

		if ($persistedPage) {
			Redirect::to('/back');
		} else {
			Redirect::to('/pages/create');
		}
	}

	public function edit($id)
	{
		Redirect::guests('/');

        $page = $this->pageRepository->find(['id' => $id]);
        
        if (is_null($page)) {
            http_response_code(404);
            $this->view()->render('errors.404');
        }
        
		$data = ['page' => $page];

		$this->view()->render('pages.edit', $data);
	}
    
    /**
     * @bind \Nanozen\Models\Binding\UpdatePageBinding
     */
    public function update($id) 
    {
        Redirect::guests('/');
        
        echo "This will update page.";
    }
    
    public function delete($id) 
    {
        Redirect::guests('/');
        
        $this->pageRepository->remove($id);
        
        Redirect::to('/back');
    }

}