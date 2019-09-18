<?php

// Gets the parameters inside a $_PUT array if PUT method.
$_PUT = [];

if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    parse_str(file_get_contents("php://input"), $_PUT);

    foreach ($_PUT as $key => $value)
    {
        unset($_PUT[$key]);

        $_PUT[str_replace('amp;', '', $key)] = $value;
    }

    $_REQUEST = array_merge($_REQUEST, $_PUT);
}

// Gets the parameters inside a $_DELETE array if DELETE method.
$_DELETE = [];

if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    parse_str(file_get_contents("php://input"), $_DELETE);

    foreach ($_DELETE as $key => $value)
    {
        unset($_DELETE[$key]);

        $_DELETE[str_replace('amp;', '', $key)] = $value;
    }

    $_REQUEST = array_merge($_REQUEST, $_DELETE);
}
