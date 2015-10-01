<?php

namespace Nanozen\Models;

/**
 * Class Page
 *
 * @author brslv
 * @package Nanozen\Models 
 */
class Page 
{

    private $id;

    private $title;

    private $active;

    private $deletedOn;

    public function __construct($id, $title, $active, $deletedOn)
    {
        $this->id = $id;
        $this->title = $title;
        $this->active = $active;
        $this->deletedOn = $deletedOn; 
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getDeletedOn()
    {
        return $this->deletedOn;
    }

}