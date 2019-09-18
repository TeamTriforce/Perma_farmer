<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 15:41
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

class SubscriptionDaoTest extends \PHPUnit\Framework\TestCase
{
    private $dao;

    private $entity;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dao = new SubscriptionDao(true);
        $this->entity = Subscription::newInstance(0, "testLabel", 10, 50);
    }

    public function testRead()
    {
        $this->dao->create($this->entity);

        $subscription = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getLabel(), $subscription->getLabel());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getPrice(), $subscription->getPrice());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getWeight(), $subscription->getWeight());

        $this->dao->delete($subscription->getId());
    }

    public function testCreate()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->dao->delete($this->entity->getId());
    }

    public function testQueryAll()
    {
        $subscriptions = [];

        for ($i = 0; $i < 5; $i++) {
            $subscription = Subscription::newInstance(0, "Label" . $i, 10, 20);

            $this->dao->create($subscription);

            $subscriptions[] = $subscription;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($subscriptions[$i]->getId());
        }
    }

    public function testUpdate()
    {
        $this->dao->create($this->entity);

        $this->entity->setLabel("newLabel");
        $this->entity->setPrice(666);
        $this->entity->setWeight(999);

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $subscription = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals("newLabel", $subscription->getLabel());
        \PHPUnit\Framework\Assert::assertEquals(666, $subscription->getPrice());
        \PHPUnit\Framework\Assert::assertEquals(999, $subscription->getWeight());

        $this->dao->delete($this->entity->getId());
    }

    public function testDelete()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));
    }
}
