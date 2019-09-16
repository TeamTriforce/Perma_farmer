<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

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
            $statement = sprintf("INSERT INTO %s (%s, %s, %s) VALUES (?, ?, ?)",
                OrderSchema::TABLE,
                OrderSchema::AVAILABLE_DATE,
                OrderSchema::PICKED_DATE,
                OrderSchema::NOTIFICATION_SENT);
            $req = $this->db->prepare($statement);

            $req->execute($order->toArray(true));
            $req->closeCursor();
            $order->setId($this->db->lastInsertId());

            $this->createAssociatedProducts($order);
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM %s WHERE %s = :i",
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
            return null;
        }

        return $order;
    }

    /**
     * @param int $id
     * @return
     */
    public function delete(int $id)
    {
        try {
            $this->deleteAssociateProducts($id);

            $statement = sprintf("DELETE FROM %s WHERE %s = :i", OrderSchema::TABLE, OrderSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
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

            $statement = sprintf("UPDATE %s SET %s = :ad, %s = :pd, %s = :ns",
                OrderSchema::TABLE,
                OrderSchema::AVAILABLE_DATE,
                OrderSchema::PICKED_DATE,
                OrderSchema::NOTIFICATION_SENT);
            $req = $this->db->prepare($statement);

            $req->bindValue(":ad", $order->getAvailableDate(), PDO::PARAM_STR);
            $req->bindValue(":pd", $order->getPickedDate(), PDO::PARAM_STR);
            $req->bindValue(":ns", $order->getNotificationSent(), PDO::PARAM_STR);
            $req->execute();
            $req->closeCursor();

            $this->createAssociatedProducts($order);

        } catch (PDOException $e) {
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
            $statement = sprintf("SELECT * FROM %s",
                OrderSchema::ID);
            $req = $this->db->exec($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $order = new Order($key);

                $order->setProducts($this->getAssociatedProducts($order));

                $orders[] = $order;
            }

            $req->closeCursor();
        } catch (PDOException $e) {
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
                $statement = sprintf("INSERT INTO %s (%s, %s, %s) VALUES (:io, :ip, :q)",
                    OrderSchema::JOINED_TABLE,
                    OrderSchema::ID,
                    ProductSchema::ID,
                    OrderSchema::QUANTITY);
                $req = $this->db->prepare($statement);

                $req->bindValue(":io", $order->getId(), PDO::PARAM_INT);
                $req->bindValue(":io", $product->getId(), PDO::PARAM_INT);
                $req->bindValue(":q", $product->getQuantity(), PDO::PARAM_INT);
                $req->execute();
                $req->closeCursor();
            }
        } catch (PDOException $e) {
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
            $statement = sprintf("SELECT * FROM %s WHERE %s = :i",
                OrderSchema::JOINED_TABLE,
                OrderSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $order->getId(), PDO::PARAM_INT);
            $req->execute();

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            $req->closeCursor();

            foreach ($result as $elt) {
                $products[] = new Product($elt);
            }
        } catch (PDOException $e) {
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
            $statement = sprintf("DELETE FROM %s WHERE %s = :i", OrderSchema::JOINED_TABLE, OrderSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

}
