<?php

namespace Nanozen\Contracts\Factories;

use Nanozen\Models\Block;
use Nanozen\Contracts\Factories\FactoryContract;

/**
 * Class of BlockFactory
 *
 * @author brslv
 * @package Nanozen\Contracts\Factories
 */
class BlockFactory implements FactoryContract
{
    public static function make($info)
    {
        if ($info == false || is_null($info)) {
            return null;
        }
        
        $id = $info->id;
		$title = $info->title;
        $description = $info->description;
		$content = $info->content;
        $blockTypeId = $info->blockTypeId;
        $pageId = $info->pageId;
        $region = $info->region;
		$active = $info->active;
		$deletedOn = $info->deleted_on;
        $hash = $info->hash;
        
        return new Block(
                $id, 
                $title, 
                $description, 
                $content, 
                $blockTypeId, 
                $pageId, 
                $region, 
                $active, 
                $deletedOn, 
                $hash);
    }
    
}
