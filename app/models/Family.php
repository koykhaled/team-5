<?php

use app\Mo\Model;

require_once __DIR__  . '/Model.php';
class Family extends Model
{
    protected $id,
        $fname,
        $mname,
        $lname,  
        $phone,
        $location_id,
        $individuals_number; 

    public function setFname($fname)
    {
        $this->fname = $fname;
    }
    public function setMname($mname)
    {
        $this->mname = $mname;
    }
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setLocid($location_id)
    {
        $this->location_id = $location_id;
    }
    public function setPersonNumber($number)
    {
        $this->individuals_number = $number;
    }

    public function getFname()
    {
        return $this->fname;
    }
    public function getMname()
    {
        return $this->mname;
    }
    public function getLname()
    {
        return $this->lname;
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function getPersonNumber()
    {
        return $this->individuals_number;
    }
    public function getLocId()
    {
        return $this->location_id;
    }

    public function getAllFamilies()
    {
    }

    public function getFamilyByLcoation($location_id)
    {
    }

    public function create_family()
    {
        $insert = "INSERT INTO users (fname,mname,lname,phone,PersonNumber) VALUES (
            '$this->fname',
            '$this->mname',
            '$this->lname',
            '$this->phone',
            '$this->individuals_number',
             ) ";
            $query=$this->connect->prepare($insert);
            $query->execute();
           
    }

    public function edit_family($family_id)
    {
    }

    public function delete_family($family_id)
    {
    }
}