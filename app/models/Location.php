<?php

namespace app\Mo;

use app\Mo\Model;
use PDO;

require_once __DIR__  . '/Model.php';

class Location extends Model
{
    protected $id, $location_name;


    public function setName($location_name)
    {
        $this->location_name = $location_name;
    }

    public function getName()
    {
        return $this->location_name;
    }


    public function getAllLocation()
    {
        $results = $this->getAll('locations');
        $locations = array();
        foreach ($results as $result) {
            $location = new Location();
            $location->setId($result->id);
            $location->setName($result->location_name);
            $locations[] = $location;
        }
        return $locations;
    }

    public function getLocationById($location_id)
    {
        $select = "SELECT * FROM locations  where id = :location_id";
        $query = $this->connect->prepare($select);
        $query->execute(['location_id' => $location_id]);
        $location = $query->fetch(PDO::FETCH_OBJ);
        return $location;
    }
}
