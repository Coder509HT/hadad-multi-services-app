<?php

namespace App\users;

/**
 * UserController class
 */
class UserController extends UserModel
{
    public function addUserAsAdmin($user)
    {
        $this->addUser($user);
    }

    public function connectUser($email, $password)
    {
        $logInfos = (object)["email" => $email, "password" => $password, "login" => true];
        $this->setUserLog($logInfos);
    }

    public function deconnectUser($email, $password)
    {
        $logInfos = (object)["email" => $email, "password" => $password, "login" => false];
        $this->setUserLog($logInfos);
    }
}
