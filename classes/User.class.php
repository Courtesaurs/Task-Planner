<?php

//use App\BaseModel;
//use App\Role;

namespace App;


class User // extends App\BaseModel
{
    private $id;
    private $name;
    private $role;
    private $username;
    private $password;

    public function __construct($name, $role_id, $username, $password)
    {
        $this->name = $name;
        $this->role = Role::get($role_id);
        $this->username = $username;
        $this->password = md5($password);
    }

    public function getRole()
    {

    }

    public function save()
    {

    }

    public function getTasks()
    {

    }

    public function assignToRole($role_id)
    {

    }

    public static function get($id)
    {

    }

    public static function getObjects($args)
    {

    }
}