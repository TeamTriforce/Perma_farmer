<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 19/09/2019
 * Time: 15:45
 */

if (!isset($_GET["errorCode"])) {
    header('Location: index.php');

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php
include("head.php");
?>

    <h1>Une erreur est survenue.</h1>
    <p>
        <?php
    switch ($_GET["errorCode"]) {
        case 401:
            $msg = "Utilisateur non authentifié";

            break;
        case 403:
            $msg = "Acces refusé";

            break;
        case 404:
            $msg = "Resource non trouvée";

            break;
    }

    echo $msg;
    ?>
    </p>
</body>

</html>
