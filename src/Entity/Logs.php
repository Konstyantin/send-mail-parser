<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.02.2018
 * Time: 12:19
 */

namespace Acme\Entity;

use PDO;
use App\Db;

/**
 * Class Logs
 * @package Acme\Entity
 */
class Logs
{
    /**
     * Add log item
     *
     * Create og record in database by passed user, client, templates and status values
     *
     * @param $user
     * @param $data
     * @param string $status
     * @return \PDOStatement
     */
    public function addLogItem($user, $data, $status = 'success')
    {
        $db = Db::connect();

        $sql = 'INSERT INTO logs (`from`, `to`, `subject`, `body`, `date`, `status`) VALUES (:from, :to, :subject, :body, UNIX_TIMESTAMP(), :status)';

        $query = $db->prepare($sql);

        $query->bindParam(':from', $user->email, PDO::PARAM_STR);
        $query->bindParam(':to', $data->to, PDO::PARAM_STR);
        $query->bindParam(':subject', $data->subject, PDO::PARAM_STR);
        $query->bindParam(':body', $data->body, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        $query->execute();

        return $query;
    }

    /**
     * Get list
     *
     * Get list existing log items
     *
     * @return array
     */
    public function getList()
    {
        $db = Db::connect();

        $sql = "SELECT * FROM logs";

        $query = $db->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}