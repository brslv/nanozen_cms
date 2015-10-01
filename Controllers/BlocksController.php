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
    
    private $regions;
    
    public function __construct()
    {
        $this->blockRepository = Injector::call('\Nanozen\Repositories\BlockRepository');
        $this->pageRepository = Injector::call('\Nanozen\Repositories\PageRepository');
        $this->regions = $this->pageRepository->getRegions();
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
        
        if ($view != "") {
            $this->view()->render($view, ['regions' => $this->regions]);
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
    
    public function edit($id)
    {
        Redirect::guests('/');

        $block = $this->blockRepository->find(['id' => $id], false);
        
        if (is_null($block)) {
            http_response_code(404);
            $this->view()->render('errors.404');
        }
        
		$data = [
            'block' => $block,
            'regions' => $this->regions,
        ];

        if ($block->getBlockType() == Block::BLOCK_TYPE_CONTENT_BOX) {
            $view = 'blocks.edit.content-box';
        } 
        
        if ($block->getBlockType() == Block::BLOCK_TYPE_FORM) {
            $view = 'blocks.edit.form';
        }
        
        if ($block->getBlockType() == Block::BLOCK_TYPE_GRID) {
            $view = 'blocks.edit.grid';
        }
        
		$this->view()->render($view, $data);
    }
    
    /**
     * @bind \Nanozen\Models\Binding\StoreContentBoxBlockBinding
     */
    public function update($id)
    {
        Redirect::guests('/');
        
        $blockBinding = $this->binding;
        
        $result = $this->blockRepository->update($id, $this->binding);
        
        if ( ! $result) {
            Redirect::loggedUser('/blocks/' . $id . '/edit');
        }
        
        Redirect::loggedUser('/back');
    }
    
    public function delete($id) 
    {
        Redirect::guests('/');
        
        $result = $this->blockRepository->remove($id);
        
        if ( ! $result) {
            Redirect::loggedUser('/blocks/' . $id . '/edit');
        }
        
        Redirect::loggedUser('/back');
    }
}
