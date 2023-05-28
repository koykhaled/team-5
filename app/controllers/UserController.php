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
