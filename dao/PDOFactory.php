<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:53
 */

/**
 * Using pattern factory for PDO instance.
 */
class PDOFactory
{
    /**
     *	@param void
     *	@return PDO $db The database connection object.
     */
    public static function getDb()
    {
        try
        {
            $db = new PDO("mysql:host=localhost:8888;dbname=Perma_farmer;charset=utf8", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e)
        {
            die("PDO Error : " . $e->getMessage());
        }

        return $db;
    }

}