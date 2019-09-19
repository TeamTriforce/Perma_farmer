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
       $str = '<div class="col-md-2 offset-md-1">
                    <a href="#">
                        <div class="div-produit">
                            <div class="div-img-produit">
                                <p><strong>' . product->getPrice() . '</strong>' . product->getLabel() . '</p>
                                <p class="bouton-produit">Plus de détails</p>
                                <div class="div-ajout-produit">
                                    <img src="assets/ajout-panier.png" class="ajout-panier-img">
                                </div>
                            </div>
                            <img src="' . product->getImage() . '"/>
                        </div>
                        <h3>' . product->getTitle() . '</h3>
                    </a>
                </div>';
   }
}