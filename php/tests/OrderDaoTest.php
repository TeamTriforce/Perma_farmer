<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 15:42
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

class OrderDaoTest extends \PHPUnit\Framework\TestCase
{
    private $dao;

    private $entity;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dao = new OrderDao();
        $dateAvailable = new DateTime();
        $datePicked = new DateTime();
        $this->entity = Order::newInstance(0, $dateAvailable->format("Y-m-d H:i:s"), $datePicked->format("Y-m-d H:i:s"), false,
            [Product::newInstance(0, "label1", 10, 10, "img1", 1, "desc1"),
                Product::newInstance(0, "label2", 100, 100, "img2", 10, "desc2")], 1);
    }

    public function testRead()
    {
        $this->initRelated();

        $this->dao->create($this->entity);

        $order = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getAvailableDate(), $order->getAvailableDate());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getPickedDate(), $order->getPickedDate());
        \PHPUnit\Framework\Assert::assertEquals(count($this->entity->getProducts()), count($order->getProducts()));
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getNotificationSent(), $order->getNotificationSent());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getIdCustomer(), $order->getIdCustomer());

        $this->dao->delete($order->getId());
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
        $orders = [];
        $customers = [];
        $subscriptionDao = new SubscriptionDao();
        $customerDao = new CustomerDao();
        $productDao = new ProductDao();
        $prdId = 0;

        for ($i = 0; $i < 5; $i++) {
            $subscription = Subscription::newInstance($i, "Label" . $i, 20, 10);

            $subscriptionDao->create($subscription);

            $customers[] = Customer::newInstance($i, "first" . $i, "last" . $i, "mail" . $i, "password" . $i, "code" . $i, "token" . $i, $subscription->getId());

            $customerDao->create($customers[$i]);

            $dateAvailable = new DateTime();
            $datePicked = new DateTime();
            $order = Order::newInstance($i, $dateAvailable->format("Y-m-d H:i:s"), $datePicked->format("Y-m-d H:i:s"), false,
                [Product::newInstance($i, "label" . $prdId, $prdId, $prdId, "img" . $prdId, $prdId, "description")], $customers[$i]->getId());

            foreach ($order->getProducts() as $product) {
                $productDao->create($product);
            }

            $this->dao->create($order);

            $orders[] = $order;
            $prdId++;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($orders[$i]->getId());
            $customerDao->delete($customers[$i]->getId());
            $subscriptionDao->delete($customers[$i]->getIdSubscription());

            foreach ($orders[$i]->getProducts() as $product) {
                $productDao->delete($product->getId());
            }
        }
    }

    public function testUpdate()
    {
        $subscriptionDao = new SubscriptionDao();
        $customerDao = new CustomerDao();

        $this->initRelated();
        $this->dao->create($this->entity);

        $newAvailable = new DateTime;
        $newPicked = new DateTime;

        $oldSubscriptionId = $customerDao->read($this->entity->getIdCustomer())->getIdSubscription();
        $oldCustomerId = $this->entity->getIdCustomer();
        $newCustomer = Customer::newInstance(2, "newFirst", "newLast", "newMail", "newPassword", "newCode", "newToken", $oldSubscriptionId);

        $customerDao->create($newCustomer);

        $this->entity->setAvailableDate($newAvailable->format("Y-m-d H:i:s"));
        $this->entity->setPickedDate($newPicked->format("Y-m-d H:i:s"));
        $this->entity->setNotificationSent(true);
        $this->entity->setIdCustomer($newCustomer->getId());

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $order = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($newAvailable->format("Y-m-d H:i:s"), $order->getAvailableDate());
        \PHPUnit\Framework\Assert::assertEquals($newPicked->format("Y-m-d H:i:s"), $order->getPickedDate());
        \PHPUnit\Framework\Assert::assertEquals(true, $order->getNotificationSent());
        \PHPUnit\Framework\Assert::assertEquals($newCustomer->getId(), $order->getIdCustomer());

        $this->dao->delete($this->entity->getId());
        $this->deleteRelated();
        $customerDao->delete($oldCustomerId);
        $subscriptionDao->delete($oldSubscriptionId);
    }

    public function testDelete()
    {
        $this->initRelated();

        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->deleteRelated();

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));

        $this->deleteRelated();
    }

    public function testRemoveProduct()
    {
        $this->initRelated();
        $this->dao->create($this->entity);

        $this->dao->removeProduct($this->entity, $this->entity->getProducts()[0]);

        \PHPUnit\Framework\Assert::assertEquals(1, count($this->dao->read($this->entity->getId())->getProducts()));

        $this->dao->delete($this->entity->getId());
        $this->deleteRelated();
    }

    public function testAddProduct()
    {
        $productDao = new ProductDao();

        $this->initRelated();

        $this->dao->create($this->entity);

        $toAdd = Product::newInstance(0, "lbl", 1, 1, "img", 1, "description");

        $productDao->create($toAdd);

        $this->dao->addProduct($this->entity, $toAdd);

        \PHPUnit\Framework\Assert::assertEquals(3, count($this->dao->read($this->entity->getId())->getProducts()));

        $this->dao->removeProduct($this->entity, $toAdd);
        $this->dao->delete($this->entity->getId());
        $this->deleteRelated();
        $productDao->delete($toAdd->getId());
    }

    private function initRelated() {
        $subscriptionDao = new SubscriptionDao();
        $productDao = new ProductDao();
        $customerDao = new CustomerDao();
        $subscription = Subscription::newInstance(1, "label", 10, 1);

        $subscriptionDao->create($subscription);

        $customer = Customer::newInstance(1, "first", "last", "mail", "password", "code", "token", $subscription->getId());

        $customerDao->create($customer);

        $this->entity->setIdCustomer($customer->getId());

        foreach ($this->entity->getProducts() as $elt) {
            $productDao->create($elt);
        }
    }

    private function deleteRelated() {
        $subscriptionDao = new SubscriptionDao();
        $productDao = new ProductDao();
        $customerDao = new CustomerDao();
        $subscriptionId = $customerDao->read($this->entity->getIdCustomer())->getIdSubscription();

        $customerDao->delete($this->entity->getIdCustomer());
        $subscriptionDao->delete($subscriptionId);

        foreach ($this->entity->getProducts() as $elt) {
            $productDao->delete($elt->getId());
        }
    }

}
