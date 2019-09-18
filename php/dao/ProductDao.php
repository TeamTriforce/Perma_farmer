<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

require_once "AbstractDao.php";
include(dirname(__FILE__) . "/../schemas/ProductSchema.php");

/**
 * Class ProductDao
 */
class ProductDao extends AbstractDao
{
    /**
     * @param Product $product
     * @return bool
     */
    public function create(Product $product)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s, %s) VALUES (:l, :p, :s, :i)",
                ProductSchema::TABLE,
                ProductSchema::LABEL,
                ProductSchema::PRICE,
                ProductSchema::STOCK,
                ProductSchema::IMAGE);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $product->getLabel(), PDO::PARAM_INT);
            $req->bindValue(":p", $product->getPrice(), PDO::PARAM_INT);
            $req->bindValue(":s", $product->getStock(), PDO::PARAM_INT);
            $req->bindValue(":i", $product->getImage(), PDO::PARAM_STR);
            $req->execute();
            $product->setId($this->db->lastInsertId());
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return null|Product
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                ProductSchema::TABLE,
                ProductSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return new Product($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", ProductSchema::TABLE, ProductSchema::ID);
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
     * @param Product $product
     * @return bool
     */
    public function update(Product $product)
    {
        try {
            $statement = sprintf("UPDATE `%s` SET %s = :l, %s = :p, %s = :s, %s = :img WHERE %s = :i",
                ProductSchema::TABLE,
                ProductSchema::LABEL,
                ProductSchema::PRICE,
                ProductSchema::STOCK,
                ProductSchema::IMAGE,
                ProductSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $product->getLabel(), PDO::PARAM_STR);
            $req->bindValue(":p", $product->getPrice(), PDO::PARAM_INT);
            $req->bindValue(":s", $product->getStock(), PDO::PARAM_INT);
            $req->bindValue(":img", $product->getImage(), PDO::PARAM_STR);
            $req->bindValue(":i", $product->getId(), PDO::PARAM_INT);
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
            $products = [];
            $statement = sprintf("SELECT * FROM `%s`",
                ProductSchema::TABLE);
            $req = $this->db->query($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $products[] = new Product($key);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $products;
    }

}
