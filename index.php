<?php
require_once("./vendor/autoload.php");

use App\users\UserView;

$userView = new UserView();

if (!$userView->isAnyAdminsExist()) {
    header("location: ./web/admin_register.php");
} else {
    header("location: ./web/login.php");
}
exit();
