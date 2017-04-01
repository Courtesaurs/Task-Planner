<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.03.17
 * Time: 22:58
 */

namespace App;

require_once dirname(__FILE__) . "/AbstractModel.class.php";
require_once dirname(__FILE__) . "/DataBase.class.php";
require_once dirname(__FILE__) . "/TaskStatus.class.php";
require_once dirname(__FILE__) . "/User.class.php";


class Task extends AbstractModel {
    public $id;
    public $title;
    public $description;
    public $status;
    public $executor;
    public $deadline;

    public function __construct($title, $description, $status_id=1, $executor_id=false, $id=false, $deadline=false)
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status_id; //\App\TaskStatus::get($status_id);
        $this->deadline = $deadline;

        if ($id) {
            $this->id = $id;
        }
        if ($executor_id) {
            $this->executor_id = $executor_id; //User::get($executor_id);
        }
    }

    public function save() {
        $db = new DataBase();

        try
        {
            $query = "INSERT INTO task (`title`, `description`, `user_id`, `status_id`) VALUES ('$this->title' , '$this->description', '$this->executor_id', 1);";

            #die($query);

            $result = $db->pdo->query($query);
        }
        catch (\PDOException $e)
        {
            echo 'Failed to save the task: ' . $e->getMessage();
        }

        return $result;
    }

    public function update() {
        $db = new DataBase();

        try {
            $query = "UPDATE task SET status_id=$this->status, user_id=$this->executor_id WHERE id=$this->id;";

            $result = $db->pdo->query($query);
        }
        catch (\PDOException $e) {
            echo 'Failed to save the task: ' . $e->getMessage();
        }

        return $result;
    }

    public function setStatus($status_id) {
        $this->status = $status_id;
    }

    public function setExecutor($executor_id) {
        $this->executor_id = $executor_id;
    }

    public static function updateStatus($task_id, $status_id, $executor_id = NULL) {
        $task = \App\Task::get($task_id);
        $task->setStatus($status_id);
        if ($executor_id) {
            $task->setExecutor($executor_id);
        }

        $task->update();
    }

    public static function get($id) {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM task WHERE id=$id";
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();



            return new Task(
                $row->title,
                $row->description,
                $row->status_id,
                $row->user_id,
                $row->id
            );
        }
        catch (\PDOException $e)
        {
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }

    public static function getObjects( $args = array() ) {
        $db = new DataBase();
        if(count($args)) {
            if ($args["page"] > 1) {
                $limit = "LIMIT " . ($args["page"] - 1) * $args["tasksPerPage"] . ", " . $args["tasksPerPage"];
            } else {
                $limit = "LIMIT " . $args["tasksPerPage"];
            }
        }
        try
        {
            $sql = "SELECT * FROM task $limit";
            $stmt = $db->pdo->query($sql);

            $tasks = array();
            foreach($stmt as $row) {
                $tasks[] = new Task(
                    $row['title'],
                    $row['description'],
                    $row['status_id'],
                    $row['user_id'],
                    $row['id']
                );
            }

            return $tasks;

        }
        catch (\PDOException $e)
        {
            echo 'Failed to get the tasks: ' . $e->getMessage();
        }
    }

    public static function getTaskAmount($user_id = NULL) {
        $db = new DataBase();

        if ($user_id) {
            $where = "WHERE `user_id`=$user_id";
        }

        try
        {
            $sql = "SELECT COUNT(id) FROM task $where";
            $stmt = $db->pdo->query($sql);

            foreach ($stmt as $row) {
                return $row[0];
            }

            return false;
        }
        catch (\PDOException $e)
        {
            echo 'Failed to get the amount of tasks: ' . $e->getMessage();
        }
    }

    public static function getPageAmount($tasksPerPage, $id = NULL) {
        $tasks = self::getTaskAmount($id);
        $increment = $tasks != $tasksPerPage ? 1 : 0;
        return floor($tasks / $tasksPerPage) + $increment;
    }

    public static function isFirstPage($page) {
        return $page == 1;
    }

    public static function isLastPage($page, $tasksPerPage, $id = NULL) {
        return $page * $tasksPerPage >= self::getTaskAmount($id);
    }

    public static function createTable() {
        // TODO: Implement createTable() method.
    }
}