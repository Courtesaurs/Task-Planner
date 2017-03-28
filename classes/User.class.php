<?php

//use App\BaseModel;
//use App\Role;

namespace App;

require dirname(__FILE__) . "/DataBase.class.php";

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
        $this->role = $role_id;//Role::get($role_id);
        $this->username = $username;
        $this->password = md5($password);
    }

    public function getRole()
    {

    }

    public function register()
    {
        $db = new DataBase();

        try
        {

            $query = "INSERT INTO user (`name`, `role_id`, `username`, `password`) VALUES ('$this->name', '$this->role', '$this->username', '$this->password');";
            $result = $db->pdo->query($query);

            return $result;

        }
        catch (PDOException $e)
        {
            echo 'Failed to register the user: ' . $e->getMessage();
        }
        return $db->query($query);
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