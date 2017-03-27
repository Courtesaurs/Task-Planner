<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.03.17
 * Time: 22:58
 */

namespace App;


class Task
{
    private $id;
    private $title;
    private $descritpion;
    private $status;
    private $deadline;

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

    public function assignToUser($user_id)
    {

    }

    public function unassign()
    {
        
    }

    public static function get($id)
    {

    }

    public static function getObjects($args)
    {

    }
}