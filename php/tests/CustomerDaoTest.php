<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 15:42
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

class CustomerDaoTest extends \PHPUnit\Framework\TestCase
{
    private $dao;

    private $entity;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dao = new CustomerDao();
        $this->entity = Customer::newInstance(0, "testFirstName", "testLastName", "testEmail", "testPassword");
    }

    public function testRead()
    {
        $this->dao->create($this->entity);

        $customer = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getFirstName(), $customer->getFirstName());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getLastName(), $customer->getLastName());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getEmail(), $customer->getEmail());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getPassword(), $customer->getPassword());

        $this->dao->delete($customer->getId());
    }

    public function testCreate()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->dao->delete($this->entity->getId());
    }

    public function testQueryAll()
    {
        $customers = [];

        for ($i = 0; $i < 5; $i++) {
            $customer = Customer::newInstance($i, "FirstName" . $i, "LastName" . $i, "Email" . $i, "Password" . $i);

            $this->dao->create($customer);

            $customers[] = $customer;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($customers[$i]->getId());
        }
    }

    public function testUpdate()
    {
        $this->dao->create($this->entity);

        $this->entity->setFirstName("newFirstName");
        $this->entity->setLastName("newLastName");
        $this->entity->setEmail("newEmail");
        $this->entity->setPassword("newPassword");

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $customer = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals("newFirstName", $customer->getFirstName());
        \PHPUnit\Framework\Assert::assertEquals("newLastName", $customer->getLastName());
        \PHPUnit\Framework\Assert::assertEquals("newEmail", $customer->getEmail());
        \PHPUnit\Framework\Assert::assertEquals("newPassword", $customer->getPassword());

        $this->dao->delete($this->entity->getId());
    }

    public function testDelete()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));
    }
}
