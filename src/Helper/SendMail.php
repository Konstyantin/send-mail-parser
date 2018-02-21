<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.02.2018
 * Time: 09:42
 */

namespace Acme\Helper;

use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;
use Acme\Entity\Logs;

/**
 * Class SendMail
 * @package Acme\Helper
 */
class SendMail
{
    /**
     * @var string $host
     */
    private $host = 'mail.codeit.com.ua';

    /**
     * @var int $port
     */
    private $port = 25;

    /**
     * @var Logs $logs
     */
    private $logs;

    /**
     * SendMail constructor.
     * @param Logs $logs
     */
    public function __construct(Logs $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Set configuration for Swift mailer smtp transport
     *
     * @return Swift_SmtpTransport
     */
    protected function setConfiguration($user)
    {
        $transport = (new Swift_SmtpTransport($this->host, $this->port))
            ->setUsername($user->email)
            ->setPassword($user->password);

        return $transport;
    }

    /**
     * Send mail
     *
     * @param $user
     * @param $data
     */
    public function send($user, $data)
    {
        $status = 'success';

        $transport = $this->setConfiguration($user);

        $mailer = new Swift_Mailer($transport);

//        var_dump($data);
//        $userFullName = $user->first_name . ' ' . $user->last_name;
//
        try {
            $message = (new Swift_Message($data->subject))
                ->setFrom([$data->from => $data->full_name])
                ->setTo($data->to)
                ->setBody($data->body)
            ;

            if (!$mailer->send($message, $failures))
            {
                $status = 'fail';
            }

            $this->logs->addLogItem($user, $data, $status);

        } catch (\Exception $e) {

            $status = 'fail';

            $this->logs->addLogItem($user, $data, $status);
        }
    }
}
