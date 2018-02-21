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
use Acme\Helper\CronMail;
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
     * @var CronMail $cronMail
     */
    private $cronMail;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->dataStore = new DataStore();

        $this->parser = new ClientDataParser();

        $logData = $this->dataStore->getLogData();

        $cronData = $this->dataStore->getCronData();

        $this->sendMail = new SendMail($logData);

        $this->cronMail = new CronMail($cronData);
    }

    /**
     * Alex action
     *
     * Send mail from Alex mail to Alex clients
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

                $this->cronMail->register($user, $clientItem, $mailMessage);
            }
        }

        return true;
    }

    /**
     * Yuriy action
     *
     * Send mail from Yuriy mail to Yuriy clients
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

                $this->cronMail->register($user, $clientItem, $mailMessage);
            }
        }

        return true;
    }

    /**
     * Andrew action
     *
     * Send mail from Andrew mail to Andrew clients
     *
     * @param $id int
     * @return bool
     */
    public function andrewAction($id)
    {
        $user = $this->dataStore->getUserData()->getItemByName('Andrew');

        $userId = (int) $user->id;

        $clientList = $this->dataStore->getClientData()->getItemByUserId($userId);

        $template = $this->dataStore->getTemplateData()->getItemByTypeUserId($id, $userId);

        if ($template && $clientList) {
            foreach ($clientList as $clientItem) {

                $mailMessage = $this->parser->parseMail($clientItem, $template);

                $this->cronMail->register($user, $clientItem, $mailMessage);
            }
        }

        return true;
    }

    /**
     * Client action
     *
     * @return bool
     */
    public function clientAction()
    {
        $path = "uploads/";

        if (!empty($_FILES['uploaded_file'])) {

            $path = $path . basename($_FILES['uploaded_file']['name']);

            if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                echo "The file " . basename($_FILES['uploaded_file']['name']) . " has been uploaded";

                if (($handle = fopen($path, "r")) !== false) {

                    $columnList = [];

                    $dataList = [];

                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        if (empty($columnList)) {
                            foreach ($data as $item) {
                                $columnList[] = $item;
                            }
                        } else {
                            $client = [];
                            foreach ($data as $key => $value) {
                                $client[$columnList[$key]] = $value;
                            }

                            $dataList[] = $client;
                        }
                    }

                    $this->dataStore->getClientData()->deleteList();

                    $this->dataStore->getClientData()->createList($dataList);

                    fclose($handle);

                    unlink($path);
                }
            } else {
                echo "There was an error uploading the file, please try again!";
            }
        }

        return $this->render('user/client');
    }

    /**
     * Cron Action
     */
    public function cronAction()
    {
        $time = time();

        $cronRecord = $this->dataStore->getCronData()->getFirstRecord();

        if ($cronRecord->action_time < $time) {

            $userEmail = $cronRecord->from;

            $user = $this->dataStore->getUserData()->getItemByEmail($userEmail);

            $this->sendMail->send($user, $cronRecord);

            $this->dataStore->getCronData()->setSenderStatus($cronRecord->id);

            $cronRecord = $this->dataStore->getCronData()->getFirstRecord();

            $actionTime = $this->cronMail->generateActionTime();

            $this->dataStore->getCronData()->changeActionTime($cronRecord->id, $actionTime);
        }
    }
}