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
     * Defines the count alias.
     */
    protected const COUNT = "count";

    /**
     * DbManager default constructor.
     */
    public function __construct()
    {
        $connector = new DbConnector();
        $this->db = $connector->getConnector();
    }

}