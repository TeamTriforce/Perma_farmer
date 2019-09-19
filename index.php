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


    <div class="container-fluid" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid" src="logo.png" />
            </div>
            <div class="col-md-8">
                <h1>Perma Farmer</h1>
                <p class="lead">Nous avons ouvert nos portes à Rennes en Mars 2018.<br />De la volaille à la crémerie, des légumes aux boissons, en passant par l‘épicerie fine, ces produits sont tous de véritables produits fermiers, avec la qualité et les saveurs qui leur sont propres.<br> All you get is this text and a mostly barebones HTML document.</p>
            </div>
        </div>

        <div>
            <h2>Nos produits</h2>
        </div>
        <div>
        <?php
            $productDao = new ProductDao();
            $products = $productDao->queryAll();

            echo ProductFormatter::formatIndexList($products);
        ?>
        </div>
    </div>
</body>

</html>
