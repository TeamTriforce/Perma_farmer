<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

/**
 * Class ArticleDao
 */
class ArticleDao extends AbstractDao
{
    /**
     * @param Article $article
     * @return bool
     */
    public function create(Article $article)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s) VALUES (?, ?, ?)",
                ArticleSchema::TABLE,
                ArticleSchema::TITLE,
                ArticleSchema::CONTENT,
                ArticleSchema::IMAGE);
            $req = $this->db->prepare($statement);

            $req->execute($article->toArray(true));
            $req->closeCursor();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return null|Product
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                ArticleSchema::TABLE,
                ArticleSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();
        } catch (PDOException $e) {
            return null;
        }

        return new Product($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", ArticleSchema::TABLE, ArticleSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function update(Article $article)
    {
        try {
            $statement = sprintf("UPDATE `%s` SET %s = :t, %s = :c, %s = :img WHERE %s = :i",
                ArticleSchema::TABLE,
                ArticleSchema::TITLE,
                ArticleSchema::CONTENT,
                ArticleSchema::IMAGE,
                ArticleSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":t", $article->getTitle(), PDO::PARAM_STR);
            $req->bindValue(":c", $article->getContent(), PDO::PARAM_INT);
            $req->bindValue(":img", $article->getImage(), PDO::PARAM_STR);
            $req->bindValue(":i", $article->getId(), PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @return array|null
     */
    public function queryAll() {
        try {
            $articles = [];
            $statement = sprintf("SELECT * FROM `%s`",
                ArticleSchema::TABLE);
            $req = $this->db->exec($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $articles[] = new Article($key);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            return null;
        }

        return $articles;
    }

}
