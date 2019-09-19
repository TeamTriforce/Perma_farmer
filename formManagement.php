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
    $product = $productDao->read($_POST["addProductId"]);

    if (!in_array($product, $_SESSION["cart"]->getProducts())) {
        $_SESSION["cart"]->addProduct($product);
    }

    header('Location: nos-produits.php');

    exit();
}

if (isset($_POST["deleteProductId"])) {
    $productDao = new ProductDao();
    $product = $productDao->read($_POST["deleteProductId"]);

    $_SESSION["cart"]->removeProduct($product);

    header('Location: panier.php');

    exit();
}