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
     * @param $client
     * @param $template
     * @param string $status
     * @return \PDOStatement
     */
    public function addLogItem($user, $client, $template, $status = 'success')
    {
        $db = Db::connect();

        $sql = 'INSERT INTO logs (`from`, `to`, `subject`, `body`, `date`, `status`) VALUES (:from, :to, :subject, :body, UNIX_TIMESTAMP(), :status)';

        $query = $db->prepare($sql);

        $query->bindParam(':from', $user->email, PDO::PARAM_STR);
        $query->bindParam(':to', $client->email, PDO::PARAM_STR);
        $query->bindParam(':subject', $template['subject'], PDO::PARAM_STR);
        $query->bindParam(':body', $template['body'], PDO::PARAM_STR);
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