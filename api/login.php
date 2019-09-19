<?php

include "common_config.php";
require_once dirname(__FILE__) . "/../php/Autoloader.php";

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $adminDao = new AdminDao();
    $idData = $adminDao->login($_POST["login"], $_POST["password"]);

    if ($idData != null) {
        $_SESSION["id"] = $idData[AdminSchema::ID];
        $_SESSION["token"] = $idData[AdminSchema::TOKEN];
        $responseCode = 200;

        echo "Success";
    } else {
        $responseCode = 403;

        echo "The login information doesn't match.";
    }

} else {
    $responseCode = 400;

    echo "The login and password parameters should be filled.";
}
