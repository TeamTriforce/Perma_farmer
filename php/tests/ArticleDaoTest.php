<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 15:41
 */

require_once dirname(__FILE__) . "/../Autoloader.php";

class ArticleDaoTest extends \PHPUnit\Framework\TestCase
{
    private $dao;

    private $entity;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dao = new ArticleDao();
        $this->entity = Article::newInstance(0, "testTitle", "testContent", "testImage");
    }

    public function testRead()
    {
        $this->dao->create($this->entity);

        $article = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals($this->entity->getTitle(), $article->getTitle());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getContent(), $article->getContent());
        \PHPUnit\Framework\Assert::assertEquals($this->entity->getImage(), $article->getImage());

        $this->dao->delete($article->getId());
    }

    public function testCreate()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        $this->dao->delete($this->entity->getId());
    }

    public function testQueryAll()
    {
        $articles = [];

        for ($i = 0; $i < 5; $i++) {
            $article = Article::newInstance(0, "Title" . $i, "Content" . $i, "Image" . $i);

            $this->dao->create($article);

            $articles[] = $article;
        }

        \PHPUnit\Framework\Assert::assertEquals(5, count($this->dao->queryAll()));

        for ($i = 0; $i < 5; $i++) {
            $this->dao->delete($articles[$i]->getId());
        }
    }

    public function testUpdate()
    {
        $this->dao->create($this->entity);

        $this->entity->setTitle("newTitle");
        $this->entity->setContent("newContent");
        $this->entity->setImage("newImage");

        \PHPUnit\Framework\Assert::assertTrue($this->dao->update($this->entity));

        $article = $this->dao->read($this->entity->getId());

        \PHPUnit\Framework\Assert::assertEquals("newTitle", $article->getTitle());
        \PHPUnit\Framework\Assert::assertEquals("newContent", $article->getContent());
        \PHPUnit\Framework\Assert::assertEquals("newImage", $article->getImage());

        $this->dao->delete($this->entity->getId());
    }

    public function testDelete()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->dao->create($this->entity));

        \PHPUnit\Framework\Assert::assertTrue($this->dao->delete($this->entity->getId()));
    }
}
