<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 14:37
 */

require_once "AbstractEntity.php";

class Article extends AbstractEntity
{

    private $id;

    private $title;

    private $content;

    private $image;

    /**
     *
     * @param $id
     * @param $title
     * @param $content
     * @param $image
     * @return Article
     */
    public static function newInstance($id, $title, $content, $image)
    {
        $article = new Article([]);

        $article->setId($id);
        $article->setTitle($title);
        $article->setContent($content);
        $article->setImage($image);

        return $article;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

}