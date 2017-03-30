<?php

namespace App;


class DataBase
{
    var $pdo;

    public function __construct()
    {
        try {

            $this->pdo = new \PDO ("mysql:host=localhost;dbname=tm_1", "root", "1337");
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