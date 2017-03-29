<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.03.17
 * Time: 22:58
 */

namespace App;

require_once dirname(__FILE__) . "/AbstractModel.class.php";
require_once dirname(__FILE__). "/DataBase.class.php";
require_once dirname(__FILE__). "/TaskStatus.class.php";


class Task extends AbstractModel
{
    public $id;
    public $title;
    public $descritpion;
    public $status;
    public $deadline;
    public $executor_id;

    public function __construct($title, $description, $status_id=1, $deadline=false, $id=false, $executor_id=false)
    {
        $this->title = $title;
        $this->descritpion = $description;
        $this->status = TaskStatus::get($status_id);
        $this->deadline = $deadline;

        if ($id) {
            $this->id = $id;
        }
        if ($executor_id) {
            $this->executor_id = $executor_id;
        }
    }

    public function save()
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

            return new Task(
                $row->title,
                $row->description,
                $row->status_id,
                $row->deadline,
                $row->id,
                $row->executor_id
            );
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
                    $row['descritpion'],
                    $row['status_id'],
                    $row['deadline'],
                    $row['id'],
                    $row['executor_id']
                );
            }

            return $tasks;

        }
        catch (PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }

    public static function createTable()
    {
        // TODO: Implement createTable() method.
    }
}