<?php

namespace app\Controllers;

use app\Controllers\BaseController as Base;
use Family;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Family.php';

class FamilyController extends Base
{
    private $familyModel; 
    public function __construct()
    {
        $this->familyModel = new Family();
    }

    public function index()
    {

        $this->connect->getAllFamilies();
    }  
    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $family = new Family();
            $family->setfname($_POST['fname']);
            $family->setmname($_POST['mname']);
            $family->setlname($_POST['lname']);
            $family->setphone($_POST['phone']);
            $family->setPersonNumber($_POST['PersonNumber']);
            $this->familyModel->create_family();

           
            header("location:team-5");
            exit;
        } else {
            require 'views/Family/create.php';
        }
    } 
    


}

        $families = $this->familyModel->getAllFamilies();
    }
}
 
