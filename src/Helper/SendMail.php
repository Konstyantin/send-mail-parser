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
     * @param $client
     * @param $template
     */
    public function send($user, $client, $template)
    {
        $status = 'success';

        $transport = $this->setConfiguration($user);

        $mailer = new Swift_Mailer($transport);

        try {
            $message = (new Swift_Message($template['subject']))
                ->setFrom($user->email)
                ->setTo($client->email)
                ->setBody($template['body'])
            ;

            if (!$mailer->send($message, $failures))
            {
                echo "Failures:";
                print_r($failures);
                $status = 'fail';
            }

            $this->logs->addLogItem($user, $client, $template, $status);

        } catch (\Exception $e) {

            $status = 'fail';

            $this->logs->addLogItem($user, $client, $template, $status);
        }
    }
}
