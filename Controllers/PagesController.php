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
    
    private $blockRepository;

    public function __construct()
	{
	    $this->pageRepository = Injector::call('\Nanozen\Repositories\PageRepository');
        $this->blockRepository = Injector::call('\Nanozen\Repositories\BlockRepository');
	}
	
	public function create()
	{
		Redirect::guests('/');

		$this->view()->render('pages.create');
	}
    
    public function show($id)
    {
        $this->view()->escape(false);
        
        $page = $this->pageRepository->find(['id' => $id]);
        
        $regionOneBlocks = $this->blockRepository->find([
            'page_id' => $page->getId(),
            'region' => 1,
        ], true, true);
        
        $regionTwoBlocks = $this->blockRepository->find([
            'page_id' => $page->getId(),
            'region' => 2,
        ], true, true);
        
        $regionThreeBlocks = $this->blockRepository->find([
            'page_id' => $page->getId(),
            'region' => 3,
        ], true, true);
        
        $data = [
            'blocks' => [
                'regionOne' => $regionOneBlocks,
                'regionTwo' => $regionTwoBlocks,
                'regionThree' => $regionThreeBlocks,
            ],
        ];
        
        $this->view()->render('pages.show', $data);
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