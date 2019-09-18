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
    const TOKEN_LENGTH = 50;

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
            $req->bindValue(":p", password_hash($admin->getPassword(), PASSWORD_BCRYPT), PDO::PARAM_STR);
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
            $req->bindValue(":p", password_hash($admin->getPassword(), PASSWORD_BCRYPT), PDO::PARAM_STR);
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

    /**
     * @param string $login
     * @param string $password
     * @return null
     */
    public function login(string $login, string $password) {
        try {
            $statement = sprintf("SELECT %s, %s FROM `%s` WHERE %s = :l",
                AdminSchema::ID, AdminSchema::PASSWORD, AdminSchema::TABLE, AdminSchema::LOGIN);
            $req = $this->db->prepare($statement);

            $req->bindValue(":l", $login, PDO::PARAM_STR);
            $req->execute();

            $data = $req->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $data[AdminSchema::PASSWORD])) {
                $result = [];
                $result[AdminSchema::ID] = $data[AdminSchema::ID];

                $req->closeCursor();

                try {
                    $token = bin2hex(random_bytes(static::TOKEN_LENGTH));
                    $result[AdminSchema::TOKEN] = $token;
                    $statement = sprintf("UPDATE `%s` SET %s = :t WHERE %s = :i",
                        AdminSchema::TABLE,
                        AdminSchema::TOKEN,
                        AdminSchema::ID);
                    $req = $this->db->prepare($statement);

                    $req->bindValue(":t", $token, PDO::PARAM_STR);
                    $req->bindValue(":i", $result[AdminSchema::ID], PDO::PARAM_INT);
                    $req->execute();
                    $req->closeCursor();

                    return $result;
                } catch (Exception $e) {
                    echo $e;

                    return null;
                }
            } else {
                $req->closeCursor();

                return null;
            }
        } catch (PDOException $e) {
            echo $e;

            return null;
        }
    }

    public function checkToken(int $id, string $token) {
        try {
            $statement = sprintf("SELECT * FROM `%s` WHERE %s = :i AND %s = :t",
                AdminSchema::TABLE,
                AdminSchema::ID,
                AdminSchema::TOKEN);
            $req = $this->db->prepare($statement);

            $req->bindValue(":i", $id, PDO::PARAM_INT);
            $req->bindValue(":t", $token, PDO::PARAM_STR);
            $req->execute();

            $valid = $req->fetch(PDO::FETCH_ASSOC) != false;

            $req->closeCursor();

            return $valid;
        } catch (PDOException $e) {
            echo $e;

            return false;
        }
    }

}
