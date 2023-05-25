<?php

namespace app\Mo;

use PDO;
use Exception;

require_once __DIR__ . '/../../config/connection.php';

use app\database\Connection as Conn;

class Model
{
    protected $id, $connect;

    public function __construct()
    {
        $db = new Conn();
        $this->connect = $db->getConnection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public  function getAll($table_name)
    {
        try {
            $select = "SELECT * from $table_name";
            $query = $this->connect->prepare($select);
            $query->execute();
            $results = array();
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                $results[] = $row;
            }
            return $results;
        } catch (Exception $e) {
            echo "error while fetch families" . $e->getMessage();
        }
    }
}