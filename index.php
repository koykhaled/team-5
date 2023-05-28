<?php

require_once __DIR__ . '/app/controllers/FamilyController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/PropertyController.php';

use app\Co\FamilyController;
use app\Co\UserController as US;
use app\Co\PropertyController;




define('BASE_PATH', '/PHPCOURSE/Darrebeni/team-5/');

$route = $_SERVER['REQUEST_URI'];

switch ($route) {
    case BASE_PATH:
        $family = new FamilyController();
        $family->index();
        break;

    case BASE_PATH . "create":
        $family = new FamilyController();
        $family->create();
        break;
    case BASE_PATH . "login":
        $user = new US();
        $user->login();
        break;

    case BASE_PATH . "logout":
        $user = new US();
        $user->logout();
        break;

    case BASE_PATH . "create-user":
        $user = new US();
        $user->create();
        break;

    case BASE_PATH . "create-property/" . substr($route, strlen(BASE_PATH . "create-property/")):
        $id = substr($route, strlen(BASE_PATH . 'create-property/'));
        $property = new PropertyController();
        $property->create($id);

    case BASE_PATH . "create":
        $user = new US();
        // $user->create_user();

        break;

    case BASE_PATH . "delete/" . substr($route, strlen(BASE_PATH . "delete/")):
        $family = new FamilyController();
        $id = substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'delete/'));
        $family->delete($id);
        break;

    case BASE_PATH . "edit/" . substr($route, strlen(BASE_PATH . "edit/")):
        $family = new FamilyController();
        $id = substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'edit/'));
        $family->edit($id);
        break;
    default:
        $family = new FamilyController();
        $family->index();
}