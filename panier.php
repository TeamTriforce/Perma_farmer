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
            echo '<div style=\'margin: auto; text-align: center\'><strong class="pl-4">Il n\'y a aucun produit dans le panier.</strong></div>';
        } else {
            foreach ($_SESSION["cart"]->getProducts() as $product) {
                echo ProductFormatter::formatCart($product);
            }

        }
        ?>
        </div>
    </div>
    <div class="d-flex justify-content-center form-anim">
        <form method="POST" action="formManagement.php" class="form-commande">
        <input type="hidden" name="checkout" value="1">
        <input type="submit" value="Commander">
        </form>
    </div>
</body>

</html>
