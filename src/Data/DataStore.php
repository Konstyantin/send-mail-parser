<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.02.2018
 * Time: 17:21
 */
namespace Acme\Data;

use Acme\Entity\Client;
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
     * DataStore constructor.
     */
    public function __construct()
    {
        $this->userData = new User();
        $this->clientData = new Client();
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
}

