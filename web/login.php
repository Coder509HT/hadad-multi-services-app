<?php

session_start();

if (isset($_SESSION["response"])) {
    $response = $_SESSION["response"];

    $data = $response->formData;
    $error = $response->errorMessage;
}

$title = "Connexion";
$styles = "login.css";
?>

<?php include_once("../web/includes/header.php") ?>

<section class="form-section">

    <?php
    if (isset($error)) {
    ?>
        <p class="error"><?= $error; ?> </p>
    <?php
    }
    ?>

    <form action="../src/server/login.php" method="post" class="form">
        <h1 class="form-title"><?= $title ?></h1>
        <div class="input-div">
            <input type="email" name="email" id="email" placeholder="Email" value="<?= isset($data) ? $data->email : "" ?>">
        </div>
        <div class="input-div">
            <input type="password" name="password" id="password" placeholder="Mot De Passe" value="<?= isset($data) ? $data->password : "" ?>">
        </div>
        <div class="input-div">
            <select name="role" id="role">
                <option <?= (isset($data->role) && ($data->role === "mode")) ? "selected" : "" ?> value="mode">Mode De Connexion</option>
                <option <?= (isset($data->role) && ($data->role === "admin")) ? "selected" : "" ?> value="admin">Administrateur</option>
                <option <?= (isset($data->role) && ($data->role === "user")) ? "selected" : "" ?> value="user">Utilisatteur</option>
            </select>
        </div>
        <div class="button-div">
            <button type="submit" class="form-btn">Connexion</button>
            <button type="reset" class="form-btn reset">Effacer</button>
        </div>
    </form>
</section>

<?php
if (isset($_SESSION["reponse"])) {
    unset($_SESSION["response"]);
}

session_destroy();
?>

<?php include_once("../web/includes/footer.php") ?>