<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.03.2017
 * Time: 17:50
 */
namespace Acme\Controller;

use Acme\Entity\User;
use Acme\Helper\ClientDataParser;
use App\Controller;
use Acme\Data\DataStore;
use Acme\Helper\SendMail;

/**
 * Class IndexController
 * @package Acme\Controller
 */
class UserController extends Controller
{
    /**
     * @var DataStore $dataStore
     */
    private $dataStore;

    /**
     * @var ClientDataParser $parser
     */
    private $parser;

    /**
     * @var SendMail $sendMail
     */
    private $sendMail;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->dataStore = new DataStore();

        $this->parser = new ClientDataParser();

        $logData = $this->dataStore->getLogData();

        $this->sendMail = new SendMail($logData);
    }

    /**
     * Alex action
     *
     * @param $id int
     * @return bool
     */
    public function alexAction($id)
    {
        $user = $this->dataStore->getUserData()->getItemByName('Alexey');

        $userId = (int) $user->id;

        $clientList = $this->dataStore->getClientData()->getItemByUserId($userId);

        $template = $this->dataStore->getTemplateData()->getItemByTypeUserId($id, $userId);

        if ($template && $clientList) {
            foreach ($clientList as $clientItem) {

                $mailMessage = $this->parser->parseMail($clientItem, $template);

                $this->sendMail->send($user, $clientItem, $mailMessage);
            }
        }

        return true;
    }

    /**
     * Yuriy action
     *
     * @param $id int
     * @return bool
     */
    public function yuriyAction($id)
    {
        $user = $this->dataStore->getUserData()->getItemByName('Yuriy');

        $userId = (int) $user->id;

        $clientList = $this->dataStore->getClientData()->getItemByUserId($userId);

        $template = $this->dataStore->getTemplateData()->getItemByTypeUserId($id, $userId);

        if ($template && $clientList) {
            foreach ($clientList as $clientItem) {

                $mailMessage = $this->parser->parseMail($clientItem, $template);

                $this->sendMail->send($user, $clientItem, $mailMessage);
            }

        }

        return true;
    }
}