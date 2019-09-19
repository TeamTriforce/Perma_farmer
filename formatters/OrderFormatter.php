<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:33
 */

class OrderFormatter
{
    private $id;

    private $availableDate;

    private $pickedDate;

    private $notificationSent;

    private $products;

    private $idCustomer;

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

}