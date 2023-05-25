<?php

require_once __DIR__ . '/app/controllers/FamilyController.php';

use app\Controllers\FamilyController;

define('BASE_PATH', '/PHPCOURSE/Darrebeni/team-5/');

$route = $_SERVER['REQUEST_URI'];

switch ($route) {
    case BASE_PATH:
        $user = new FamilyController();
        $user->index();
        break;
}