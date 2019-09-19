<?php
session_start()
?>

<nav>
        <div class="nav-part-1">
            <a href="index.php">
                <img src="logo.png" class="nav-logo">
            </a>
        </div>
        <div class="nav-part-2">
            <a href="index.php">Accueil</a>
            <a href="nos-produits.php">Nos produits</a>
            <a href="contact.php">Contact</a>
            <a href="panier.php">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="assets/panier.png" class="img-panier">
                    </div>
                    <div class="panier-text">
                        <p>Panier</p>
                        <small><?php
                            if ($_SESSION["cart"] != null && $_SESSION["cart"]->getProducts() != null) {
                                echo count($_SESSION["cart"]->getProducts());
                            } else {
                                echo '0';
                            }
                            ?> articles</small>
                    </div>
                </div>
            </a>
        </div>
    </nav>