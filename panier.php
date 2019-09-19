<!DOCTYPE html>
<html lang="en">

<?php
        include("head.php");
    ?>

<body>
    <?php
        include("header.php");
    ?>
    <div class="container-fluid div-produits" style="padding-top: 80px;">
        <div>
            <h2 class="text-center pt-3 pb-4">Mon panier</h2>
        </div>
        <div class="row">
            <?php
                $cart = $_SESSION["cart"];

                if ($cart == null || $cart->getProducts() == null || count($cart->getProducts()) == 0) {
                    echo '<strong>Il n\'y a aucun produit dans le pannier.</strong>';
                } else {
                    $_SESSION["cart"] = new Order([]);

                    foreach ($cart->getProducts() as $product) {
                        ProductFormatter::formatCart($product);
                    }
                }
            ?>
        </div>
    </div>
</body>

</html>
