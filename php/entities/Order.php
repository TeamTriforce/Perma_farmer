<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:33
 */

require_once "AbstractEntity.php";

class Order extends AbstractEntity
{

    private $id;

    private $availableDate;

    private $pickedDate;

    private $notificationSent;

    private $products;

    private $idCustomer;

    private $picked;

    /**
     *
     * @param $id
     * @param $availableDate
     * @param $pickedDate
     * @param $notificationSent
     * @param $products
     * @param $idCustomer
     * @param $picked
     * @return Order
     */
    public static function newInstance($id, $availableDate, $pickedDate, $notificationSent, $products, $idCustomer, $picked)
    {
        $order = new Order([]);

        $order->setId($id);
        $order->setAvailableDate($availableDate);
        $order->setPickedDate($pickedDate);
        $order->setNotificationSent($notificationSent);
        $order->setProducts($products);
        $order->setIdCustomer($idCustomer);
        $order->setPicked($picked);

        return $order;
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
    public function getAvailableDate()
    {
        return $this->availableDate;
    }

    /**
     * @param mixed $availableDate
     */
    public function setAvailableDate($availableDate)
    {
        $this->availableDate = $availableDate;
    }

    /**
     * @return mixed
     */
    public function getPickedDate()
    {
        return $this->pickedDate;
    }

    /**
     * @param mixed $pickedDate
     */
    public function setPickedDate($pickedDate)
    {
        $this->pickedDate = $pickedDate;
    }

    /**
     * @return mixed
     */
    public function getNotificationSent()
    {
        return $this->notificationSent;
    }

    /**
     * @param mixed $notificationSent
     */
    public function setNotificationSent($notificationSent)
    {
        $this->notificationSent = $notificationSent;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public function getPicked()
    {
        return $this->picked;
    }

    /**
     * @param mixed $picked
     */
    public function setPicked($picked)
    {
        $this->picked = $picked;
    }

}