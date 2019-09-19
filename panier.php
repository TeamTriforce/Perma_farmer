<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");

session_start();
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
        }
        ?>
    </div>
</div>
</body>

</html>
