<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

require_once "AbstractDao.php";
include(dirname(__FILE__) . "/../schemas/OrderSchema.php");

/**
 * Class OrderDao
 */
class OrderDao extends AbstractDao
{
    /**
     * @param Order $order
     * @return bool
     */
    public function create(Order $order)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s, %s) VALUES (:ad, :pd, :ns, :ci)",
                OrderSchema::TABLE,
                OrderSchema::AVAILABLE_DATE,
                OrderSchema::PICKED_DATE,
                OrderSchema::NOTIFICATION_SENT,
                OrderSchema::CUSTOMER);
            $req = $this->db->prepare($statement);

            $req->bindValue(":ad", $order->getAvailableDate(), PDO::PARAM_STR);
            $req->bindValue(":pd", $order->getPickedDate(), PDO::PARAM_STR);
            $req->bindValue(":ns", $order->getNotificationSent(), PDO::PARAM_INT);
            $req->bindValue(":ci", $order->getIdCustomer(), PDO::PARAM_INT);

            $req->execute();
            $req->closeCursor();
            $order->setId($this->db->lastInsertId());

            $this->createAssociatedProducts($order);
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return null|Order
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                OrderSchema::TABLE,
                OrderSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();

            $order = new Order($data);

            $order->setProducts($this->getAssociatedProducts($order));
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $order;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $this->deleteAssociateProducts($id);

            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", OrderSchema::TABLE, OrderSchema::ID);
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
     * @param Order $order
     * @return bool
     */
    public function update(Order $order)
    {
        try {
            $this->deleteAssociateProducts($order->getId());

            $statement = sprintf("UPDATE `%s` SET %s = :ad, %s = :pd, %s = :ns, %s = :ci WHERE %s = :i",
                OrderSchema::TABLE,
                OrderSchema::AVAILABLE_DATE,
                OrderSchema::PICKED_DATE,
                OrderSchema::NOTIFICATION_SENT,
                OrderSchema::CUSTOMER,
                OrderSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":ad", $order->getAvailableDate(), PDO::PARAM_STR);
            $req->bindValue(":pd", $order->getPickedDate(), PDO::PARAM_STR);
            $req->bindValue(":ns", $order->getNotificationSent(), PDO::PARAM_STR);
            $req->bindValue(":ci", $order->getIdCustomer(), PDO::PARAM_INT);
            $req->bindValue(":i", $order->getId(), PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();

            $this->createAssociatedProducts($order);

        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    public function addProduct(Order $order, Product $product) {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s) VALUES (:io, :ip, :q)",
                OrderSchema::JOINED_TABLE,
                OrderSchema::ID,
                ProductSchema::ID,
                OrderSchema::QUANTITY);
            $req = $this->db->prepare($statement);

            $req->bindValue(":io", $order->getId(), PDO::PARAM_INT);
            $req->bindValue(":ip", $product->getId(), PDO::PARAM_INT);
            $req->bindValue(":q", $product->getQuantity(), PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    public function removeProduct(Order $order, Product $product) {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :io AND %s = :ip",
                OrderSchema::JOINED_TABLE,
                OrderSchema::ID,
                ProductSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":io", $order->getId(), PDO::PARAM_INT);
            $req->bindValue(":ip", $product->getId(), PDO::PARAM_INT);
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
            $orders = [];
            $statement = sprintf("SELECT * FROM `%s`",
                OrderSchema::TABLE);
            $req = $this->db->query($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $order = new Order($key);

                $order->setProducts($this->getAssociatedProducts($order));

                $orders[] = $order;
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $orders;
    }

    /**
     * @param Order $order
     * @return bool
     */
    private function createAssociatedProducts(Order $order) {
        try {
            foreach ($order->getProducts() as $product) {
                $statement = sprintf("INSERT INTO `%s` (%s, %s, %s) VALUES (:io, :ip, :q)",
                    OrderSchema::JOINED_TABLE,
                    OrderSchema::ID,
                    ProductSchema::ID,
                    OrderSchema::QUANTITY);
                $req = $this->db->prepare($statement);

                $req->bindValue(":io", $order->getId(), PDO::PARAM_INT);
                $req->bindValue(":ip", $product->getId(), PDO::PARAM_INT);
                $req->bindValue(":q", $product->getQuantity(), PDO::PARAM_INT);
                $req->execute();
                $req->closeCursor();
            }
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param Order $order
     * @return array|null
     */
    private function getAssociatedProducts(Order $order) {
        $products = [];

        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                OrderSchema::JOINED_TABLE,
                OrderSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $order->getId(), PDO::PARAM_INT);
            $req->execute();

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            $productDao = new ProductDao();

            foreach ($result as $elt) {
                $products[] = $productDao->read($elt[ProductSchema::ID]);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $products;
    }

    /**
     * @param int $id
     * @return bool
     */
    private function deleteAssociateProducts(int $id) {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", OrderSchema::JOINED_TABLE, OrderSchema::ID);
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

}
