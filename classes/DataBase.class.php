<?php


namespace App;

include_once "db-config.php";

class DataBase
{
    var $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO ("mysql:host=localhost;dbname=task_manager", DB_USER, DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {

            //echo 'DB connection failed: ' . $e->getMessage();

        }
    }

    /* TODO: some smart filtering. Supporting "AND", "OR", "=", ">" and so on
    public static function filter($args)
    {
        $sql = '';

        if($args) {
            $sql .= " WHERE ";

            foreach($args as $criteria => $value) {
                $sql .= "$criteria=$value";
            }
        }

        return $sql;
    } */
}