<?php

session_start();

require_once("../../vendor/autoload.php");

use App\users\UserController;

$userController = new UserController();

if (isset($_POST["logout"])) {
    $user = (object)$_SESSION["user"];
    $userController->deconnectUser($user->email, $user->password);
    unset($_SESSION["user"]);
    session_destroy();
    header("location: ../../web/login.php");
}
exit();
