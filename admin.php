<!DOCTYPE html>
<html lang="en">

<?php
        include("head.php");
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
                <!-- Mettre une limite de 2  -->
                <h4 class="text-center">Liste utilisateurs</h4>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1" style="border: solid black 2px; margin-bottom:20px;">
                        <div class="row" style="margin-top: 10px;margin-bottom: 10px;">

                            <!-- formatAdminUtilisateurs -->

                            <div class="col-md-6 text-center">
                                <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#modifierUtilisateur">Modifier</button>
                            </div>

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

                                            <!-- formatAdminUtilisateursModal -->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Sauvegarder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#supprimerUtilisateur">Supprimer</button>
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
                                            <button type="button" class="btn btn-success">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-top: 10px; margin-bottom: 10px;">
                        <img src="assets/arrow-down.png" />
                    </div>
                </div>
            </div>


            <div class="col-md-5 col-sm-10" style="border: solid black 2px;">
                <!-- Mettre une limite de 2  -->
                <h4 class="text-center">Dernières commandes</h4>
                <div class="row">

                    <!-- formatAdminContenuApercu -->

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

                                    <!-- formatAdminContenuModal -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-top: 10px; margin-bottom: 10px;">
                        <img src="assets/arrow-down.png" />
                    </div>
                </div>
            </div>


        </div>
        <div class="row justify-content-around" style="margin-top: 50px;">
            <div class="col-md-5 col-sm-10" style="border: solid black 2px;">
                <div>
                    <h4 class="text-center">Liste admin</h4>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1" style="border: solid black 2px; margin-bottom:20px;">
                        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="col-md-6 text-left">
                                <strong>' . $customer->getFirstName() . $customer->getLastName() . '</strong>
                            </div>

                            <div class="col-md-3 text-center">
                                <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#modifierAdmin">Modifier</button>
                            </div>

                            <div class="col-md-3 text-center">
                                <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#supprimerAdmin">Supprimer</button>
                            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="ajouterAvis" tabindex="-1" role="dialog" aria-labelledby="modifierAvis" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modifierAvis">Modifier</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Faire un form pour modification -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="ajouterAvis" tabindex="-1" role="dialog" aria-labelledby="ajouterAvis" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterAvis">Supprimer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Supprimer l'administrateur
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-bottom: 10px;">
                        <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                            <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#ajouterAdmin">Ajouter un administrateur</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="ajouterAvis" tabindex="-1" role="dialog" aria-labelledby="ajouterAdmin" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterAdmin">Ajouter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Ajouter cet administrateur
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Valider</button>
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
                <!-- Mettre une limite de 2 -->
                <h4 class="text-center">Liste articles</h4>
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1" style="border: solid black 2px; margin-bottom:20px;">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12">
                                <p><i>Nom du produit</i></p>
                                <strong>Description :</strong>
                                <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                <p><strong>Prix : </strong>Prix du produit</p>
                            </div>

                            <div class="col-md-4 text-center">
                                <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#ajouterArticle">Ajouter</button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="ajouterArticle" tabindex="-1" role="dialog" aria-labelledby="ajouterArticle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterArticle">Ajout</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Ajouter le produit !
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#modifierArticle">Modifier</button>
                            </div>

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
                                            Modifier le produit !
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#supprimerArticle">Supprimer</button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="supprimerArticle" tabindex="-1" role="dialog" aria-labelledby="supprimerArticle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="supprimerArticle">Modifier</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Supprimer le produit !
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 text-center" style="margin-top: 10px; margin-bottom: 10px;">
                        <img src="assets/arrow-down.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
