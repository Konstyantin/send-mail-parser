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

class Cron
{
    public function addCronItem($user, $client, $template, $status = 'success')
    {
        $db = Db::connect();

        $userFullName = $user->first_name . ' ' . $user->last_name;

        $sql = 'INSERT INTO cron (`full_name`, `from`, `to`, `subject`, `body`, `date`, `status`) VALUES (:full_name, :from, :to, :subject, :body, UNIX_TIMESTAMP(), :status)';

        $query = $db->prepare($sql);

        $query->bindParam(':full_name', $userFullName, PDO::PARAM_STR);
        $query->bindParam(':from', $user->email, PDO::PARAM_STR);
        $query->bindParam(':to', $client->email, PDO::PARAM_STR);
        $query->bindParam(':subject', $template['subject'], PDO::PARAM_STR);
        $query->bindParam(':body', $template['body'], PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        $query->execute();

        return $query;
    }
}