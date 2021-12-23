<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Hadad Multi-Services</title>
    <link type="text/css" rel="stylesheet" href="./css/header.css">
    <?php
    if (!empty($styles)) {
    ?>
        <link type="text/css" rel="stylesheet" href="./css/<?= $styles ?>">
    <?php
    }
    ?>
</head>

<body>

    <?php
    if (isset($_SESSION["user"])) {

        $user = $_SESSION["user"];

        $role = ($user->admin) ? "Administrateur" : "Utilisateur";
    ?>
        <header>
            <p class="logo">Hadad Multi-Services</p>
            <div class="user-section">
                <p><?= strtoupper($user->lastName) . " " . ucwords($user->firstName) . " (" . $role . ")"; ?></p>
                <form action="../src/server/logout.php" method="post">
                    <button class="form-btn" type="submit" name="logout">Log Out</button>
                </form>
            </div>
        </header>
    <?php
    }
    ?>