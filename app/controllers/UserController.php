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



    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->getUserByemail($_POST["user_email"]);
            if ($user) {
                $_SESSION['error'] = "user already exist";
                $this->render('../../views/user/create_user.php');
            } else {
                $this->userModel->setUserName($_POST['user_name']);
                $this->userModel->setUserEmail($_POST['user_email']);
                $this->userModel->setUserPassword($_POST['password']);
                $this->userModel->create_user();
                $this->redirect("login");
                exit;
            }
        } else {
            $this->render('../../views/user/create_user.php');
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

                    session_start();
                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['user_name'] = $user->user_name;
                    $_SESSION['user_email'] = $user->user_email;
                    $_SESSION['user_password'] = $user->user_password;
                    $_SESSION['user_type'] = $user->user_type;
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['user_email'] = $user['user_email'];
                    $_SESSION['user_password'] = $user['user_password'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $this->redirect();
                }
            }
        } else {
            $this->render('../../views/user/login.php');
        }
    }


    public function logout()
    {
        session_destroy();
        $this->redirect("login");
    }


}