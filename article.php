<!DOCTYPE html>
<html lang="en">

<?php
        include("head.php");
    ?>

<body>
    <?php
        include("header.php");

        if (!isset($_GET["id"])) {
            header('Location: index.php');

            exit();
        }
    ?>
    <div class="div-ajout-panier-article">
        <form method="POST" action="formManagement.php" class="form-ajout-panier">
            <input type="hidden" name="addProductId" value="<?php echo $_GET["id"] ?>">
            <input type="submit" class="ajout-panier-img" value="">
        </form>
        <p>Ajouter au panier</p>
        <img src="assets/ajout-panier.png">
    </div>
    <div class="container-fluid" style="padding-top: 100px;">
        <?php
            $productDao = new ProductDao();
            $product = $productDao->read($_GET["id"]);

            if ($product == null) {
                // TODO : Create a 404 page.
                header('Location: index.php');

                exit();
            } else {
                echo ProductFormatter::formatProductDetail($product);
            }
        ?>
        <div>
            <h2 class="text-center pt-3 pb-4 title-h2">Avis clients</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10 offset-md-1 avis-clients-div">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-4">
                                <img src="assets/clients/mathieu.jpg">
                            </div>
                            <div class="col-md-3 col-sm-5 col-5">
                                <strong>Mathieu Hubert</strong>
                                <p>42 ans</p>
                                <img src="assets/etoiles/etoiles-5.png" class="etoiles-article">
                            </div>
                            <div class="col-md-7 avis-client-p">
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10 offset-md-1 avis-clients-div">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-4">
                                <img src="assets/clients/nicolas.PNG">
                            </div>
                            <div class="col-md-3 col-sm-5 col-5">
                                <strong>Nicolas Caoulan</strong>
                                <p>24 ans</p>
                                <img src="assets/etoiles/etoiles-2.png" class="etoiles-article">
                            </div>
                            <div class="col-md-7 avis-client-p">
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10 offset-md-1 avis-clients-div">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-4">
                                <img src="assets/clients/denis.jpg">
                            </div>
                            <div class="col-md-3 col-sm-5 col-5">
                                <strong>Denis Legourrierec</strong>
                                <p>57 ans</p>
                                <img src="assets/etoiles/etoiles-4.png" class="etoiles-article">
                            </div>
                            <div class="col-md-7 avis-client-p">
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10 offset-md-1 avis-clients-div">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-4">
                                <img src="assets/clients/erwan.jpg">
                            </div>
                            <div class="col-md-3 col-sm-5 col-5">
                                <strong>Erwan Le Hellard</strong>
                                <p>22 ans</p>
                                <img src="assets/etoiles/etoiles-5.png" class="etoiles-article">
                            </div>
                            <div class="col-md-7 avis-client-p">
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</body>

</html>
