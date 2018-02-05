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
     * @param string $type
     * @return array
     */
    public function getItemByType(string $type)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM template WHERE type = :type";

        $query = $db->prepare($sql);

        $query->bindParam(':type', $type, PDO::PARAM_STR);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}