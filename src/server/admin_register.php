<?php

session_start();

require_once("../../vendor/autoload.php");

use App\users\UserView;
use App\users\UserController;

$userView = new UserView();
$userController = new UserController();

if (!isset($_POST)) {
    header("location: ../../web/admin_register.php");
} else {

    $administrateur = (object)[
        "lastName" => htmlentities($_POST["lastName"]),
        "firstName" => htmlentities($_POST["firstName"]),
        "email" => htmlentities($_POST["email"]),
        "phone" => htmlentities($_POST["phone"]),
        "adress" => htmlentities($_POST["adress"]),
        "gender" => htmlentities($_POST["gender"]),
        "password" => htmlentities($_POST["password"]),
        "passwordConfirm" => htmlentities($_POST["passwordConfirm"]),
        "admin" => true,
        "date" => date("y-m-d h:i:s")
    ];

    if (!isset($administrateur->lastName) || empty($administrateur->lastName)) {
        $success = false;
        $message = "Entrez votre nom de famille s'il vous plaît.";
    } else if (!isset($administrateur->firstName) || empty($administrateur->firstName)) {
        $success = false;
        $message = "Entrez votre prénom s'il vous plaît.";
    } else if (!isset($administrateur->email) || empty($administrateur->email)) {
        $success = false;
        $message = "Entrez votre email s'il vous plaît.";
    } else if (!(filter_var($administrateur->email, FILTER_VALIDATE_EMAIL))) {
        $success = false;
        $message = "Entrez un email valide s'il vous plaît.";
    } else if ($userView->isEmailsExist($administrateur->email)) {
        $success = false;
        $message = "Cet email est déjà pris";
    } else if (!isset($administrateur->phone) || empty($administrateur->phone)) {
        $success = false;
        $message = "Entrez votre numéro de téléphone s'il vous plaît.";
    } else if ($userView->isPhonesExist($administrateur->phone)) {
        $success = false;
        $message = "Cet numéro de téléphone est déjà pris";
    } else if (!isset($administrateur->adress) || empty($administrateur->adress)) {
        $success = false;
        $message = "Entrez votre adresse s'il vous plaît.";
    } else if (!isset($administrateur->password) || empty($administrateur->password)) {
        $success = false;
        $message = "Entrez votre mot de passe s'il vous plaît.";
    } else if (strlen($administrateur->password) < 5) {
        $success = false;
        $message = "Votre mot de passe doit comporter au minimum 5 caractères.";
    } else if (strlen($administrateur->password) > 12) {
        $success = false;
        $message = "Votre mot de passe doit contenir au maximum 12 caractères..";
    } else if (!isset($administrateur->passwordConfirm) || empty($administrateur->passwordConfirm)) {
        $success = false;
        $message = "Confirmez le mot de passe s'il vous plaît.";
    } else if ($administrateur->password !== $administrateur->passwordConfirm) {
        $success = false;
        $message = "Vos mots de passe ne correspondent pas.";
    } else {
        $success = true;
    }

    if (!$success) {
        $_SESSION["response"] = (object)[
            "formData" => $administrateur,
            "errorMessage" => $message
        ];
        header("location: ../../web/admin_register.php");
    } else {
        $userController->addUserAsAdmin($administrateur);
        header("location: ../../web/login.php");
    }
}
exit();
