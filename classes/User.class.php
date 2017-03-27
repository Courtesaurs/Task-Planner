<?php

use App\BaseModel;
use App\Role;

namespace App;

class User extend App\BaseModel
{
    private $id;
    private $name;
    private $role;
    private $username;

    // TODO: Override BaseModel method to grab the role object into this
    public function get($id)
    {

    }

    public function getRole()
    {

    }

    public static function getUsers()
    {

    }
}