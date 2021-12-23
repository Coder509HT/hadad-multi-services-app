<?php
session_start();

if (!(isset($_SESSION["user"]))) {
    header("location: ./login.php");
    exit();
}

$title = "User Dashboard";
$styles = "user.css";
?>

<?php include_once("../web/includes/header.php") ?>
<h1><?= $title ?></h1>

<?php
echo "<pre>";
print_r($_SESSION);
?>

<?php include_once("../web/includes/footer.php") ?>