<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

abstract class ProductFormatter
{

    public static function formatIndexList($products) {
        $str = '';
        $rowNb = 0;
        $firstRow = true;

        foreach ($products as $product) {
            if ($firstRow) {
                $str .= '<div class="col-md-2 offset-md-1">';

                $firstRow = false;
            } else {
                $str .= '<div class="col-md-2">';
            }

            $str .= '<a href="article.php">
	                    <div class="div-produit">
	                        <div class="div-img-produit">
	                            <div class="overlay-produit">
                                    <p class="bouton-produit">Plus de détails</p>
                                    <div class="div-ajout-produit">
                                        <img src="assets/plus.png" class="ajout-panier-img">
                                    </div>
                                 </div>
                                 <img src="' . $product->getImage() . '" />
                             </div>
                             <h3>' . $product->getLabel() . '</h3>
                         </div>
                      </a></div>';

            $rowNb++;

            if ($rowNb == 5) {
                $firstRow = true;
                $rowNb = 0;
            }
        }

        return $str;
    }

   public static function formatProductsList($products) {
       $str = '';
       $rowNb = 0;
       $firstRow = true;

       foreach ($products as $product) {
           if ($firstRow) {
               $str .= '<div class="col-md-2 offset-md-1">';

               $firstRow = false;
           } else {
               $str .= '<div class="col-md-2">';
           }

           $str .= '<a href="#">
                        <div class="div-produit">
                            <div class="div-img-produit">
                                <p><strong>' . $product->getLabel() . '</strong></p>
                                <p class="bouton-produit">Plus de détails</p>
                                <div class="div-ajout-produit">
                                    <img src="assets/ajout-panier.png" class="ajout-panier-img">
                                </div>
                            </div>
                            <img src="' . $product->getImage() . '"/>
                        </div>
                    </a></div>';

           $rowNb++;

           if ($rowNb == 5) {
               $firstRow = true;
               $rowNb = 0;
           }
       }

       return $str;
   }

   public static function formatProductDetail(Product $product) {
       return '<div class="div-ajout-panier-article">
        <p>Ajouter au panier</p>
        <img src="' . $product->getImage() . '">
    </div>
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <div class="col-md-6">
                <img src="assets/produits/oeufs.jpg" class="img-fluid">
            </div>
            <div class="col-md-6 description-article">
                <h3>' . $product->getLabel() . '</h3><br>
                <h4>Description</h4>
                <p>' . $product->getDescription() . '</p><br>
                <h4>Prix</h4>
                <p><strong>' . $product->getPrice() . ' €</strong></p>
                <h4>Stock</h4>
                <p><strong>' . $product->getStock() . '</strong></p>
            </div>
        </div>';
   }

   public static function formatCart(Product $product) {
       return '<div class="col-md-6 pb-4">
                <div class="row">
                    <div class="col-md-10 offest-md-1">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="' . $product->getImage() . '" class="img-produit-panier">
                            </div>
                            <div class="col-md-8">
                                <h3>' . $product->getLabel() . '</h3>
                                <p>' . $product->getDescription() . '</p>
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="p-quantite">Quantité: ' . $product->getQuantity() . '</p>
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
            </div>';
   }

}