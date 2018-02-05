<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.03.2017
 * Time: 17:50
 */
namespace Acme\Controller;

use Acme\Entity\User;
use App\Controller;
use Acme\Data\DataStore;

/**
 * Class IndexController
 * @package Acme\Controller
 */
class UserController extends Controller
{
    /**
     * @var DataStore
     */
    private $dataStore;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->dataStore = new DataStore();
    }

    /**
     * Alex action
     *
     * @param $id int
     * @return bool
     */
    public function alexAction($id)
    {
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