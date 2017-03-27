<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.03.17
 * Time: 22:58
 */

namespace App;

require dirname(__FILE__). "/DataBase.class.php";


class Task
{
    private $id;
    public $title;
    public $descritpion;
    public $status;
    public $deadline;

    public function __construct($title, $description, $status=0, $deadline=false, $id=false)
    {
        $this->title = $title;
        $this->descritpion = $description;
        $this->status = $status;
        $this->deadline = $deadline;

        if ($id) {
            $this->id = $id;
        }
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
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM task WHERE task.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return Task($row->title, $row->description, $row->id);

        }
        catch (PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }

    public static function getObjects($args=array())
    {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM task";
            $stmt = $db->pdo->query($sql);

            $tasks = array();
            foreach($stmt as $row) {
                $tasks[] = new Task(
                    $row['title'],
                    $row['description'],
                    $row['status'],
                    $row['deadline'],
                    $row['id']
                );
            }

            return $tasks;

        }
        catch (PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }
}