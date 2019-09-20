<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 19/09/2019
 * Time: 14:29
 */

require_once dirname(__FILE__) . "/php/Autoloader.php";

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '1G');
error_reporting(E_ALL);
if (isset($_POST["addProductId"])) {
    $productDao = new ProductDao();

    var_dump(($_POST["addProductId"]));
    var_dump((int)($_POST["addProductId"]));
    $product = $productDao->read((int)($_POST["addProductId"]));

    if ($product == null) {
        header('Location: error.php?errorCode=404');
    }

    if (!in_array($product, $_SESSION["cart"]->getProducts())) {
        $_SESSION["cart"]->addProduct($product);
    }

    header('Location: nos-produits.php');

    exit();
}

if (isset($_POST["deleteProductId"])) {
    $productDao = new ProductDao();
    $product = $productDao->read((int)($_POST["deleteProductId"]));

    if ($product == null) {
        header('Location: error.php?errorCode=404');
    }

    $_SESSION["cart"]->removeProduct($product);

    header('Location: panier.php');

    exit();
}

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $customerDao = new CustomerDao();
    $adminDao = new AdminDao();
    $adminId = $adminDao->login($_POST["login"], $_POST["password"]);
    $customerId = $customerDao->login($_POST["login"], $_POST["password"]);

    if ($adminId != null) {
        $_SESSION["id"] = $adminId[AdminSchema::ID];
        $_SESSION["token"] = $adminId[AdminSchema::TOKEN];
    } else if ($customerId) {
        $_SESSION["id"] = $customerId[CustomerSchema::ID];
        $_SESSION["token"] = $customerId[CustomerSchema::TOKEN];
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}
