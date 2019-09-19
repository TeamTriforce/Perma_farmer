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

    public static function formatAdminList(Admin $admin) {
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

}
