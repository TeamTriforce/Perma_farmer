<?php /* Clients */
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

class CustomerFormatter
{
    public static function format(Customer $customer) 
        {
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
                                    <div class="col-md-3"> /* Avatar du client */
                                        <img src="' . $customer->getPhoto() . '"/>
                                    </div>
                                    <div class="col-md-9"> /* Informations du client */
                                        <p>' . $customer->getFirstName() . '</p>
                                        <p>' . $customer->getLastName() . '</p>
                                        <p>' . $customer->getLocalisation() . '</p>
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
            $orders = $orderDao->
                                '<div class="row">
                                    <h3>Produits achetés</h3>
                                    <p>' . order->getProducts() . '</p>
                                    <div class="row">
                                        <p>' . order->getPickedDate() . '</p>
                                        <p>' . order->getPriceOrder() . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
}