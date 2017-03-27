<?php

namespace App;


class DataBase
{
    var $pdo;

    public function __construct()
    {
        try {

            $this->pdo = new \PDO ("mysql:host=localhost;dbname=task_manager", "root", "1337");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo 'DB connection failed: ' . $e->getMessage();

        }
    }
}