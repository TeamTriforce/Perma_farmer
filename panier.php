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
        if ($_SESSION["cart"] == null || $_SESSION["cart"]->getProducts() == null || count($_SESSION["cart"]->getProducts()) == 0) {
            echo '<strong>Il n\'y a aucun produit dans le pannier.</strong>';
        } else {
            foreach ($_SESSION["cart"]->getProducts() as $product) {
                echo ProductFormatter::formatCart($product);
            }

            echo '<form method="POST" action="formManagement.php"><input type="hidden" name="checkout" value="1">
                    <input type="submit" value="Commander"></form>';
        }
        ?>
        </div>
    </div>
</body>

</html>
