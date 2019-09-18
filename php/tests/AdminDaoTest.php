<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 15:41
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

class AdminDaoTest extends \PHPUnit\Framework\TestCase
{
    private $dao;

    private $entity;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dao = new AdminDao();
        $this->entity = Admin::newInstance(0, "testLogin", "testPassword", "testToken");
    }

    public function testRead()
    {
        $this->dao->create($this->entity);

        $admin = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getLogin(), $admin->getLogin());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getPassword(), $admin->getPassword());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getAuthToken(), $admin->getAuthToken());

        $this->dao->delete($admin->getId());
    }

    public function testCreate()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->dao->delete($this->entity->getId());
    }

    public function testQueryAll()
    {
        $admins = [];

        for ($i = 0; $i < 5; $i++) {
            $admin = Admin::newInstance(0, "Login" . $i, "Password" . $i, "Token" . $i);

            $this->dao->create($admin);

            $admins[] = $admin;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($admins[$i]->getId());
        }
    }

    public function testUpdate()
    {
        $this->dao->create($this->entity);

        $this->entity->setLogin("newLogin");
        $this->entity->setPassword("newPassword");
        $this->entity->setAuthToken("newToken");

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $admin = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals("newLogin", $admin->getLogin());
        \PHPUnit\Framework\Assert::assertEquals("newPassword", $admin->getPassword());
        \PHPUnit\Framework\Assert::assertEquals("newToken", $admin->getAuthToken());

        $this->dao->delete($this->entity->getId());
    }

    public function testDelete()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));
    }
}
