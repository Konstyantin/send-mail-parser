<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2018
 * Time: 12:40
 */

namespace Acme\Entity;

use PDO;
use App\Db;

/**
 * Class Cron
 * @package Acme\Entity
 */
class Cron
{
    /**
     * @var int $action_time
     */
    private $action_time = 0;

    /**
     * @var int $status
     */
    private $status = 0;

    /**
     * Add cron item
     *
     * Add cron m
     *
     * @param $user
     * @param $client
     * @param $template
     * @return \PDOStatement
     */
    public function addCronItem($user, $client, $template)
    {
        $db = Db::connect();

        $userFullName = $user->first_name . ' ' . $user->last_name;

        $actionTime = (int) $this->action_time;

        $status = (int) $this->status;

        $sql = "INSERT INTO cron (`full_name`, `from`, `to`, `subject`, `body`, `action_time`, `status`) VALUES (:full_name, :from, :to, :subject, :body, UNIX_TIMESTAMP(), :status)";

        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

        $query = $db->prepare($sql);

        $query->bindParam(':full_name', $userFullName, PDO::PARAM_STR);
        $query->bindParam(':from', $user->email, PDO::PARAM_STR);
        $query->bindParam(':to', $client->email, PDO::PARAM_STR);
        $query->bindParam(':subject', $template['subject'], PDO::PARAM_STR);
        $query->bindParam(':body', $template['body'], PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_INT);

        $query->execute();

        return $query;
    }
}