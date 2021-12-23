<?php
session_start();

if (isset($_SESSION["response"])) {
    $response = $_SESSION["response"];

    $data = $response->formData;
    $error = $response->errorMessage;
}

$title = "S'enregistrer En Tant Qu'administrateur";
$styles = "admin.css";
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

    <form action="../src/server/admin_register.php" method="post" class="form">
        <h1 class="form-title"><?= $title ?></h1>
        <div class="input-div">
            <input type="text" name="lastName" placeholder="Nom" value="<?= isset($data) ? $data->lastName : "" ?>">
        </div>
        <div class="input-div">
            <input type="text" name="firstName" placeholder="Prenom" value="<?= isset($data) ? $data->firstName : "" ?>">
        </div>
        <div class="input-div">
            <input type="email" name="email" placeholder="Email" value="<?= isset($data) ? $data->email : "" ?>">
        </div>
        <div class="input-div">
            <input type="tel" name="phone" placeholder="Phone" value="<?= isset($data) ? $data->phone : "" ?>">
        </div>
        <div class="input-div">
            <input type="text" name="adress" placeholder="Adresse" value="<?= isset($data) ? $data->adress : "" ?>">
        </div>
        <div class="input-div radio">
            <div class="sex-input">
                <label for="male">Masculin</label>
                <input type="radio" name="gender" value="M" checked>
            </div>
            <div class="sex-input">
                <label for="female">Feminin</label>
                <input type="radio" name="gender" value="F" <?= (isset($data) && $data->gender === "F") ? "checked" : "" ?>>
            </div>
        </div>
        <div class="input-div">
            <input type="password" name="password" placeholder="Mot De Passe" value="<?= isset($data) ? $data->password : "" ?>">
        </div>
        <div class="input-div">
            <input type="password" name="passwordConfirm" placeholder="Mot De Passe A Nouveau" value="<?= isset($data) ? $data->passwordConfirm : "" ?>">
        </div>
        <div class="button-div">
            <button type="submit" class="form-btn">S'enregistrer</button>
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