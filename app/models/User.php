<?php

declare(strict_types=1);

namespace app\Mo;

use PDO;

use app\Mo\Model;

require_once 'Model.php';

class User extends Model
{
    protected $user_name, $user_email, $user_passwrod, $user_type;

    public function setUserName(string $user_name)
    {
        $this->user_name = $user_name;
    }
    public function setUserEmail(string $user_email)
    {
        $this->user_email = $user_email;
    }
    public function setUserPassword(string $user_password)
    {
        $this->user_password = $user_password;
    }
    public function setUserType(string $user_type)
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
        $query->execute(['user_id' => $email]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}