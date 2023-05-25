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
    public function delete(){
        if($_SERVER['REQUEST_METHOD']=='POST')

            $id = $_POST['id'];
            $family = new Family();
            $family->getFamilyById($id);
            $family->delete($this->conn);
            $this->redirect('');
            exit;
    }
}
