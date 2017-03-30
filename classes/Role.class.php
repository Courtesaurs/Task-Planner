<?php

namespace App;

require_once dirname(__FILE__) . "/AbstractModel.class.php";
require_once dirname(__FILE__) . "/DataBase.class.php";

class Role extends AbstractModel
{
    public $id;
    public $name;
    public $description;

    public function __construct($name, $description, $id=false)
    {
        $this->name = $name;
        $this->description = $description;
        if ($id) {
            $this->id = $id;
        }
    }

    public function save()
    {
        $db = new DataBase();

        try
        {

            $query = "INSERT INTO role (`name`, `description`) VALUES ('$this->name', '$this->description');";
            $result = $db->pdo->query($query);

            return $result;

        }
        catch (\PDOException $e)
        {
            echo 'Failed to create role: ' . $e->getMessage();
        }
        return $db->query($query);
    }

    public function getUsers()
    {
        $db = new DataBase();

        try
        {

            $query = "SELECT * FROM user WHERE user.role_id=".$this->id;
            $stmt = $db->pdo->query($query);

            $users = array();
            foreach($stmt as $row) {
                $users[] = new User(
                    $row['id'],
                    $row['name'],
                    $row['role_id'],
                    $row['password']
                );
            }

            return $users;


        }
        catch (\PDOException $e)
        {
            echo 'Failed to get users: ' . $e->getMessage();
        }
        return $db->query($query);
    }

    public static function get($id)
    {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM role WHERE id=$id";
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new Role($row->title, $row->description, $row->id);

        }
        catch (\PDOException $e)
        {
            echo 'Failed to get user role: ' . $e->getMessage();
        }
    }

    public static function getObjects($args=array())
    {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM role";
            $stmt = $db->pdo->query($sql);

            $roles = array();
            foreach($stmt as $row) {
                $roles[] = new Role(
                    $row['title'],
                    $row['description'],
                    $row['id']
                );
            }

            return $roles;
        }
        
        catch (\PDOException $e)
        {
            echo 'Failed to get user role: ' . $e->getMessage();
        }
    }
    
    public static function createTable()
    {
        // TODO: Implement createTable() method.
    }
}