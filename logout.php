<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 20/09/2019
 * Time: 09:41
 */

session_start();
session_destroy();
header("Location: index.php");

exit();
