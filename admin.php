<!DOCTYPE html>
<html lang="fr">

<?php
include("head.php");

if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
    header('Location: index.php');

    exit();
} else {
    $adminDao = new AdminDao();

    if (!$adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        header('Location: index.php');

        exit();
    }
}
?>

<body>
    <?php
        include("header.php");
    ?>

    <div class="container-fluid contact-form">
        <div style="padding-top: 80px;">
            <h2 class="text-center pt-3 pb-4 title-h2">Administration</h2>
        </div>
        <div class="row justify-content-around">
            <div class="col-md-5 col-sm-10" style="border: solid black 2px;">
                <h4 class="text-center">Liste utilisateurs</h4>
                <div class="row" style="margin-bottom: 10px;">

                    <?php
                    $customerDao = new customerDao();
                    $customers = $customerDao->queryAll();
                    
                    foreach ($customers as $customer) {
                        echo CustomerFormatter::formatAdminUtilisateurs($customer);
                    }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="modifierUtilisateur" tabindex="-1" role="dialog" aria-labelledby="modifierUtilisateur" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modifierUtilisateur">Modification</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <script>
                                        $('#modifierUtilisateur').on('show.bs.modal', function(e) {
                                            var customer_id = $(e.relatedTarget).data('modifycustomerid');
                                            var input = document.createElement("input");

                                            input.type = "hidden";
                                            input.name = "customerId";
                                            input.value = customer_id;

                                            document.body.appendChild(input);
                                        });

                                    </script>

                                    <?php
                                    echo CustomerFormatter::formatAdminUtilisateursModificationModal($customer);
                                    ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success"><a href="#modifierUtilisateur" data-toggle="modal">Sauvegarder</a></button>


                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="supprimerUtilisateur" tabindex="-1" role="dialog" aria-labelledby="supprimerUtilisateur" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="supprimerUtilisateur">Suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer cet utilisateur ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success"><a href="#supprimerUtilisateur" data-toggle="modal">Valider</a></button>
                                    <script>
                                        $('#supprimerUtilisateur').on('show.bs.modal', function(e) {

                                            var customer_id = $(e.relatedTarget).data('deletecustomerid');
                                            var form = document.createElement("form");
                                            var input = document.createElement("input");
                                            var submit = document.createElement("input");

                                            submit.type = "submit";

                                            input.type = "hidden";
                                            input.name = "deleteCustomerId";
                                            input.value = customer_id;

                                            form.method = "POST";
                                            form.action = "formManagement.php";

                                            form.appendChild(input);
                                            form.appendChild(submit);
                                            document.body.appendChild(form);

                                            submit.click();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                            <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#ajouterUtilisateur">Ajouter un client</button>

                            <!-- Modal -->
                            <div class="modal fade" id="ajouterUtilisateur" tabindex="-1" role="dialog" aria-labelledby="ajouterUtilisateur" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterUtilisateur">Ajouter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form method="POST" action="formManagement.php">
                                                <div class="form-group">
                                                    <label for="Nom">Nom</label>
                                                    <input type="text" class="form-control" name="lastName" aria-describedby="lastNameHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Prenom">Prenom</label>
                                                    <input type="text" class="form-control" name="firstName" aria-describedby="firstNameHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Email">E-mail</label>
                                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Password">Mot-de-passe</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Abonnement">Abonnement</label>
                                                    <input type="number" class="form-control" name="idSubscription">
                                                </div>
                                                <input type="hidden" name="createCustomer" value="1">
                                                <input type="submit" value="Créer">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <img src="assets/arrow-down.png" />
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-5 col-sm-10" style="border: solid black 2px;">
                <h4 class="text-center">Dernières commandes</h4>
                <div class="row">

                    <?php
                    $orderDao = new orderDao();
                    $orders = $orderDao->queryAll();

                    foreach ($orders as $order) {
                        echo OrderFormatter::formatAdminContenuApercu($order);
                    }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="contenuCommande" tabindex="-1" role="dialog" aria-labelledby="contenuCommande" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contenuCommande">Contenu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <?php
                                    $orderDao = new orderDao();
                                    $orders = $orderDao->queryAll();

                                    foreach ($orders as $order) {
                                        echo OrderFormatter::formatAdminContenuModal($order);
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-top: 10px; margin-bottom: 10px;">
                        <img src="assets/arrow-down.png" />
                    </div>
                </div>
            </div>
        <div class="row justify-content-around" style="margin-top: 50px; margin-bottom: 50px;">
            <div class="col-md-5 col-sm-10" style="border: solid black 2px;">
                <div>
                    <h4 class="text-center">Liste admin</h4>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1" style="border: solid black 2px; margin-bottom:20px;">

                        <?php
                        $adminDao = new adminDao();
                        $admins = $adminDao->queryAll();
                    
                        foreach ($admins as $admin) {
                        
                            echo AdminFormatter::formatAdminUser($admin);
                        }
                        ?>

                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="supprimerAdmin" tabindex="-1" role="dialog" aria-labelledby="supprimerAdmin" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="supprimerAdmin">Supprimer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Supprimer l'administrateur
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success"><a href="#supprimerAdmin" data-toggle="modal">Valider</a></button>
                                    <script>
                                        $('#supprimerAdmin').on('show.bs.modal', function(e) {

                                            var admin_id = $(e.relatedTarget).data('deleteadminid');
                                            var form = document.createElement("form");
                                            var input = document.createElement("input");
                                            var submit = document.createElement("input");

                                            submit.type = "submit";

                                            input.type = "hidden";
                                            input.name = "deleteAdminId";
                                            input.value = admin_id;

                                            form.method = "POST";
                                            form.action = "formManagement.php";

                                            form.appendChild(input);
                                            form.appendChild(submit);
                                            document.body.appendChild(form);

                                            submit.click();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-bottom: 10px;">
                        <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                            <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#ajouterAdmin">Ajouter un administrateur</button>

                            <!-- Modal -->
                            <div class="modal fade" id="ajouterAdmin" tabindex="-1" role="dialog" aria-labelledby="ajouterAdmin" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterAdmin">Ajouter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form method="POST" action="formManagement.php">
                                                <div class="form-group">
                                                    <label for="Login">Login</label>
                                                    <input type="text" class="form-control" name="login" aria-describedby="lastNameHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Password">Mot-de-passe</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <input type="hidden" name="createAdmin" value="1">
                                                <input type="submit" value="Créer">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <img src="assets/arrow-down.png" />
                    </div>
                </div>
            </div>



            <div class="col-md-5 col-sm-10" style="border: solid black 2px;">
                <h4 class="text-center">Liste articles</h4>
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1" style="border: solid black 2px; margin-bottom:20px;">

                        <?php
                        $productDao = new productDao();
                        $products = $productDao->queryAll();
                    
                        foreach ($products as $product) {
                            echo ProductFormatter::formatArticles($product);
                        }
                        ?>

                        <!-- Modal -->
                        <div class="modal fade" id="modifierArticle" tabindex="-1" role="dialog" aria-labelledby="modifierArticle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modifierArticle">Modifier</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo ProductFormatter::formatArticlesForm($product);
                                        ?>                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success">Valider</button>
                                        <a href="#modifierArticle" data-toggle="modal">Sauvegarder</a></button>

                                        <script>
                                            $('#modifierArticle').on('show.bs.modal', function(e) {

                                                var customer_id = $(e.relatedTarget).data('modifyarticleid');
                                                var form = document.createElement("form");
                                                var input = document.createElement("input");
                                                var submit = document.createElement("input");

                                                submit.type = "submit";

                                                input.type = "hidden";
                                                input.name = "modifyArticleId";
                                                input.value = customer_id;

                                                input.type = "text";
                                                input.name = "modifyArticleId";

                                                input.type = "text";
                                                input.name = "modifyArticleId";

                                                form.method = "POST";
                                                form.action = "admin.php";

                                                form.appendChild(input);
                                                form.appendChild(submit);
                                                document.body.appendChild(form);
                                            });

                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="supprimerArticle" tabindex="-1" role="dialog" aria-labelledby="supprimerArticle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="supprimerArticle">Supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Supprimer le produit !
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success"><a href="#supprimerArticle" data-toggle="modal">Valider</a></button>
                                    <script>
                                        $('#supprimerArticle').on('show.bs.modal', function(e) {

                                            var product_id = $(e.relatedTarget).data('deleteproductid');
                                            var form = document.createElement("form");
                                            var input = document.createElement("input");
                                            var submit = document.createElement("input");

                                            submit.type = "submit";

                                            input.type = "hidden";
                                            input.name = "deleteProductId";
                                            input.value = product_id;

                                            form.method = "POST";
                                            form.action = "formManagement.php";

                                            form.appendChild(input);
                                            form.appendChild(submit);
                                            document.body.appendChild(form);

                                            submit.click();
                                        });
                                    </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-bottom: 10px;">
                        <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                            <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#ajouterArticle">Ajouter un article</button>

                            <!-- Modal -->
                            <div class="modal fade" id="ajouterArticle" tabindex="-1" role="dialog" aria-labelledby="ajouterArticle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterArticle">Ajouter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="formManagement.php">
                                                <div class="form-group">
                                                    <label for="Label">Label</label>
                                                    <input type="text" class="form-control" name="label" aria-describedby="lastNameHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Description">Description</label>
                                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Stock">Stock</label>
                                                    <input type="number" step="0.01" class="form-control" name="stock" aria-describedby="emailHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Prix">Prix</label>
                                                    <input type="number" step="0.01" class="form-control" name="price" aria-describedby="emailHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Image">Image</label>
                                                    <input type="text" class="form-control" name="image" aria-describedby="emailHelp">
                                                </div>
                                                <input type="hidden" name="createProduct" value="1">
                                                <input type="submit" value="Créer">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <img src="assets/arrow-down.png" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
