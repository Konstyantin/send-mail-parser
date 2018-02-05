<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 30.03.17
 * Time: 22:10
 */
namespace Acme\Entity;

use PDO;
use App\Db;

/**
 * Class User
 * @package Acme\Entity
 */
class User
{
    /**
     * Get list users
     *
     * Get list all exists user in database
     *
     * @return array
     */
    public function getList()
    {
        $db = Db::connect();

        $sql = "SELECT * FROM user";

        $query = $db->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get item by email
     *
     * @param string $email
     * @return array
     */
    public function getItemByEmail(string $email)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM user WHERE email = :email";

        $query = $db->prepare($sql);

        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get item by name
     *
     * @param string $name
     * @return array
     */
    public function getItemByName(string $name)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM user WHERE name = :name";

        $query = $db->prepare($sql);

        $query->bindParam(':name', $name, PDO::PARAM_STR);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}