<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

class AdminFormatter
{
   public static function format(Admin $admin) {
       $str = '
       <div class="container-fluid contact-form">
            <div style="padding-top: 80px;">
                <h1 class="text-center pt-3 pb-4">Administration</h1>
            </div>
        
            <div class="row">
                <div class="col-md-6" style="border: solid black 2px;">
                    <h2 class="text-center">Liste utilisateurs</h2>
                    <div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <strong>Denis Legourrierec</strong>
                                    <p>57 ans</p>
                                    <p>Adresse</p>
                                    <p>Ville</p>
                                    <p>Mail</p>
                                </div>
                                <div class="col-md-4">
                                    Ajouter<br>
                                    Supprimer
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="border: solid black 2px;">
                    <h2 class="text-center">Dernières commandes</h2>
                    <div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Commande n°1059424</strong>
                                </div>
                                <div class="col-md-6">
                                    <p>En savoir plus</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" style="border: solid black 2px;">
                    <h2 class="text-center">Avis clients</h2>
                    <div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Denis Legourrierec</strong>
                                    <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                    <p>Note : 5/5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="border: solid black 2px;">
                    <h2 class="text-center">Liste articles</h2>
                    <div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Oeufs</h3>
                                    <strong>Description :</strong>
                                    <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                    <p><strong>Prix : </strong>1,99 € les 6 oeufs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px; width: 90%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Tomates</h3>
                                    <strong>Description :</strong>
                                    <p>Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus.</p>
                                    <p><strong>Prix : </strong>3,99 € le kg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
   }
}

    private $availableDate;

    private $pickedDate;

   }

}

<p>' . customer->getFirstName() . customer->getLastName() . '</p>
                                <p>' . customer->getAgeName() . ' ans</p>
                                <p>' . customer->getMail() . '</p>
