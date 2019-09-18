<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

require_once "AbstractDao.php";
include(dirname(__FILE__) . "/../schemas/SubscriptionSchema.php");

/**
 * Class SubscriptionDao
 */
class SubscriptionDao extends AbstractDao
{
    /**
     * @param Subscription $subscription
     * @return bool
     */
    public function create(Subscription $subscription)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s) VALUES (:l, :p, :w)",
                SubscriptionSchema::TABLE,
                SubscriptionSchema::LABEL,
                SubscriptionSchema::PRICE,
                SubscriptionSchema::WEIGHT);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $subscription->getLabel(), PDO::PARAM_STR);
            $req->bindValue(":p", $subscription->getPrice(), PDO::PARAM_INT);
            $req->bindValue(":w", $subscription->getWeight(), PDO::PARAM_INT);
            $req->execute();
            $subscription->setId($this->db->lastInsertId());
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return null|Subscription
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                SubscriptionSchema::TABLE,
                SubscriptionSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return new Subscription($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", SubscriptionSchema::TABLE, SubscriptionSchema::ID);
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
     * @param Subscription $subscription
     * @return bool
     */
    public function update(Subscription $subscription)
    {
        try {
            $statement = sprintf("UPDATE `%s` SET %s = :l, %s = :p, %s = :w WHERE %s = :i",
                SubscriptionSchema::TABLE,
                SubscriptionSchema::LABEL,
                SubscriptionSchema::PRICE,
                SubscriptionSchema::WEIGHT,
                SubscriptionSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $subscription->getLabel(), PDO::PARAM_STR);
            $req->bindValue(":p", $subscription->getPrice(), PDO::PARAM_INT);
            $req->bindValue(":w", $subscription->getWeight(), PDO::PARAM_INT);
            $req->bindValue(":i", $subscription->getId(), PDO::PARAM_INT);
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
            $subscriptions = [];
            $statement = sprintf("SELECT * FROM `%s`",
                SubscriptionSchema::TABLE);
            $req = $this->db->query($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $subscriptions[] = new Subscription($key);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $subscriptions;
    }

}
