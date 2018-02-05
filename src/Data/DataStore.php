<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.02.2018
 * Time: 17:21
 */
namespace Acme\Data;

use Acme\Entity\User;

/**
 * Class DataStore
 * @package Acme\Data
 */
class DataStore
{
    /**
     * @var User
     */
    private $userData;

    /**
     * DataStore constructor.
     */
    public function __construct()
    {
        $this->userData = $this->getUserList();
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
     * Get user list
     *
     * @return User
     */
    public function getUserList()
    {
        return new User();
    }
}

