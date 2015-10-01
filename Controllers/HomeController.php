<?php

namespace Nanozen\Controllers;

use Nanozen\App\Injector;
use Nanozen\Utilities\Csrf;
use Nanozen\Utilities\Html\Form;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;

/**
 * Class HomeController
 *
 * @author brslv
 * @package Nanozen\Controllers
 */
class HomeController extends BaseController
{
    private $pageRepository;
    
    public function __construct()
    {
        $this->pageRepository = Injector::call('\Nanozen\Repositories\PageRepository');
    }
    
	public function index()
	{
        $query = "SELECT value FROM options WHERE name = 'app_homepage'";
        $homePageId = $this->db()->query($query)
                               ->fetch(\PDO::FETCH_ASSOC, false)['value'];
        
        if (is_numeric($homePageId)) {
            $homepageExists = $this->pageRepository->find(['id' => $homePageId]);
            
            if ($homepageExists) {
                $pagesController = Injector::call('\Nanozen\Controllers\PagesController');
            
                $pagesController->show($homePageId);
            }
        }
        
        $this->view()->render('home.index');
	}
}