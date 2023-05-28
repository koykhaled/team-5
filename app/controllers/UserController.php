<?php

namespace app\Co;

require_once __DIR__ . '/../models/User.php';

use app\Co\BaseController as Base;
use app\Mo\User;

class UserController extends Base
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function create_user()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->getUserByemail($_POST["user_email"]);
            if (isset($user)) {
                $_SESSION['error'] = "user already exist";
                $this->render('../../views/user/register.php');
            }
            $user = new User();
            $user->setUserName($_POST['user_name']);
            $user->setUserEmail($_POST['user_email']);
            $user->setUserPassword($_POST['user_password']);
            $user->setUserType($_POST['user_type']);


            $this->redirect("login");
            exit;
        } else {
            $this->render('../../views/user/register.php');
        }
    }



    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_POST['user_email']) or empty($_POST['user_password'])) {
                $_SESSION['error'] = "please fill all fields";
                $this->render('../../views/user/login.php');
            } else {
                $user = $this->userModel->userLogin($_POST['user_email'], $_POST['user_password']);
                if ($user) {

                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['user_name'] = $user->user_name;
                    $_SESSION['user_email'] = $user->user_email;
                    $_SESSION['user_password'] = $user->user_password;
                    $_SESSION['user_type'] = $user->user_type;
                    $this->redirect();
                }
            }
        } else {
            $this->render('../../views/user/login.php');
        }
    }
}