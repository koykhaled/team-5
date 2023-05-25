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
    }

    public function edit_family($family_id)
    {
        $edit = $this->connect->prepare("UPDATE families SET fname =: fname ,mname =: mname ,lname =: lname, phone =: phone, individuals_number =: individuals_number WHERE id =:family_id");
        $edit->execute(array(
            ':fname' => $this->fname,
            ':mname' => $this->mname,
            ':lname' => $this->lname,
            ':phone' => $this->phone,
            ':individuals_number' => $this->individuals_number,
            ':id' => $family_id
        ));
    }

    public function delete_family($family_id)
    {
    }
}