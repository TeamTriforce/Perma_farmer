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

        $this->dao = new CustomerDao(true);
        $this->entity = Customer::newInstance(0, "testFirstName", "testLastName", "testEmail", "testPassword", "testCode", "testToken", 0);
    }

    public function testRead()
    {
        $this->initRelated();
        $this->dao->create($this->entity);

        $customer = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getFirstName(), $customer->getFirstName());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getLastName(), $customer->getLastName());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getEmail(), $customer->getEmail());
        \PHPUnit\Framework\Assert::assertTrue(password_verify($this->entity->getPassword(), $customer->getPassword()));
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getAuthToken(), $customer->getAuthToken());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getIdSubscription(), $customer->getIdSubscription());

        $this->dao->delete($customer->getId());
        $this->deleteRelated();
    }

    public function testCreate()
    {
        $this->initRelated();

        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->dao->delete($this->entity->getId());
        $this->deleteRelated();
    }

    public function testQueryAll()
    {
        $subscriptionDao = new SubscriptionDao(true);
        $customers = [];

        for ($i = 0; $i < 5; $i++) {
            $subscription = Subscription::newInstance($i, "label" . $i, 666, 999);

            $subscriptionDao->create($subscription);

            $customer = Customer::newInstance($i, "FirstName" . $i, "LastName" . $i, "Email" . $i, "Password" . $i, "Code" . $i, "Token" . $i, $subscription->getId());

            $this->dao->create($customer);

            $customers[] = $customer;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($customers[$i]->getId());
            $subscriptionDao->delete($customers[$i]->getIdSubscription());
        }
    }

    public function testUpdate()
    {
        $subscriptionDao = new SubscriptionDao(true);

        $this->initRelated();
        $this->dao->create($this->entity);

        $newSubscription = Subscription::newInstance(1, "newLabel", 999, 3173);
        $oldSubscriptionId = $this->entity->getIdSubscription();

        $subscriptionDao->create($newSubscription);

        $this->entity->setFirstName("newFirstName");
        $this->entity->setLastName("newLastName");
        $this->entity->setEmail("newEmail");
        $this->entity->setPassword("newPassword");
        $this->entity->setCode("newCode");
        $this->entity->setAuthToken("newToken");
        $this->entity->setIdSubscription($newSubscription->getId());

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $customer = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals("newFirstName", $customer->getFirstName());
        \PHPUnit\Framework\Assert::assertEquals("newLastName", $customer->getLastName());
        \PHPUnit\Framework\Assert::assertEquals("newEmail", $customer->getEmail());
        \PHPUnit\Framework\Assert::assertTrue(password_verify($this->entity->getPassword(), $customer->getPassword()));
        \PHPUnit\Framework\Assert::assertEquals("newCode", $customer->getCode());
        \PHPUnit\Framework\Assert::assertEquals("newToken", $customer->getAuthToken());
        \PHPUnit\Framework\Assert::assertEquals($newSubscription->getId(), $customer->getIdSubscription());

        $this->dao->delete($this->entity->getId());
        $this->deleteRelated();
        $subscriptionDao->delete($oldSubscriptionId);
    }

    public function testDelete()
    {
        $this->initRelated();

        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));

        $this->deleteRelated();
    }

    public function testLogin() {
        $this->initRelated();

        $this->dao->create($this->entity);
        $idData = $this->dao->login($this->entity->getEmail(), $this->entity->getPassword());

        \PHPUnit\Framework\Assert::assertTrue($idData != null);

        $entity = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($entity->getId(), $idData[CustomerSchema::ID]);
        \PHPUnit\Framework\Assert::assertEquals($entity->getAuthToken(), $idData[CustomerSchema::TOKEN]);

        $this->dao->delete($this->entity->getId());
        $this->deleteRelated();
    }

    private function initRelated() {
        $subscriptionDao = new SubscriptionDao(true);
        $subscription = Subscription::newInstance(1, "label", 100, 8);

        $subscriptionDao->create($subscription);

        $this->entity->setIdSubscription($subscription->getId());
    }

    private function deleteRelated() {
        $subscriptionDao = new SubscriptionDao(true);

        $subscriptionDao->delete($this->entity->getIdSubscription());
    }

}
