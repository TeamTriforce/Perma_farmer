<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

abstract class AdminFormatter
{

    public static function formatAdminList(Admin $admin) 
    {
        return '<div class="row">
                        <div class="col-md-10 offset-md-1" style="border: solid black 2px; margin-bottom:20px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <strong>' . $admin->getLogin() . '</strong>
                                </div>
                                <div class="col-md-4">
                                    Modifier<br>
                                    Supprimer
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    
    public static function formatAdminUser(Admin $admin) 
    {
        return '<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
                    <div class="col-md-6 text-left">
                        <strong>' . '[' . $admin->getId() . ']' . ' ' . $admin->getLogin() . '</strong>
                    </div>

                    <div class="col-md-3 text-center">
                        <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#modifierAdmin">Modifier</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#supprimerAdmin" data-deleteAdminId="' . $admin->getId() . '">Supprimer</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modifierAdmin" tabindex="-1" role="dialog" aria-labelledby="modifierAdmin" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modifierAdmin">Modifier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="Prenom">Login</label>
                                            <input type="text" class="form-control" id="Prenom" placeholder="' . $admin->getLogin() . '">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success">Valider</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }

}
