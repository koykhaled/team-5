<?php

namespace app\Co;

use app\Co\BaseController as Base;
use app\Mo\Property;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Property.php';

class PropertyController extends Base
{
    protected $propertyModel;

    public function __construct()
    {
        $this->propertyModel = new Property();
    }

    public function create($family_id)
    {
        $property_type = ['type1', 'type2', 'type3'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_POST['prop_type']) || empty($_POST['prop_amount']) || empty($_POST['prop_earnings'])) {
                $_SESSION['error'] = "please fill out all inputs";
                $this->render('../../views/property/create_property.php', compact('property_type'));
            } else {

                if ($_POST['prop_amount'] >= 1000) {
                    $prop_amount = $_POST['prop_amount'];
                } else {
                    $_SESSION['error'] = "your amount should be 1000k or above";
                    $this->render('../../views/property/create_property.php', compact('property_type'));
                }
                if ($_POST['prop_earnings'] > 1000000) {
                    $prop_earnings = $_POST['prop_earnings'];
                } else {
                    $_SESSION['error'] = "your earnings should be in million or above to register your property";
                    $this->render('../../views/property/create_property.php', compact('property_type'));
                }
                if (isset($prop_amount) and isset($prop_earnings) and isset($property_type)) {
                    $this->propertyModel->setPropType($_POST['prop_type']);
                    $this->propertyModel->setPropAmount($_POST['prop_amount']);
                    $this->propertyModel->setPropEarnings($_POST['prop_earnings']);
                    $this->propertyModel->setFamilyId($family_id);
                    $this->propertyModel->create_property();
                    $this->redirect();
                }
            }
        } else {
            $this->render('../../views/property/create_property.php', compact('property_type'));
        }
    }


    public function showFamilyPropByAmount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->propertyModel->setPropAmount($_POST['amount']);
            $families_property_by_amount = $this->propertyModel->getFamilyByPropAmount();
            $this->render('../../views/property/show_family_prop_amount.php', compact('families_property_by_amount'));
        } else {
            $this->render('../../views/property/show_family_prop_amount.php');
        }
    }
}