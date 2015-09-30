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
    
    public function __construct()
    {
        $this->constructor = Injector::call('\Nanozen\Repositories\BlockRepository');
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
            $this->view()->render($view);
        }
        
        $this->view()->render('errors.404');
    }
    
}
