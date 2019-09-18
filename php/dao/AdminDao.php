<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 11:09
 */

require_once "AbstractDao.php";
include(dirname(__FILE__) . "/../schemas/AdminSchema.php");

/**
 * Class AdminDao
 */
class AdminDao extends AbstractDao
{
    /**
     * @param Admin $admin
     * @return bool
     */
    public function create(Admin $admin)
    {
        try {
            $statement = sprintf("INSERT INTO `%s` (%s, %s, %s) VALUES (:l, :p, :t)",
                AdminSchema::TABLE,
                AdminSchema::LOGIN,
                AdminSchema::PASSWORD,
                AdminSchema::TOKEN);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $admin->getLogin(), PDO::PARAM_STR);
            $req->bindValue(":p", $admin->getPassword(), PDO::PARAM_STR);
            $req->bindValue(":t", $admin->getAuthToken(), PDO::PARAM_STR);
            $req->execute();
            $admin->setId($this->db->lastInsertId());
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return Admin|null
     */
    public function read(int $id)
    {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i",
                AdminSchema::TABLE,
                AdminSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return new Admin($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        try {
            $statement = sprintf("DELETE FROM `%s` WHERE %s = :i", AdminSchema::TABLE, AdminSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function update(Admin $admin)
    {
        try {
            $statement = sprintf("UPDATE `%s` SET %s = :l, %s = :p, %s = :t WHERE %s = :i",
                AdminSchema::TABLE,
                AdminSchema::LOGIN,
                AdminSchema::PASSWORD,
                AdminSchema::TOKEN,
                AdminSchema::ID);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $admin->getLogin(), PDO::PARAM_STR);
            $req->bindValue(":p", $admin->getPassword(), PDO::PARAM_STR);
            $req->bindValue(":t", $admin->getAuthToken(), PDO::PARAM_STR);
            $req->bindValue(":i", $admin->getId(), PDO::PARAM_STR);
            $req->execute();
            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return false;
        }

        return true;
    }

    /**
     * @return array|null
     */
    public function queryAll() {
        try {
            $admins = [];
            $statement = sprintf("SELECT * FROM `%s`",
                AdminSchema::TABLE);
            $req = $this->db->query($statement);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $key) {
                $admins[] = new Admin($key);
            }

            $req->closeCursor();
        } catch (PDOException $e) {
            echo $e;

            return null;
        }

        return $admins;
    }

}
