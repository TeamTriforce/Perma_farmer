<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");
?>

<body>
<?php
include("header.php");
?>

<div class="d-flex justify-content-center align-items-center banner-home">
    <div class="div-banner-logo"><img src="logo.png" class="banner-logo"></div>
</div>
    <?php
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = new Order([]);
        }
    ?>
    
    <style>nav{background-color: transparent;}</style>


<div class="container-fluid" style="margin-top: 50px;" id="bannerEnd">
    <div class="row">
        <div class="col-md-4">
            <img class="img-fluid" src="logo.png"/>
        </div>
        <div class="col-md-8">
            <h1>Perma Farmer</h1>
            <p class="lead">Nous avons ouvert nos portes à Rennes en Mars 2018.<br/>De la volaille à la crémerie, des
                légumes aux boissons, en passant par l‘épicerie fine, ces produits sont tous de véritables produits
                fermiers, avec la qualité et les saveurs qui leur sont propres.<br> All you get is this text and a
                mostly barebones HTML document.</p>
        </div>
    </div>

    <div>
        <h2 class="text-center pt-3 pb-4">Produits ajoutés récemment</h2>
    </div>
    <div class="div-produits">
        <div class="row">
            <?php
            $productDao = new ProductDao();
            $products = $productDao->queryAll();

            echo ProductFormatter::formatProductsList($products);
            ?>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-center">
            <a href="nos-produits.php" class="mb-4 btn-all-products">&#8594; Voir tous nos produits</a>
            </div>
        </div>
    </div>
</div>
<script src="js/home.js"></script>
</body>

</html>
