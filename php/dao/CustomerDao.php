<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

require_once "AbstractDao.php";
include(dirname(__FILE__) . "/../schemas/CustomerSchema.php");

/**
 * Class PurchaseManager
 */
class CustomerDao extends AbstractDao
{
    /**
     * @param Customer $customer
     * @return bool
     */
    public function create(Customer $customer)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s, %s) VALUES (:fn, :ln, :e, :p)",
                CustomerSchema::TABLE,
                CustomerSchema::FIRST_NAME,
                CustomerSchema::LAST_NAME,
                CustomerSchema::EMAIL,
                CustomerSchema::PASSWORD);
            $req = $this->db->prepare($statement);

            $req->bindValue(":fn", $customer->getFirstName(), PDO::PARAM_STR);
            $req->bindValue(":ln", $customer->getLastName(), PDO::PARAM_STR);
            $req->bindValue(":e", $customer->getEmail(), PDO::PARAM_STR);
            $req->bindValue(":p", $customer->getPassword(), PDO::PARAM_STR);
            $req->execute();
            $customer->setId($this->db->lastInsertId());
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return Customer|null
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                CustomerSchema::TABLE,
                CustomerSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return new Customer($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", CustomerSchema::TABLE, CustomerSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param Customer $customer
     * @return bool
     */
    public function update(Customer $customer)
    {
        try {
            $statement = sprintf("UPDATE `%s` SET %s = :fn, %s = :ln, %s = :e, %s = :p WHERE %s = :i",
                CustomerSchema::TABLE,
                CustomerSchema::FIRST_NAME,
                CustomerSchema::LAST_NAME,
                CustomerSchema::EMAIL,
                CustomerSchema::PASSWORD,
                CustomerSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":fn", $customer->getFirstName(), PDO::PARAM_STR);
            $req->bindValue(":ln", $customer->getLastName(), PDO::PARAM_STR);
            $req->bindValue(":e", $customer->getEmail(), PDO::PARAM_STR);
            $req->bindValue(":p", $customer->getPassword(), PDO::PARAM_STR);
            $req->bindValue(":i", $customer->getId(), PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @return array|null
     */
    public function queryAll() {
        try {
            $customers = [];
            $statement = sprintf("SELECT * FROM `%s`",
                CustomerSchema::TABLE);
            $req = $this->db->query($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $customers[] = new Customer($key);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $customers;
    }

}
