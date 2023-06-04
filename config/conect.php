<?php
session_start();

class conect{
    protected  static $pdo;

    public function __construct($host = 'localhost', $dbname = 'Turismo', $username = 'root', $password = '') {
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }  
};
?>