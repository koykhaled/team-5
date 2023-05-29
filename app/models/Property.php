<?php

declare(strict_types=1);

namespace app\Mo;

use app\Mo\Model;
use PDO;

require_once 'Model.php';

class Property extends Model
{
    protected string $prop_type;
    protected  $prop_amount, $prop_earnings;
    protected  $family_id;

    public function setPropType($prop_type)
    {
        $this->prop_type = $prop_type;
    }
    public function setPropAmount($prop_amount)
    {
        $this->prop_amount = $prop_amount;
    }
    public function setPropEarnings($prop_earnings)
    {
        $this->prop_earnings = $prop_earnings;
    }
    public function setFamilyId($family_id)
    {
        $this->family_id = $family_id;
    }
    public function getPropType()
    {
        return $this->prop_type;
    }
    public function getPropAmount()
    {
        return $this->prop_amount;
    }
    public function getPropEarnings()
    {
        return $this->prop_earnings;
    }
    public function getFamilyId()
    {
        return $this->family_id;
    }
    public function create_property()
    {
        $insert = "INSERT INTO properties (prop_type,prop_amount,earnings,family_id) values(:prop_type,:prop_amount,:earnings,:family_id)";
        $update = "UPDATE families SET property = '1' where family_id = :family_id ";
        $insert_query = $this->connect->prepare($insert);
        $update_query = $this->connect->prepare($update);
        $insert_query->execute([
            'prop_type' => $this->prop_type,
            'prop_amount' => $this->prop_amount,
            'earnings' => $this->prop_earnings,
            'family_id' => $this->family_id
        ]);
        $update_query->execute(['family_id' => $this->family_id]);
    }


    public function getFamilyByPropAmount()
    {
        $select = "SELECT * FROM families 
        join properties on properties.family_id = families.family_id
        join locations on families.location_id = locations.id
        where prop_amount >=:property";
        $query = $this->connect->prepare($select);
        $query->execute(['property' => $this->prop_amount]);
        $results = array();
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $results[] = $row;
        }
        return $results;
    }
}