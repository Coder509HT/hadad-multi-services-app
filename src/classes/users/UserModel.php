<?php

namespace App\users;

use App\database\Database;
use DateTime;

/**
 * UserModel class
 */
class UserModel extends Database
{
    //Get Data
    protected function getUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function getAdmins()
    {
        $query = "SELECT * FROM users WHERE admin = true";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function getUsersByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(["email" => $email]);
        return $stmt->fetchAll();
    }

    protected function getUsersByPhone($phone)
    {
        $query = "SELECT * FROM users WHERE phone = :phone";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(["phone" => $phone]);
        return $stmt->fetchAll();
    }

    protected function getUsersByEmailAndPassword($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(["email" => $email, "password" => $password]);
        return $stmt->fetchAll();
    }

    protected function isThisUserIsAdmin($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email AND password = :password AND admin = true";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(["email" => $email, "password" => $password]);
        return $stmt->fetchAll();
    }

    //Update Data
    protected function addUser($user)
    {
        $query = "INSERT INTO users(lastName, firstName, email, phone, adress, gender, password, admin, date) 
                VALUES(:lastName, :firstName, :email, :phone, :adress, :gender, :password, :admin, :date)";
        $stmt = $this->getConnection()->prepare($query);

        $stmt->execute([
            "lastName" => $user->lastName,
            "firstName" => $user->firstName,
            "email" => $user->email,
            "phone" => $user->phone,
            "adress" => $user->adress,
            "gender" => $user->gender,
            "password" => $user->password,
            "admin" => $user->admin,
            "date" => $user->date
        ]);
    }

    protected function setUserLog($logInfos)
    {
        $query = "UPDATE users SET login = :login WHERE email = :email AND password = :password";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(["email" => $logInfos->email, "password" => $logInfos->password, "login" => $logInfos->login]);
    }
}
