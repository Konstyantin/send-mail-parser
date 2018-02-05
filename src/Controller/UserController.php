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
     * UserController constructor.
     */
    public function __construct()
    {
        $this->dataStore = new DataStore();

        $this->parser = new ClientDataParser();
    }

    /**
     * Alex action
     *
     * @param $id int
     * @return bool
     */
    public function alexAction($id)
    {
        $client = $this->dataStore->getClientData()->getItemById(1);

        $template = $this->dataStore->getTemplateData()->getItemByType('2nd Reach Out');

        $mail = $this->parser->parseMail($client, $template);

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
        return true;
    }
}