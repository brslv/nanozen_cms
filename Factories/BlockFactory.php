<?php

namespace Nanozen\Factories;

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
    const DEFAULT_BLOCK_ACTIVE = 1;
    
    public static function make($info)
    {
        if ($info == false || is_null($info)) {
            return null;
        }
        
        $id = $info->id;
		$title = $info->title;
        $description = $info->description;
		$content = $info->content;
        $blockTypeId = $info->block_type_id;
        $pageId = $info->page_id;
        $region = $info->region;
		$active = isset($info->active) ? $info->active : self::DEFAULT_BLOCK_ACTIVE;
		$deletedOn = isset($info->deletedOn) ? $info->deletedOn : null;
        $hash = isset($info->hash) ? $info->hash : null;
        
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
