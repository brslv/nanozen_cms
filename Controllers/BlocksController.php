<?php

namespace Nanozen\Controllers;

use Nanozen\Models\Block;
use Nanozen\App\Injector;
use Nanozen\Models\UserRoles;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\AllowAccess\AllowAccessProvider as AllowAccess;
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
        AllowAccess::to([UserRoles::ADMIN, UserRoles::EDITOR], '/back');
        
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
     * @bind \Nanozen\Models\Binding\BlockBinding
     */
    public function store($type)
    {
        AllowAccess::to([UserRoles::ADMIN, UserRoles::EDITOR], '/');
        
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
        AllowAccess::to([UserRoles::ADMIN, UserRoles::EDITOR], '/');

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
     * @bind \Nanozen\Models\Binding\BlockBinding
     */
    public function update($id)
    {
        AllowAccess::to([UserRoles::ADMIN, UserRoles::EDITOR], '/');
        
        $blockBinding = $this->binding;
     
        $result = $this->blockRepository->update($id, $this->binding);
        
        if ( ! $result) {
            Redirect::loggedUser('/blocks/' . $id . '/edit');
        }
        
        Redirect::loggedUser('/back');
    }
    
    public function delete($id) 
    {
        AllowAccess::to([UserRoles::ADMIN, UserRoles::EDITOR], '/');
        
        $result = $this->blockRepository->remove($id);
        
        if ( ! $result) {
            Redirect::loggedUser('/blocks/' . $id . '/edit');
        }
        
        Redirect::loggedUser('/back');
    }
}
