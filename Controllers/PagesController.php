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
    
    public function show()
    {
        // TODO: get a page,
        // constructed with it's blocks and display it.
    }

	/**
	 * Stores a page to the database.
	 *
	 * @bind \Nanozen\Models\Binding\PageBinding
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

        $page = $this->pageRepository->find(['id' => $id], false);
        
        if (is_null($page)) {
            http_response_code(404);
            $this->view()->render('errors.404');
        }
        
		$data = ['page' => $page];

		$this->view()->render('pages.edit', $data);
	}
    
    /**
     * @bind \Nanozen\Models\Binding\PageBinding
     */
    public function update($id) 
    {
        Redirect::guests('/');
        
        $result = $this->pageRepository->update($id, $this->binding);
        
        if ( ! $result) {
            Redirect::loggedUser('/pages/' . $id . '/edit');
        }
        
        Redirect::loggedUser('/back');
    }
    
    public function delete($id) 
    {
        Redirect::guests('/');
        
        $result = $this->pageRepository->remove($id);
        
        if ( ! $result) {
            Redirect::loggedUser('/pages/' . $id . '/edit');
        }
        
        Redirect::loggedUser('/back');
    }

}