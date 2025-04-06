<?php

class Database {
    private $connection;

    public function __construct() {
        $host = "127.0.0.1";
        $db   = "UrbanVouge_db";
        $user = "root";
        $pass = ""; // ako koristiš XAMPP bez šifre

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode([
                "success" => false,
                "message" => "Connection failed: " . $e->getMessage()
            ]);
            exit;
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
