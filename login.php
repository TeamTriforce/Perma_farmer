<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");
?>

<body>
<?php
include("header.php");
?>
<div style="padding-top: 80px">
    <fieldset>
        <form method="POST" action="formManagement.php">
            <input type="text" name="login" placeholder="Identifiant/Email">
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="submit" value="Connection">
        </form>
    </fieldset>
</div>
</body>
</html>
