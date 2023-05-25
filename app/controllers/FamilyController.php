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
        $this->familyModel->getAllFamilies();
    }

    public function edit($id)
    {
        $family = $this->familyModel->getFamilyById($id);
        $family->setPhone($family->phone);
        $family->setPersonNumber($family->individuals_number);
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $family->setPhone($_POST['phone']);
            $family->setPersonNumber($_POST['individuals_number']);
            $this->familyModel->edit_family($id);
            header('Location: /');
        }
        else
        {
            $this->render('family/edit', compact('family'));
        }

    } 
}
