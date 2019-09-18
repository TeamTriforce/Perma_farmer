<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 15:42
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

class ProductDaoTest extends \PHPUnit\Framework\TestCase
{
    private $dao;

    private $entity;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dao = new ProductDao();
        $this->entity = Product::newInstance(0, "testLabel", 10000, 0, "testImage", 10);
    }

    public function testRead()
    {
        $this->dao->create($this->entity);

        $customer = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getLabel(), $customer->getLabel());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getPrice(), $customer->getPrice());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getQuantity(), $customer->getQuantity());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getImage(), $customer->getImage());

        $this->dao->delete($customer->getId());
    }

    public function testCreate()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->dao->delete($this->entity->getId());
    }

    public function testQueryAll()
    {
        $products = [];

        for ($i = 0; $i < 5; $i++) {
            $product = Product::newInstance($i, "Label" . $i, $i, $i, "Image" . $i, $i);

            $this->dao->create($product);

            $products[] = $product;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($products[$i]->getId());
        }
    }

    public function testUpdate()
    {
        $this->dao->create($this->entity);

        $this->entity->setLabel("newLabel");
        $this->entity->setPrice(666);
        $this->entity->setImage("newImage");
        $this->entity->setStock(1);

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $customer = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals("newLabel", $customer->getLabel());
        \PHPUnit\Framework\Assert::assertEquals(666, $customer->getPrice());
        \PHPUnit\Framework\Assert::assertEquals("newImage", $customer->getImage());
        \PHPUnit\Framework\Assert::assertEquals(1, $customer->getStock());

        $this->dao->delete($this->entity->getId());
    }

    public function testDelete()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));
    }
}
