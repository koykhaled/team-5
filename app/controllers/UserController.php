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
            $data = array();
            if (empty($_POST['user_name']) || empty($_POST['user_email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
                $_SESSION['error'] = 'please fill out all inputs';
                $this->render("../../views/user/create_user.php");
            } else {
                if (!preg_match("/^[a-zA-Z0-9 ]*$/", $_POST['user_name'])) {
                    $_SESSION['error'] = 'Unvalid Name';
                    $this->render("../../views/user/create_user.php");
                } else {
                    $user_name = $this->test_data($_POST['user_name']);
                }

                if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
                    $user_email = $this->test_data($_POST['user_email']);
                } else {
                    $_SESSION['error'] = ucfirst("unvalid email");
                    $this->render('../../views/user/create_user.php');
                }

                $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                $lowercase = preg_match('@[a-z]@', $_POST['password']);
                $number    = preg_match('@[0-9]@', $_POST['password']);
                $specialChars = preg_match('@[^\w]@', $_POST['password']);


                if (($uppercase || $lowercase || $number || $specialChars) and strlen($_POST['password']) >= 8) {
                    if ($_POST['password'] == $_POST['confirm_password']) {
                        $password = $this->test_data($_POST['password']);
                    } else {
                        $_SESSION['error'] = ucfirst("password dosen't match");
                        $this->render('../../views/user/create_user.php');
                    }
                } else {
                    $_SESSION['error'] = "your password must contain at least one small char or capital char or sympol or number and 8 charecter at least<br>";
                    $this->render('../../views/user/create_user.php');
                }


                if (isset($user_name) and isset($user_email) and isset($password)) {

                    $user = $this->userModel->getUserByemail($user_email);
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
                }
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
                    $this->redirect();
                } else {
                    $_SESSION['error'] = "incorrect user or password";
                    $this->render('../../views/user/login.php');
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