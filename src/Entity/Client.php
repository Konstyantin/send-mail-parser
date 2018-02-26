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
    public function getItemById($id)
    {
        $db = Db::connect();

        $sql = "SELECT * FROM clients WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Create list records
     *
     * @param $data
     * @return \PDOStatement
     */
    public function createList($data)
    {
        $db = Db::connect();

        $queryList = $this->buildMultipleInsertQuery($data);

        $sql = "INSERT INTO clients (`name`, `email`, `company`, `user_id`) VALUES $queryList";

        $query = $db->prepare($sql);

        $query->execute();

        return $query;
    }

    /**
     * Build multiple insert query
     *
     * Build query for multiple insert record item
     *
     * @param $data
     * @return string
     */
    public function buildMultipleInsertQuery($data)
    {
        $query = '';

        foreach ($data as $item) {
            $item['name'] = str_replace("'", "''", $item['name']);
            $item['email'] = str_replace("'", "''", $item['email']);
            $item['company'] = str_replace("'", "''", $item['company']);
            $query = $query . " ('$item[name]', '$item[email]', '$item[company]', '$item[user_id]'),";
        }

        $query = rtrim($query, ',');

        return $query;
    }

    /**
     * Delete list client records
     */
    public function deleteList()
    {
        $db = Db::connect();

        $sql = "DELETE FROM clients";

        $query = $db->prepare($sql);

        $query->execute();
    }
}