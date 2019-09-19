<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

require_once "AbstractEntity.php";

class Product extends AbstractEntity
{

    private $id;

    private $label;

    private $price;

    private $quantity;

    private $image;

    private $stock;

    private $description;

    /**
     *
     * @param $id
     * @param $label
     * @param $price
     * @param $quantity
     * @param $image
     * @param $stock
     * @param $description
     * @return Product
     */
    public static function newInstance($id, $label, $price, $quantity, $image, $stock, $description)
    {
        $product = new Product([]);

        $product->setId($id);
        $product->setLabel($label);
        $product->setPrice($price);
        $product->setQuantity($quantity);
        $product->setImage($image);
        $product->setStock($stock);
        $product->setDescription($description);

        return $product;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}