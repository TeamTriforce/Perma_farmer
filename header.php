<?php
session_start()
?>

<nav class="navbar navbar-expand-lg">
    <div class="nav-part-1">
        <a href="index.php">
            <img src="logo.png" class="nav-logo">
        </a>
    </div>
    <div class="nav-part-2">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="color:white;">
            <span class="navbar-toggler-icon">MENU</span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="nos-produits.php">Nos produits</a>
                <a class="nav-item nav-link" href="contact.php">Contact</a>
                <?php
                    if (isset($_SESSION["id"]) && isset($_SESSION["token"])) {
                        echo '<a class="nav-item nav-link" href=\"logout.php\">Logout</a>';
                    } else {
                        echo '<a class="nav-item nav-link" href=\"login.php\">Login</a>';
                    }
                ?>
                <a href="panier.php">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            <img src="assets/panier.png" class="img-panier">
                        </div>
                        <div class="panier-text">
                            <p>Panier</p>
                            <small>
                                <?php
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
        </div>

    </div>
</nav>
