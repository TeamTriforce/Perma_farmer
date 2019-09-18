<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:56
 */

require_once "DbConnector.php";

abstract class AbstractDao
{
    /**
     * @var PDO Stores the connector object.
     */
    protected $db;

    /**
     * AbstractDao constructor.
     * @param bool $test
     */
    public function __construct($test = false)
    {
        $connector = new DbConnector();

        if ($test) {
            $this->db = $connector->getTestConnector();
        } else {
            $this->db = $connector->getConnector();
        }
    }

}