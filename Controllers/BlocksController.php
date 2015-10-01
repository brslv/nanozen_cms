<?php

namespace Nanozen\Controllers;

use Nanozen\Models\Block;
use Nanozen\App\Injector;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;

/**
 * Class BlocksController
 *
 * @author brslv
 * @package Nanozen\Controllers
 */
class BlocksController extends BaseController
{
    
    private $blockRepository;
    
    private $pageRepository;
    
    public function __construct()
    {
        $this->blockRepository = Injector::call('\Nanozen\Repositories\BlockRepository');
        $this->pageRepository = Injector::call('\Nanozen\Repositories\PageRepository');
    }
    
    public function create($type)
    {   
        Redirect::guests('/');
        
        switch ($type) {
            case Block::BLOCK_TYPE_FORM:
                $view = 'blocks.create.' . Block::BLOCK_TYPE_FORM;
                break;
            case Block::BLOCK_TYPE_CONTENT_BOX:
                $view = 'blocks.create.' . Block::BLOCK_TYPE_CONTENT_BOX;
                break;
            case Block::BLOCK_TYPE_GRID:
                $view = 'blocks.create.' . Block::BLOCK_TYPE_GRID;
        }
        
        $regions = $this->pageRepository->getRegions();
        
        if ($view != "") {
            $this->view()->render($view, compact('regions'));
        }
        
        $this->view()->render('errors.404');
    }
    
    /**
     * @bind \Nanozen\Models\Binding\StoreContentBoxBlockBinding
     */
    public function store($type)
    {
        Redirect::guests('/');
        
        $blockBinding = $this->binding;
        
        $persistedBlock = $this->blockRepository->save($blockBinding);
        
        if ($persistedBlock) {
            Redirect::to('/back');
        } else {
			Redirect::to('/blocks/' . $type . '/create');
		}
    }
    
}
