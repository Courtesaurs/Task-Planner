<?php

namespace App;


class Role
{
    private $id;
    private $name;
    private $descritpion;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function save()
    {

    }

    public function getUsers()
    {
        
    }

    public static function get($id)
    {

    }

    public static function getObjects($args)
    {

    }
}