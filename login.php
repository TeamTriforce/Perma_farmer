<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");
?>

<body>
<?php
include("header.php");
?>

            <div style="padding-top: 80px;">
            <h2 class="text-center pt-3 pb-4 title-h2" style="padding-bottom: 0 !important;">Connexion</h2>
            <p class="text-center title-h2">Vous devez vous connecter pour pouvoir commander</p>
        </div>
    <div class="d-flex justify-content-center pt-4">
        <form method="POST" action="formManagement.php" class="d-flex flex-column align-items-center form-login form-anim">
            <input type="text" name="authLogin" placeholder="Identifiant/Email"><br>
            <input type="password" name="authPassword" placeholder="Mot de passe"><br>
            <input type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>
