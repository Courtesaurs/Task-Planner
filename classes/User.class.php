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

    public function __construct($id, $name, $username, $password, $role_id=1) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = md5($password);
        $this->role = $role_id;//Role::get($role_id);
    }

    public function getRole() {
        return $this->role;
    }

    public function save() {

        $db = new DataBase();

        try {
            $query = "INSERT INTO user (`name`, `role_id`, `username`, `password`) VALUES ('$this->name', '$this->role', '$this->username', '$this->password');";

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

    public static function updateRole($user_id, $role_id) {
        $db = new DataBase();

        try {
            $query = "UPDATE user SET role_id=$role_id WHERE id=$user_id;";

            $result = $db->pdo->query($query);
        }
        catch (\PDOException $e) {
            echo 'Failed to update the user: ' . $e->getMessage();
        }

        return $result;
    }

    public static function get($id) {

        $db = new DataBase();

        try {

            $sql = "SELECT * FROM user WHERE user.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new User($row->id, $row->name, $row->username, $row->password, $row->role_id);

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

            return new User($row->id, $row->name, $row->username, $row->password, $row->role_id);

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
                    $row['name'],
                    $row['username'],
                    $row['password'],
                    $row['role_id']
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