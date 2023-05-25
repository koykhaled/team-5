<?php

namespace app\Controllers;

use app\Controllers\BaseController as Base;
use app\Mo\Location;
use Family;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Family.php';
require_once __DIR__ . '/../models/Location.php';

class FamilyController extends Base
{
    private $familyModel;
    private $locationModel;
    public function __construct()
    {
        $this->familyModel = new Family();
        $this->locationModel = new Location();
    }

    public function index()
    {
        $families = $this->familyModel->getAllFamilies();
        $locations = $this->locationModel->getAllLocation();
        if (isset($_GET['location'])) {
            $family_with_location = $this->familyModel->getFamilyByLcoation($_GET['location']);

            $this->render("../../views/family/index.php", compact(['locations', 'family_with_location']));
        } else {
            $this->render("../../views/family/index.php", compact(['families', 'locations']));
        }
    }
    public function create()
    {
        $locations = $this->locationModel->getAllLocation();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->familyModel->setFname($_POST['fname']);
            $this->familyModel->setMname($_POST['mname']);
            $this->familyModel->setLname($_POST['lname']);
            $this->familyModel->setPhone($_POST['phone']);
            $this->familyModel->setPersonNumber($_POST['individuals_number']);
            $this->familyModel->setStatus(1);
            $this->familyModel->setLocid($_POST['location']);
            $this->familyModel->create_family();

            $this->redirect();
            exit;
        } else {
            $this->render("../../views/family/create.php", compact("locations"));
        }
    }

    public function delete($id)
    {
        $family = $this->familyModel->getFamilyById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $this->familyModel->delete_family($id);
                $this->redirect();
                exit;
            } else {
                $this->redirect();
            }
        } else {
            $this->render('../../views/family/delete.php', compact('family'));
        }
    }

    public function edit($id)
    {
        $family = $this->familyModel->getFamilyById($id);
        $this->familyModel->setPhone($family->phone);
        $this->familyModel->setPersonNumber($family->individuals_number);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->familyModel->setPhone($_POST['phone']);
            $this->familyModel->setPersonNumber($_POST['individuals_number']);
            $this->familyModel->edit_family($id);
            $this->redirect();
        } else {
            $this->render('../../views/family/edit.php', compact('family'));
        }
    }
}