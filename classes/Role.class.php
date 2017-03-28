<?php

namespace App;

require dirname(__FILE__) . "/DataBase.class.php";

class Role
{
    public $id;
    public $name;
    public $descritpion;

    const ROLE_DEVELOPER = 1;
    const ROLE_TEAMLEAD = 2;
    const ROLE_DIRECTOR = 3;

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

            $query = "INSERT INTO role (`name`, `description`) VALUES ('$this->name', '$this->descritpion');";
            $result = $db->pdo->query($query);

            return $result;

        }
        catch (PDOException $e)
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
            $result = $db->pdo->query($query);

            return $result;

        }
        catch (PDOException $e)
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
            $sql = "SELECT * FROM role WHERE role.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new Role($row->title, $row->description, $row->id);

        }
        catch (PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }

    public static function getObjects($args)
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
        catch (PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }
}