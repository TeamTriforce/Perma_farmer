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

    public static function formatProductsList($products)
    {
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
	                                <form method="GET" action="article.php">
	                                    <input type="hidden" name="id" value="' . $product->getId() . '">
	                                    <input type="submit" class="bouton-produit" value="Plus de détails">
                                    </form>
                                    <div class="div-ajout-produit">
                                    <img src="assets/plus.png" class="ajout-panier-img">
                                        <form method="POST" action="formManagement.php" class="form-ajout-panier">
	                                        <input type="hidden" name="addProductId" value="' . $product->getId() . '">
	                                        <input type="submit" src="assets/plus.png" class="ajout-panier-img">
                                        </form>
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

    public static function formatProductDetail(Product $product)
    {
        return '<div class="row">
            <div class="col-md-6">
                <img src="' . $product->getImage() . '" class="img-fluid">
            </div>
            <div class="col-md-6 description-article">
                <h3>' . $product->getLabel() . '</h3><br>
                <p>' . $product->getDescription() . '</p>
                <h4>Stock : <strong>' . $product->getStock() . '</strong></h4>
            </div>
        </div>';
    }

    public static function formatCart(Product $product)
    {
        return '<div class="col-md-6 pb-4">
                <div class="row">
                    <div class="col-md-10 offest-md-1">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="' . $product->getImage() . '" class="img-produit-panier">
                            </div>
                            <div class="col-md-8">
                                <h3>' . $product->getLabel() . '</h3>
                                <form method="POST" action="formManagement.php">
	                                <input type="hidden" name="deleteProductId" value="' . $product->getId() . '">
	                                <input type="submit" value="x">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
    
    public static function formatArticles(Product $product)
    {
        return '<div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <p><i>' . $product->getLabel() . '</i></p>
                        <strong>Description :</strong>
                        <p>' . $product->getDescription() . '</p>
                        <p><strong>Prix : </strong>' . $product->getPrice() . '</p>
                    </div>

                    <div class="col-md-4 text-center">
                        <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#ajouterArticle">Ajouter</button>
                    </div>

                    <div class="col-md-4 text-center">
                        <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#modifierArticle">Modifier</button>
                    </div>

                    <div class="col-md-4 text-center">
                        <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#supprimerArticle">Supprimer</button>
                    </div>
                </div>';
    }

}