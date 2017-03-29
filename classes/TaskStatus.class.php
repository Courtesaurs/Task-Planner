<?php

namespace App;

require_once dirname(__FILE__) . "/AbstractModel.class.php";
require_once dirname(__FILE__) . "/DataBase.class.php";

class TaskStatus extends AbstractModel
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

            $query = "INSERT INTO task_status (`name`, `description`) VALUES ('$this->name', '$this->description');";
            $result = $db->pdo->query($query);

            return $result;

        }
        catch (\PDOException $e)
        {
            echo 'Failed to create role: ' . $e->getMessage();
        }
        return $db->query($query);
    }

    public function getTasks()
    {
        $db = new DataBase();

        try
        {

            $query = "SELECT * FROM user WHERE user.role_id=".$this->id;
            $stmt = $db->pdo->query($query);

            $users = array();
            foreach($stmt as $row) {
                $users[] = new Taks(
                    $row['name'],
                    $row['description'],
                    $row['status_id'],
                    $row['deadline'],
                    $row['id']
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
            $sql = "SELECT * FROM task_status WHERE task_status.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new TaskStatus($row->title, $row->description, $row->id);

        }
        catch (\PDOException $e)
        {
            echo 'Failed to get the task status: ' . $e->getMessage();
        }
    }

    public static function getObjects($args=array())
    {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM task_status";
            $stmt = $db->pdo->query($sql);

            $statuses = array();
            foreach($stmt as $row) {
                $statuses[] = new TaskStatus(
                    $row['title'],
                    $row['description'],
                    $row['id']
                );
            }

            return $statuses;

        }
        catch (\PDOException $e)
        {
            echo 'Failed to get the task status: ' . $e->getMessage();
        }
    }
    
    public static function createTable()
    {
        // TODO: Implement createTable() method.
    }
}