<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.02.2018
 * Time: 18:28
 */

namespace Acme\Entity;

use PDO;
use App\Db;

class Client
{
    /**
     * Get list clients
     *
     * Get list all exists clients in database
     *
     * @return array
     */
    public function getList()
    {
        $db = Db::connect();

        $sql = "SELECT * FROM clients";

        $query = $db->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get user by user id
     *
     * @param int $id
     * @return array
     */
    public function getItemByUserId(int $id)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM clients WHERE user_id = :id";

        $query = $db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get user by id
     *
     * @param int $id
     * @return array
     */
    public function getItemById(int $id)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM clients WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}