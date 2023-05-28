<?php

namespace app\Co;

session_start();

use app\Co\BaseController as Base;
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


        if (isset($_SESSION['user_id'])) {

            $families = $this->familyModel->getAllFamilies();
            $locations = $this->locationModel->getAllLocation();
            if (isset($_GET['location'])) {
                $family_with_location = $this->familyModel->getFamilyByLcoation($_GET['location']);


          
                $this->render("../../views/family/index.php", compact(['locations', 'family_with_location']));
            } else {
                $this->render("../../views/family/index.php", compact(['families', 'locations']));
            }
        } else {
            $this->redirect("login");
        }
    }
    public function create()
    {
        $locations = $this->locationModel->getAllLocation();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if (empty($_POST['fname']) || empty($_POST['mname']) || empty($_POST['lname']) || empty($_POST['phone']) || empty($_POST['individuals_number']) || empty($_POST['status']) || empty($_POST['location'])) {
                $_SESSION['error'] = 'please fill out all inputs';
                $this->render("../../views/family/create.php", compact("locations"));
            } else {
                if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST['fname']) or !preg_match("/^[a-zA-Z0-9]*$/", $_POST['mname']) or !preg_match("/^[a-zA-Z0-9]*$/", $_POST['lname'])) {
                    $_SESSION['error'] = 'Unvalid Name';
                    $this->render("../../views/family/create.php", compact("locations"));
                } else {
                    $fname = $this->test_data($_POST['fname']);
                    $mname = $this->test_data($_POST['mname']);
                    $lname = $this->test_data($_POST['lname']);
                }


                if (isset($_POST['status']) and $_POST['status']  == "employee") {
                    $status = 1;
                } else {
                    $status = 0;
                }

                if (!preg_match('/^[0-9]{10,}$/', $_POST['phone'])) {
                    $_SESSION['error'] = 'Unvalid phone';
                    $this->render("../../views/family/create.php", compact("locations"));
                } else {
                    $individuals_number = $this->test_data($_POST['individuals_number']);
                }


                if (!preg_match('/^[2-9]+$/', $_POST['individuals_number'])) {
                    $_SESSION['error'] = 'Unvalid Number';
                    $this->render("../../views/family/create.php", compact("locations"));
                } else {
                    $phone = $this->test_data($_POST['phone']);
                }


                if (isset($fname) and isset($mname) and isset($individuals_number) and isset($lname) and isset($phone) and isset($_POST['location'])) {
                    $this->familyModel->setFname($fname);
                    $this->familyModel->setMname($mname);
                    $this->familyModel->setLname($lname);
                    $this->familyModel->setPhone($phone);
                    $this->familyModel->setPersonNumber($individuals_number);
                    $this->familyModel->setStatus($status);
                    $this->familyModel->setLocid($_POST['location']);
                    $this->familyModel->create_family();
                    $this->redirect();
                    exit;
                } else {
                    $_SESSION['error'] = 'error with create family';
                }
            }
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