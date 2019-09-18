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
 * Class CustomerDao
 */
class CustomerDao extends AbstractDao
{

    const TOKEN_LENGTH = 50;

    /**
     * @param Customer $customer
     * @return bool
     */
    public function create(Customer $customer)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s, %s, %s, %s, %s) VALUES (:fn, :ln, :e, :p, :c, :t, :s)",
                CustomerSchema::TABLE,
                CustomerSchema::FIRST_NAME,
                CustomerSchema::LAST_NAME,
                CustomerSchema::EMAIL,
                CustomerSchema::PASSWORD,
                CustomerSchema::CODE,
                CustomerSchema::TOKEN,
                CustomerSchema::SUBSCRIPTION);
            $req = $this->db->prepare($statement);

            $req->bindValue(":fn", $customer->getFirstName(), PDO::PARAM_STR);
            $req->bindValue(":ln", $customer->getLastName(), PDO::PARAM_STR);
            $req->bindValue(":e", $customer->getEmail(), PDO::PARAM_STR);
            $req->bindValue(":p", password_hash($customer->getPassword(), PASSWORD_BCRYPT), PDO::PARAM_STR);
            $req->bindValue(":c", $customer->getCode(), PDO::PARAM_STR);
            $req->bindValue(":t", $customer->getAuthToken(), PDO::PARAM_STR);
            $req->bindValue(":s", $customer->getIdSubscription(), PDO::PARAM_INT);
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
            $statement = sprintf("UPDATE `%s` SET %s = :fn, %s = :ln, %s = :e, %s = :p, %s = :c, %s = :t, %s = :s WHERE %s = :i",
                CustomerSchema::TABLE,
                CustomerSchema::FIRST_NAME,
                CustomerSchema::LAST_NAME,
                CustomerSchema::EMAIL,
                CustomerSchema::PASSWORD,
                CustomerSchema::CODE,
                CustomerSchema::TOKEN,
                CustomerSchema::SUBSCRIPTION,
                CustomerSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":fn", $customer->getFirstName(), PDO::PARAM_STR);
            $req->bindValue(":ln", $customer->getLastName(), PDO::PARAM_STR);
            $req->bindValue(":e", $customer->getEmail(), PDO::PARAM_STR);
            $req->bindValue(":p", password_hash($customer->getPassword(), PASSWORD_BCRYPT), PDO::PARAM_STR);
            $req->bindValue(":c", $customer->getCode(), PDO::PARAM_STR);
            $req->bindValue(":t", $customer->getAuthToken(), PDO::PARAM_STR);
            $req->bindValue(":s", $customer->getIdSubscription(), PDO::PARAM_STR);
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

    public function login(string $login, string $password) {
        try {
            $statement = sprintf("SELECT %s, %s FROM `%s` WHERE %s = :l",
                CustomerSchema::ID, CustomerSchema::PASSWORD, CustomerSchema::TABLE, CustomerSchema::EMAIL);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $login, PDO::PARAM_STR);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $data[CustomerSchema::PASSWORD])) {
                $result = [];
                $result[CustomerSchema::ID] = $data[CustomerSchema::ID];

                $req->closeCursor();

                try {
                    $token = bin2hex(random_bytes(static::TOKEN_LENGTH));
                    $result[CustomerSchema::TOKEN] = $token;
                    $statement = sprintf("UPDATE `%s` SET %s = :t WHERE %s = :i",
                        CustomerSchema::TABLE,
                        CustomerSchema::TOKEN,
                        CustomerSchema::ID);
                    $req = $this->db->prepare($statement);

                    $req->bindValue(":t", $token, PDO::PARAM_STR);
                    $req->bindValue(":i", $result[CustomerSchema::ID], PDO::PARAM_INT);
                    $req->execute();
                    $req->closeCursor();

                    return $result;
                } catch (Exception $e) {
                    echo $e;

                    return null;
                }
            } else {
                $req->closeCursor();

                return null;
            }
        } catch (PDOException $e) {
            echo $e;

            return null;
        }
    }

    public function checkToken(int $id, string $token) {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i AND %s = :t",
                CustomerSchema::TABLE,
                CustomerSchema::ID,
                CustomerSchema::TOKEN);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->bindValue(":t", $token, PDO::PARAM_STR);
            $req->execute();

            $valid = $req->fetch(PDO::FETCH_ASSOC) != false;

            $req->closeCursor();

            return $valid;
        } catch (PDOException $e) {
            echo $e;

            return false;
        }
    }

}
