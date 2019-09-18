<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.png">
    <title>Perma Farmer | Mon panier</title>

    <!--Template based on URL below-->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Place your stylesheet here-->
    <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        include("header.php");
    ?>
    <div class="container-fluid div-produits" style="padding-top: 80px;">
        <div>
            <h2 class="text-center pt-3 pb-4">Mon panier</h2>
        </div>
        <div class="row">
            <div class="col-md-6 pb-4">
                <div class="row">
                    <div class="col-md-10 offest-md-1">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/produits/oeufs.jpg" class="img-produit-panier">
                            </div>
                            <div class="col-md-8">
                                <h3>Oeufs</h3>
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="p-quantite">Quantité: 2</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-4"><p class="p-quantite-input">-</p></div>
                                            <div class="col-md-4 offest-md-4"><p class="p-quantite-input">+</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-6 pb-4">
                <div class="row">
                    <div class="col-md-10 offest-md-1">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/produits/tomates.jpg" class="img-produit-panier">
                            </div>
                            <div class="col-md-8">
                                <h3>Tomates</h3>
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="p-quantite">Quantité: 5</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-4"><p class="p-quantite-input">-</p></div>
                                            <div class="col-md-4 offest-md-4"><p class="p-quantite-input">+</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
