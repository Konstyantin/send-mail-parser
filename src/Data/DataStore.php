<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.02.2018
 * Time: 17:21
 */
namespace Acme\Data;

use Acme\Entity\Client;
use Acme\Entity\Cron;
use Acme\Entity\Logs;
use Acme\Entity\Template;
use Acme\Entity\User;

/**
 * Class DataStore
 * @package Acme\Data
 */
class DataStore
{
    /**
     * @var User $userData
     */
    private $userData;

    /**
     * @var Client $clientData
     */
    private $clientData;

    /**
     * @var Template $templateData
     */
    private $templateData;

    /**
     * @var Logs $logsData
     */
    private $logsData;

    /**
     * @var Cron $cronData
     */
    private $cronData;

    /**
     * DataStore constructor.
     */
    public function __construct()
    {
        $this->userData = new User();
        $this->logsData = new Logs();
        $this->cronData = new Cron();
        $this->clientData = new Client();
        $this->templateData = new Template();
    }

    /**
     * Get user data
     *
     * @return User
     */
    public function getUserData()
    {
        return $this->userData;
    }

    /**
     * Get client data
     *
     * @return Client
     */
    public function getClientData()
    {
        return $this->clientData;
    }

    /**
     * Get template data
     *
     * @return Template
     */
    public function getTemplateData()
    {
        return $this->templateData;
    }

    /**
     * Get log data
     *
     * @return Logs
     */
    public function getLogData()
    {
        return $this->logsData;
    }

    /**
     * Get cron data
     *
     * @return Cron
     */
    public function getCronData()
    {
        return $this->cronData;
    }
}

