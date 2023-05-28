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
        $user = $this->userModel->getUserByemail($_POST["user_email"]);
        if(isset($user))
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = new User();
                $user->setusername($_POST['user_name']);
                $user->setUserEmail($_POST['user_email']);
                $user->setUserPassword($_POST['user_password']);
                $user->setUserType($_POST['user_type']); 
               
    
                header('Location: ');
                exit;
    
            }
        } 
        else 
        {
            $_SESSION["error"]="user already exist";
            exit;
        }
    }

    

    }
    public function login(){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            
            if (empty($_POST['user_email']) or empty($_POST['user_password'])) {
                $_SESSION['error'] = "please fill all fields";
                $this->render();
        }else{
            $user = $this->userModel->userLogin( $_POST['user_email'], $_POST['user_password']);
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['user_password'] = $user['user_password'];
                $_SESSION['user_type'] = $user['user_type'];
                redirect();
            }
        }
    
    }
    }    
}
