<?php


namespace app\database;

use PDO;
use PDOException;

class Connection
{
    public $host = 'localhost';
    public $username = 'root';
    public $password = 'kiko';
    public $database = 'family';


    public function getConnection()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $conn;
    }
}