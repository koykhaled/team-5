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
        $results = $this->getAll('families');
        $families = array();
        foreach ($results as $result) {
            $family = new Family();
            $family->setId($result->id);
            $family->setFname($result->fname);
            $family->setMname($result->mname);
            $family->setFname($result->lname);
            $family->setPhone($result->phone);
            $family->setPersonNumber($result->individuals_number);
            $families[] = $family;
        }
    }

    public function getFamilyById($family_id)
    {
        $select = "SELECT * FROM families join locations on families.location_id = locations.id where id = :family_id";
        $query = $this->connect->prepare($select);
        $query->execute(['family_id' => $family_id]);
        $family = $query->fetch(PDO::FETCH_OBJ);
        return $family;
    }

    public function getFamilyByLcoation($location_id)
    {
        $select = "SELECT * FROM families join locations on families.location_id = locations.id where location_id = :location_id";
        $query = $this->connect->prepare($select);
        $query->execute(['location_id' => $location_id]);

        $families = array();
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $family = new Family();
            $family->setId($row->id);
            $family->setFname($row->fname);
            $family->setMname($row->mname);
            $family->setFname($row->lname);
            $family->setPhone($row->phone);
            $family->setPersonNumber($row->individuals_number);

            $families[] = $row;
        }
        return $families;
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
                $family = $this->getFamilyById($family_id);
                $delete = "DELETE FROM families WHERE id = '$this->family_id' ";
                $query=$this->connect->prepare($delete);
                $query->execute();
                
    }
}