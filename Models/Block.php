<?php

namespace Nanozen\Models;

/**
 * Class of Block
 *
 * @author brslv
 * @package Nanozen\Models
 */
class Block
{
    
    const BLOCK_TYPE_FORM = 'form';
    
    const BLOCK_TYPE_CONTENT_BOX = 'content-box';
    
    const BLOCK_TYPE_GRID = 'grid';
    
    private $id;
    
    private $title;
    
    private $description;
    
    private $content;
    
    private $blockTypeId;
    
    private $pageId;
    
    private $region;
    
    private $active;
    
    private $deletedOn;
    
    private $hash;
    
    function __construct(
            $id, 
            $title, 
            $description, 
            $content, 
            $blockTypeId, 
            $pageId, 
            $region, 
            $active, 
            $deletedOn, 
            $hash
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->blockTypeId = $blockTypeId;
        $this->pageId = $pageId;
        $this->region = $region;
        $this->active = $active;
        $this->deletedOn = $deletedOn;
        $this->hash = $hash;
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getBlockTypeId()
    {
        return $this->blockTypeId;
    }

    public function getPageId()
    {
        return $this->pageId;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getDeletedOn()
    {
        return $this->deletedOn;
    }

    public function getHash()
    {
        return $this->hash;
    }


    
}
