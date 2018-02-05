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
     * Get list users
     *
     * Get list all exists user in database
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
    public function getUserByUserId(int $id)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM clients WHERE user_id = :id";

        $query = $db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}