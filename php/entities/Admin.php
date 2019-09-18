<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 14:37
 */

require_once "AbstractEntity.php";

class Admin extends AbstractEntity
{

    private $id;

    private $login;

    private $password;

    private $authToken;

    /**
     *
     * @param $id
     * @param $login
     * @param $password
     * @param $authToken
     * @return Admin
     */
    public static function newInstance($id, $login, $password, $authToken)
    {
        $admin = new Admin([]);

        $admin->setId($id);
        $admin->setLogin($login);
        $admin->setPassword($password);
        $admin->setAuthToken($authToken);

        return $admin;
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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
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

}