<?php

namespace App\users;

/**
 * UserView class
 */
class UserView extends UserModel
{
    public function usersList()
    {
        return $this->getUsers();
    }

    public function isAnyAdminsExist()
    {
        return count($this->getAdmins()) > 0;
    }

    public function isEmailsExist($email)
    {
        return count($this->getUsersByEmail($email)) > 0;
    }

    public function isPhonesExist($phone)
    {
        return count($this->getUsersByPhone($phone)) > 0;
    }

    public function isUserExist($email, $password)
    {
        return count($this->getUsersByEmailAndPassword($email, $password)) > 0;
    }

    public function userIsAdmin($email, $password)
    {
        return count($this->isThisUserIsAdmin($email, $password)) > 0;
    }

    public function getUserByEmail($email)
    {
        return $this->getUsersByEmail($email)[0];
    }
}
