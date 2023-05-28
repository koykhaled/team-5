<?php

declare(strict_types=1);

namespace app\Mo;

use PDO;

use app\Mo\Model;

require_once 'Model.php';

class User extends Model
{
    protected string $user_name;
    protected string $user_email;
    protected string $user_passwrod;
    protected string $user_type;

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }
    public function setUserType($user_type)
    {
        $this->user_type = $user_type;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }
    public function getUserEmail(): string
    {
        return $this->user_email;
    }
    public function getUserPassword(): string
    {
        return $this->user_password;
    }
    public function getUserType(): string
    {
        return $this->user_type;
    }

    public function getUserById($id)
    {
        $select = "SELECT * FROM users where user_id = :user_id";
        $query = $this->connect->prepare($select);
        $query->execute(['user_id' => $id]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function getUserByEmail($email)
    {
        $select = "SELECT * FROM users where user_email = :user_email";
        $query = $this->connect->prepare($select);
        $query->execute(['user_email' => $email]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function create_user()
    {
        $insert = "INSERT INTO users (user_name,password,user_email,user_type) VALUES (
            :user_name,
            :user_password,
            :user_email,
            :user_type
            ) ";
        $query = $this->connect->prepare($insert);
        $query->execute([
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_password' => $this->user_password,
            'user_type' => 'employee'

        ]);
    }

    public function userLogin($user_email, $user_password)
    {
        $select = "SELECT * FROM users WHERE user_email=:user_email AND password=:user_password";
        $query = $this->connect->prepare($select);
        $query->execute(['user_email' => $user_email, 'user_password' => $user_password]);
        $row = $query->fetch(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}