<?php

use app\Mo\Model;

require_once __DIR__  . '/Model.php';
class Family extends Model
{

    protected string $fname, $mname, $lname, $phone;
    protected int $location_id, $individuals_number;
    protected bool $status, $property;


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
    public function setProperty($property)
    {
        $this->property = $property;
    }

    public function setPersonNumber($number)
    {
        $this->individuals_number = $number;
    }

    public function setStatus($staus)
    {
        $this->status = $staus;
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
    public function getProperty()
    {
        return $this->property;
    }
    public function getStatus()
    {
        return $this->status;
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
        $select = "SELECT * from families join locations on families.location_id = locations.id";
        $query = $this->connect->prepare($select);
        $query->execute();
        $results = array();
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $results[] = $row;
        }
        return $results;
    }

    public function getFamilyById($family_id)
    {
        $select = "SELECT * FROM families  where family_id = :family_id";
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
            $family->setLname($row->lname);
            $family->setPhone($row->phone);
            $family->setStatus($row->status);
            $family->setLocid($row->location_id);
            $family->setPersonNumber($row->individuals_number);

            $families[] = $row;
        }
        return $families;
    }

    public function create_family()
    {
        $insert = "INSERT INTO families (fname,mname,lname,phone,individuals_number,status,location_id,property) VALUES (
            :fname,
            :mname,
            :lname,
            :phone,
            :individuals_number,
            :status,
            :location_id,
            :property
            ) ";
        $query = $this->connect->prepare($insert);
        $query->execute([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'phone' => $this->phone,
            'individuals_number' => $this->individuals_number,
            'status' => $this->status,
            'location_id' => $this->location_id,
            'property' => $this->property,
        ]);
    }

    public function edit_family($family_id)
    {
        $edit = $this->connect->prepare("UPDATE families SET phone =:phone, individuals_number =:individuals_number WHERE family_id =:family_id");
        $edit->execute(
            [
                'phone' => $this->phone,
                'individuals_number' => $this->individuals_number,
                'family_id' => $family_id
            ]
        );
    }

    public function delete_family($family_id)
    {
        $delete = "DELETE FROM families WHERE family_id = :family_id ";
        $query = $this->connect->prepare($delete);
        $query->execute(['family_id' => $family_id]);
    }
}