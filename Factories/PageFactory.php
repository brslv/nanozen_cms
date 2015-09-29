<?php

namespace Nanozen\Factories;

use Nanozen\Models\Page;
use Nanozen\Contracts\Factories\FactoryContract;

/**
* Class PageFactory
*
* @author brslv
* @package Nanozen\Factories
*/
class PageFactory implements FactoryContract
{

	public static function make($info)
	{
		$id = $info->id;
		$title = $info->title;
		$content = $info->content;
		$active = $info->active;
		$deletedOn = $info->deleted_on;

		return new Page($id, $title, $content, $active, $deletedOn);
	}

}