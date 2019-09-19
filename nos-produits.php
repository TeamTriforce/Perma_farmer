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
            <h2 class="text-center pt-3 pb-4 title-h2">Nos produits</h2>
        </div>
        <div class="row">
            <?php
            $productDao = new ProductDao();
            $products = $productDao->queryAllAvailable();

            echo ProductFormatter::formatProductsList($products);
            ?>
        </div>
    </div>
</body>

</html>
