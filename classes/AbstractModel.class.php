<?php

namespace App;


abstract class AbstractModel
{
    abstract protected function save();
    abstract protected static function get($id);
    abstract protected static function getObjects($args);
    abstract protected static function createTable();
}