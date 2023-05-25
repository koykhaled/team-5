<?php

namespace app\Controllers;

use app\Controllers\BaseController as Base;
use app\Mo\Location;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Location.php';

class LocationController extends Base
{
    private $locationModel;
    public function __construct()
    {
        $this->locationModel = new Location();
    }
}