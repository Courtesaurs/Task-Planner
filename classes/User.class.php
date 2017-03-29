<?php

//use App\BaseModel;
//use App\Role;

namespace App;

require_once dirname(__FILE__) . "/AbstractModel.class.php";
require_once dirname(__FILE__) . "/DataBase.class.php";
require_once dirname(__FILE__) . "/Role.class.php";

class User extends AbstractModel
{
    public $id;
    public $name;
    public $role;
    public $username;
    public $password;

    public function __construct($name, $username, $role_id=1, $password) {
        $this->name = $name;
        $this->username = $username;
        $this->role = Role::get($role_id);
        $this->password = md5($password);
    }

    public function getRole() {

    }

    public function save() {

        $db = new DataBase();

        try {
            $query = "INSERT INTO user (`name`, `role_id`, `username`, `password`) VALUES ('$this->name', '". $this->role->id ."', '$this->username', '$this->password');";
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

    }

    public function assignToRole($role_id) {

    }

    public static function get($id) {

        $db = new DataBase();

        try {

            $sql = "SELECT * FROM user WHERE user.id=".$id;
            $stmt = $db->pdo->query($sql);
            $row = $stmt->fetchObject();

            return new User($row->name, $row->role_id, $row->username, $row->password, $row->id);

        }
        catch (\PDOException $e) {

            echo 'Failed to get the user: ' . $e->getMessage();
        }

    }

    //TODO: filters
    public static function getObjects($args) {
        $db = new DataBase();

        try {

            $sql = "SELECT * FROM user";
//          $sql .= DataBase::filter($args);

            $stmt = $db->pdo->query($sql);

            $users = array();
            foreach($stmt as $row) {
                $users[] = new Role(
                    $row['name'],
                    $row['role_id'],
                    $row['username'],
                    $row['password'],
                    $row['id']
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