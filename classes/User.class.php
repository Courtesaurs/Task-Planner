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
        $this->role = Role::get($role_id);
        $this->username = $username;
        $this->password = md5($password);
    }

    public function getRole()
    {

    }

    public function save()
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

    public function login()
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
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM user WHERE user.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new User($row->name, $row->role_id, $row->username, $row->password, $row->id);

        }
        catch (PDOException $e)
        {
            echo 'Failed to get the user: ' . $e->getMessage();
        }

    }

    public static function getObjects($args)
    {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM user";
            $stmt = $db->pdo->query($sql);

            $users = array();
            foreach($stmt as $row) {
                $users[] = new Role(
                    $row->name,
                    $row->role_id,
                    $row->username,
                    $row->password,
                    $row->id
                );
            }

            return $users;

        }
        catch (PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }
}