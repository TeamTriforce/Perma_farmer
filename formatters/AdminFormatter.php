<?php /* Produits */
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

class ProductFormatter
{
   public static function format(Product $product) {
       $str = '<div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Liste utilisateurs</h1>
                                <p>' . customer->getFirstName() . customer->getLastName() . '</p>
                                <p>' . customer->getAgeName() . ' ans</p>
                                <p>' . customer->getMail() . '</p>
                                <div>
                                    <button>Modifier</button>
                                    <button>Supprimer</button>
                                </div>
                            <h1>Avis clients</h1>
                        </div>
                        <div class="col-md-6">
                            <h1>Dernières commandes</h1>
                                
                            <h1>Listes articles</h1>
                        </div>
                    </div>
               </div>';
   }
}

    private $availableDate;

    private $pickedDate;

    private $notificationSent;

    private $products;

    private $idCustomer;