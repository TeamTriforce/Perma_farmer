<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:33
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

abstract class OrderFormatter
{
    public static function formatAdminContenuApercu(Order $order) 
    {
        return '
        <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1" style="border: solid black 2px; margin-bottom:20px;">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>' . $order->getProducts() . '</p>
                </div>
            </div>
            <div class="col-md-12 text-right" style="margin-bottom: 2px;">
                <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#contenuCommande">En savoir plus</button>
            </div>
        </div>';
    }
    
    public static function formatAdminContenuModal(Order $order) 
    {
        return '
        <h3>Commande du client n°<strong>' . $order->getIdCustomer . '</strong></h3>
        <ul>
            <li>' . $order->getProducts . '</li>
        </ul>
        <p>Etat : ' . $order->getNotificationSent . '</p>';
    }
}