<?php

namespace Nanozen\Controllers;

use Nanozen\App\Injector;
use Nanozen\Providers\Redirect\RedirectProvider as Redirect;
use Nanozen\Providers\AllowAccess\AllowAccessProvider as AllowAccess;
use Nanozen\Providers\Controller\BaseControllerProvider as BaseController;	

/**
 * Class SettingsController
 *
 * @author brslv
 * @package Nanozen\Controllers 
 */
class SettingsController extends BaseController
{
	
	public function general()
	{
		AllowAccess::to('admin', '/');

		$this->view()->render('settings.general');
	}

	/**
	 * @bind \Nanozen\Models\Binding\SettingsBinding
	 */
	public function postGeneral()
	{
		AllowAccess::to('admin', '/');

		$settingsRepository = Injector::call('\Nanozen\Repositories\SettingRepository');

		$settingsRepository->update($this->binding);
	
		Redirect::to('/settings/general');
	}

	public function background()
	{
		AllowAccess::to('admin', '/');

		$this->view()->render('settings.background');
	}

	public function postBackgroundImage()
	{
		
	}

	public function postBackgroundColor()
	{
		
	}
}