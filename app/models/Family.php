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
    }

    public function delete_family($family_id)
    {
    }
}