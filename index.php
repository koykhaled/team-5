<?php

require_once __DIR__ . '/app/controllers/FamilyController.php';
require_once __DIR__ . '/app/controllers/UserController.php';

use app\Co\FamilyController;
use app\Co\UserController as US;

define('BASE_PATH', '/PHPCOURSE/Darrebeni/team-5/');

$route = $_SERVER['REQUEST_URI'];
$family = new FamilyController();
switch ($route) {
    case BASE_PATH:
        $family->index();
        break;

    case BASE_PATH . "create":
        $family->create();
        break;
    case BASE_PATH . "login":
        $user = new US();
        $user->login();
        break;
    case BASE_PATH . "register":
        $user = new US();
        $user->create_user();
        break;

    case BASE_PATH . "delete/" . substr($route, strlen(BASE_PATH . "delete/")):
        $id = substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'delete/'));
        $family->delete($id);
        break;

    case BASE_PATH . "edit/" . substr($route, strlen(BASE_PATH . "edit/")):
        $id = substr($_SERVER['REQUEST_URI'], strlen(BASE_PATH . 'edit/'));
        $family->edit($id);
        break;
    default:
        $family->index();
}