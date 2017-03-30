<?php

//use App\BaseModel;
//use App\Role;

namespace App;

require_once dirname(__FILE__) . "/AbstractModel.class.php";
require_once dirname(__FILE__) . "/DataBase.class.php";
require_once dirname(__FILE__) . "/Role.class.php";
require_once dirname(__FILE__) . "/Task.class.php";

class User extends AbstractModel
{
    public $id;
    public $name;
    public $role;
    public $username;
    public $password;

    public function __construct($id, $username, $role_id=1, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->role = Role::get($role_id);
        $this->password = md5($password);
    }

    public function getRole() {
        return $this->role;
    }

    public function save() {

        $db = new DataBase();

        $role_id = $this->role->id;

        try {
            $query = "INSERT INTO user (`name`, `role_id`, `username`, `password`) VALUES ('$this->username', '$role_id', '$this->username', '$this->password');";

            $result = $db->pdo->query($query);
        }
        catch (\PDOException $e) {
            echo ('Failed to register the user: ' . $e->getMessage());
            $result = false;
        }

        return $result;
    }

    public function login() {

        $db = new DataBase();

        $login = false;

        try {
            $query = "SELECT username, password, id FROM user WHERE username='$this->username'";
            $result = $db->pdo->query($query);
            while ($row = $result->fetch()) {
                if($row['password'] == $this->password) {
                    $login = true;
                }
            }

        }
        catch (\PDOException $e) {
            echo ('Failed to login: ' . $e->getMessage());
            $result = false;
        }

        return $login;
    }

    public function getTasks() {
        $db = new DataBase();

        try
        {
            $sql = "SELECT * FROM task WHERE user_id=$this->id";
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
            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }

    public function getID() {
        return $this->id;
    }

    public function assignToRole($role_id) {

    }

    public static function get($id) {

        $db = new DataBase();

        try {

            $sql = "SELECT * FROM user WHERE user.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new User($row->id, $row->username, $row->role_id, $row->password);

        }
        catch (\PDOException $e) {

            echo 'Failed to get the user: ' . $e->getMessage();
        }
    }

    public static function getByName($name)
    {

        $db = new DataBase();

        try {

            $sql = "SELECT * FROM user WHERE username='$name';";

            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new User($row->id, $row->username, $row->role_id, $row->password);

        }
        catch (\PDOException $e) {

            echo 'Failed to get the user: ' . $e->getMessage();
        }
    }

    //TODO: filters
    public static function getObjects($args = array()) {
        $db = new DataBase();

        try {

            $sql = "SELECT * FROM user";
//          $sql .= DataBase::filter($args);

            $stmt = $db->pdo->query($sql);

            $users = array();
            foreach($stmt as $row) {
                $users[] = new User(
                    $row['id'],
                    $row['username'],
                    $row['role_id'],
                    $row['password']
                );
            }

            return $users;

        }
        catch (\PDOException $e) {

            echo 'Failed to get the task: ' . $e->getMessage();
        }
    }

    public static function createTable() {
        // TODO: Implement createTable() method.
    }
}