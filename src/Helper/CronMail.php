<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2018
 * Time: 12:54
 */

namespace Acme\Helper;

use Acme\Entity\Cron;

/**
 * Class CronMail
 * @package Acme\Helper
 */
class CronMail
{
    /**
     * @var Cron $cron
     */
    private $cron;

    /**
     * CronMail constructor.
     * @param Cron $cron
     */
    public function __construct(Cron $cron)
    {
        $this->cron = $cron;
    }

    /**
     * Register
     *
     * @param $user
     * @param $client
     * @param $template
     */
    public function register($user, $client, $template)
    {
        $this->cron->addCronItem($user, $client, $template);
    }
}