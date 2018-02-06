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

/**
 * Class SendMail
 * @package Acme\Helper
 */
class SendMail
{
    /**
     * @var string $host
     */
    private $host = 'localhost';

    /**
     * @var int $port
     */
    private $port = 25;

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
     * @param $client
     * @param $template
     */
    public function send($user, $client, $template)
    {
        $transport = $this->setConfiguration($user);

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($template['subject']))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo(['kostyannagula@gmail.com'])
            ->setBody($template['body'])
        ;

        $result = $mailer->send($message);
    }
}
