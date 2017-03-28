<?php

namespace App;


class DataBase
{
    var $pdo;

    public function __construct()
    {
        try {

            $this->pdo = new \PDO ("mysql:host=localhost;dbname=tasm_manager1", "root", "1337");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo 'DB connection failed: ' . $e->getMessage();

        }
    }
    
    public static function initDataBase()
    {
        // TODO: тут вызываем createTable() всех моделей в нужной последовательности
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