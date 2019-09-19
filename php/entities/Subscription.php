<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 14:37
 */

require_once "AbstractEntity.php";

class Subscription extends AbstractEntity
{

    private $id;

    private $label;

    private $price;

    private $weight;

    /**
     *
     * @param $id
     * @param $label
     * @param $price
     * @param $weight
     * @return Subscription
     */
    public static function newInstance($id, $label, $price, $weight)
    {
        $subscription = new Subscription([]);

        $subscription->setId($id);
        $subscription->setLabel($label);
        $subscription->setPrice($price);
        $subscription->setWeight($weight);

        return $subscription;
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
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

}