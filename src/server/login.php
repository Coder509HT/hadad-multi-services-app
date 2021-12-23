<?php
session_start();
require_once("../../vendor/autoload.php");

use App\users\UserView;
use App\users\UserController;

$userView = new UserView();
$userController = new UserController();

if (!isset($_POST)) {
    header("location: ../../web/login.php");
} else {

    $user = (object)[
        "email" => htmlentities($_POST["email"]),
        "password" => htmlentities($_POST["password"]),
        "role" => $_POST["role"]
    ];

    if (!isset($user->email) || empty($user->email)) {
        $success = false;
        $message = "Entrez votre email s'il vous plaît.";
    } else if (!isset($user->password) || empty($user->password)) {
        $success = false;
        $message = "Entrez votre mot de passe s'il vous plaît.";
    } else if (!$userView->isEmailsExist($user->email)) {
        $success = false;
        $message = "L'email n'existe pas.";
    } else if (!$userView->isUserExist($user->email, $user->password)) {
        $success = false;
        $message = "Mot de passe incorrect.";
    } else if (!$userView->userIsAdmin($user->email, $user->password) && $user->role === "admin") {
        $success = false;
        $message = "Vous ne pouvez pas vous connecter en tant qu'administrateur.";
    } else if ($user->role === "mode") {
        $success = false;
        $message = "Choisissez un mode de connexion s'il vous plaît..";
    } else {
        $success = true;
    }

    if (!$success) {
        $_SESSION["response"] = (object)[
            "formData" => $user,
            "errorMessage" => $message
        ];
        header("location: ../../web/login.php");
    } else {

        $userController->connectUser($user->email, $user->password);

        $_SESSION["user"] = (object)$userView->getUserByEmail($user->email);

        if ($user->admin) {
            header("location: ../../web/admin_dashboard.php");
        } else {
            header("location: ../../web/user_dashboard.php");
        }
    }
}
exit();
