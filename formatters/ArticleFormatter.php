<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 14:37
 */

class ArticleFormatter
{
    public static function format(Article $article) 
    {
        $str = '<div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="' . article->getImage() '"/>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> /* Nom du produit */
                                <div class="col-md-12">
                                    <h1>' . article->getTitle() . '</h1>
                                </div>
                            </div>
                            <div class="row"> /* Description du produit */
                                <div class="col-md-12">
                                    <h2>Description</h2>
                                    <p>' . article->getContent() . '</p>
                                </div>
                            </div>
                            <div class="row"> /* Prix du produit */
                                <div class="col-md-12">
                                    <h2>Prix</h2>
                                    <p>' . article->getPrice() . '</p>
                                </div>
                            </div>
                            <div class="row"> /* Ajouter le produit */
                                <div class="col-md-12">
                                    <h2>Ajouter au panier</h2>
                                </div>
                            </div>
                        <div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Avis clients</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-1 offset-md-1"> /* Avatar du client */
                                    
                                </div>
                                <div class="col-md-2"> /* Caracteristiques du client */
                                    <div class="row">' /* Nom du client */
                                        . customer->getFirstName() . customer->getLastName() . 
                                    '</div>
                                    <div class="row"> /* Age du client */
                                        
                                    </div>
                                    <div class="row"> /* Note mis au produit */
                                        
                                    </div>
                                </div>
                                <div class="col-md-7"> /* Avis du client */
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}