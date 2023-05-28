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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->propertyModel->setPropType($_POST['prop_type']);
            $this->propertyModel->setPropAmount($_POST['prop_amount']);
            $this->propertyModel->setPropEarnings($_POST['prop_earnings']);
            $this->propertyModel->setFamilyId($family_id);
            $this->propertyModel->create_property();
            $this->redirect();
        } else {
            $this->render('../../views/property/create_property.php');
        }
    }
}