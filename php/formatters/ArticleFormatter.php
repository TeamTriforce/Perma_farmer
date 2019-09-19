<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 14:37
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

abstract class ArticleFormatter
{
    public static function format(Article $article) 
    {
        return '<div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="' . $article->getImage() . '"/>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>' . $article->getTitle() . '</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Description</h2>
                                    <p>' . $article->getContent() . '</p>
                                </div>
                            </div>
                        <div>
                    </div>
                </div>';
    }
}
