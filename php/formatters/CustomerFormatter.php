<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

abstract class CustomerFormatter
{
    public static function formatProfile(Customer $customer) {
        $str = '<div class="container">
                        <div class="row">
                            <h1>Profil</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <h2>Informations personnelles</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-9"> /* Informations du client */
                                        <p>' . $customer->getFirstName() . '</p>
                                        <p>' . $customer->getLastName() . '</p>
                                        <p>' . $customer->getEmail() . '</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2>Corriger des informations</h2>
                                </div>
                                <div class="row">
                                    <form>
                                        <div class="form-group">
                                            <label for="Nom">' . $customer->getLastName() . '</label>
                                            <input type="text" class="form-control" id="Nom" aria-describedby="lastNameHelp" placeholder="' . $customer->getLastName() . '">
                                        </div>
                                        <div class="form-group">
                                            <label for="Prenom">' . $customer->getFirstName() . '</label>
                                            <input type="text" class="form-control" id="Prenom" aria-describedby="firstNameHelp" placeholder="' . $customer->getFirstName() . '">
                                        </div>
                                        <div class="form-group">
                                            <label for="Mail">' . $customer->getEmail() . '</label>
                                            <input type="email" class="form-control" id="Mail" aria-describedby="emailHelp" placeholder="' . $customer->getMail() . '">
                                        </div>
                                        <div class="form-group">
                                            <label for="Password">' . $customer->getPassword() . '</label>
                                            <input type="password" class="form-control" id="Password" placeholder="' . $customer->getPassword() . '">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <br/>
                                    <br/>
                                    <br/>
                                </div>
                                <div class="row">
                                    <p>Supprimer mon compte</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <h2>Dernières commandes</h2>
                                </div>';

        $orderDao = new OrderDao();
        $orders = $orderDao->queryCustomerOrders($customer->getId());

        foreach ($orders as $order) {
            $str .= '<div class="row">
                             <h3>Produits achetés</h3>';

            foreach ($order->getProducts() as $product) {
                $str .= '<p>' . $product->getLabel() . '</p>';
            }

            $str .= '<div class="row">
                             <p>' . $order->getPickedDate() . '</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>';
        }

        return $str;
    }

    public static function formatAdminList(Customer $customer) {
        return '<div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <strong>' . $customer->getFirstName() . ' ' . $customer->getLastName() . '</strong>
                                    <p>Email : ' . $customer->getEmail() . '</p>
                                    <p>Code : ' . $customer->getCode() . '</p>
                                    <p>Abonnement : ' . $customer->getIdSubscription() . '</p>
                                </div>
                                <div class="col-md-4">
                                    Modifier<br>
                                    Supprimer
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    
    public static function formatAdminUtilisateurs(Customer $customer) {
        return '<div class="col-md-12">
                    <strong>' . $customer->getFirstName() . $customer->getLastName() . '</strong>
                    <p>' . $customer->getEmail() . '</p>
                    <p>' . $customer->getCode() . '</p>
                </div>';
    }
    
    public static function formatAdminUtilisateursModificationModal(Customer $customer) {
        return '<form>
                    <div class="form-group">
                        <label for="Nom">' . $customer->getLastName() . '</label>
                        <input type="text" class="form-control" id="Nom" aria-describedby="lastNameHelp" placeholder="' . $customer->getLastName() . '">
                    </div>
                    <div class="form-group">
                        <label for="Prenom">' . $customer->getFirstName() . '</label>
                        <input type="text" class="form-control" id="Prenom" aria-describedby="firstNameHelp" placeholder="' . $customer->getFirstName() . '">
                    </div>
                    <div class="form-group">
                        <label for="Mail">' . $customer->getEmail() . '</label>
                        <input type="email" class="form-control" id="Mail" aria-describedby="emailHelp" placeholder="' . $customer->getMail() . '">
                    </div>
                    <div class="form-group">
                        <label for="Password">' . $customer->getPassword() . '</label>
                        <input type="password" class="form-control" id="Password" placeholder="' . $customer->getPassword() . '">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>';
    }
    
    
}


