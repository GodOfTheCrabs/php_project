<?php


trait TraitTableUser {
    public static function getTable() {
        return 'users';
    }
}

trait TraitTableEvent {
    public static function getTable() {
        return 'events';
    }
}

abstract class Model {
    public static $db;

    public static function connect()
    {
        $host_dbname = "mysql:host=localhost;dbname=course";
        $username = "root";
        $password = "";

        self::$db = new PDO($host_dbname, $username, $password);
    }

    public static function findAll() 
    {
        self::connect();
        $table = static::getTable();
        $sql = "SELECT * FROM `$table`";

        $stmt = self::$db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findOne($data) {
        self::connect();
        $table = static::getTable();
        $sql = "SELECT * FROM `$table` WHERE `id` = :id";

        $stmt = self::$db->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($data) {
        self::connect();
        $table = static::getTable();
        $sql = "DELETE FROM `$table` WHERE `id` = :id";
        $stmt = self::$db->prepare($sql);
        return $stmt->execute($data);
    }

    abstract public static function add($data);
    abstract public static function edit($data);

}