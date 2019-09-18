<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:32
 */

require_once "AbstractEntity.php";

class Customer extends AbstractEntity
{

    private $id;

    private $firstName;

    private $lastName;

    private $email;

    private $password;

    private $code;

    private $authToken;

    private $idSubscription;

    /**
     *
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @param $code
     * @param $authToken
     * @param $idSubscription
     * @return Customer
     */
    public static function newInstance($id, $firstName, $lastName, $email, $password, $code, $authToken, $idSubscription)
    {
        $customer = new Customer([]);

        $customer->setId($id);
        $customer->setFirstName($firstName);
        $customer->setLastName($lastName);
        $customer->setEmail($email);
        $customer->setPassword($password);
        $customer->setCode($code);
        $customer->setAuthToken($authToken);
        $customer->setIdSubscription($idSubscription);

        return $customer;
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param mixed $authToken
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
    }

    /**
     * @return mixed
     */
    public function getIdSubscription()
    {
        return $this->idSubscription;
    }

    /**
     * @param mixed $idSubscription
     */
    public function setIdSubscription($idSubscription)
    {
        $this->idSubscription = $idSubscription;
    }

}