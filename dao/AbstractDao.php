<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:56
 */

abstract class AbstractDao
{
    protected $db;

    /**
     *	@param PDO $obj
     *	@return void
     */
    public function __construct(PDO $obj)
    {
        $this->db = $obj;
    }

    /**
     *	@param void
     *	@return PDO $db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     *	@param PDO $new
     *	@return void
     */
    public function setDb(PDO $new)
    {
        $this->db = $new;
    }

}