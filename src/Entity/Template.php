<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.02.2018
 * Time: 18:36
 */

namespace Acme\Entity;

use PDO;
use App\Db;

/**
 * Class Template
 * @package Acme\Entity
 */
class Template
{
    /**
     * Get list templates
     *
     * Get list all exists templates in database
     *
     * @return array
     */
    public function getList()
    {
        $db = Db::connect();

        $sql = "SELECT * FROM template";

        $query = $db->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get item
     *
     * @param mixed $type
     * @return array
     */
    public function getItemByTypeUserId($type, $userId)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM template WHERE type = :type AND user_id = :user_id";

        $query = $db->prepare($sql);

        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get item by id
     *
     * @param int $id
     * @return mixed
     */
    public function getItemById(int $id)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM template WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}