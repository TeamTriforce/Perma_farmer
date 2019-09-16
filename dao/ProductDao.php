<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

/**
 * Class PurchaseManager
 */
class ProductDao extends AbstractDao
{
    /**
     * @param Product $product
     * @return
     */
    public function create(Product $product)
    {
        try {
            $statement = sprintf("INSERT INTO %s (%s, %s, %s) VALUES (?, ?, ?)",
                ProductSchema::TABLE,
                ProductSchema::LABEL,
                ProductSchema::PRICE,
                ProductSchema::STOCK);
            $req = $this->db->prepare($statement);

            $req->execute($product->toArray(true));
            $req->closeCursor();
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
                ProductSchema::TABLE,
                ProductSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();
        } catch (PDOException $e) {
            return null;
        }

        return new Product($data);
    }

    /**
     * @param int $id
     * @return
     */
    public function delete(int $id)
    {
        try {
            $statement = sprintf("DELETE FROM %s WHERE %s = :i", ProductSchema::TABLE, ProductSchema::ID);
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
     * @param Product $product
     * @return bool
     */
    public function update(Product $product)
    {
        try {
            $statement = sprintf("UPDATE %s SET %s = :l, %s = :p, %s = :s",
                ProductSchema::TABLE,
                ProductSchema::LABEL,
                ProductSchema::PRICE);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $product->getLabel(), PDO::PARAM_STR);
            $req->bindValue(":p", $product->getPrice(), PDO::PARAM_INT);
            $req->bindValue(":p", Product::getStock(), PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
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
            $products = [];
            $statement = sprintf("SELECT * FROM %s",
                ProductSchema::TABLE);
            $req = $this->db->exec($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $products[] = new Product($key);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            return null;
        }

        return $products;
    }

}
