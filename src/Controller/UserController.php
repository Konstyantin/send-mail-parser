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
use SimpleExcel\SimpleExcel;

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
}