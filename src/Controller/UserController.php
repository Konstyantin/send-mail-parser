<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.03.2017
 * Time: 17:50
 */
namespace Acme\Controller;

use Acme\Entity\Interest;
use Acme\Entity\User;
use Acme\Entity\UserInterest;
use Acme\Model\User\RegisterValidation;
use App\Controller;
use App\Db;
use App\FormData;
use App\QueryData;

/**
 * Class IndexController
 * @package Acme\Controller
 */
class UserController extends Controller
{
    /**
     * Alex action
     *
     * @param $id
     * @return bool
     */
    public function alexAction($id)
    {
        return true;
    }

    /**
     * Yuriy action
     *
     * @param $id
     * @return bool
     */
    public function yuriyAction($id)
    {
        return true;
    }
}