<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.02.2018
 * Time: 19:16
 */

namespace Acme\Helper;

use Acme\Entity\Client;
use Acme\Entity\Template;

/**
 * Class ClientDataParser
 * @package Acme\Helper
 */
class ClientDataParser
{
    /**
     * Parse mail
     *
     * @param $client
     * @param $template
     * @return array
     */
    public function parseMail($client, $template)
    {
        $result = [];

        $clientName = $client->name;
        $clientCompany = $client->company;

        $templateSubjectReplace = str_replace('[Name]', $clientName, $template->subject);
        $templateSubjectReplace = str_replace('[Company]', $clientCompany, $templateSubjectReplace);
        $templateBodyReplace = str_replace('[Name]', $clientName, $template->body);
        $templateBodyReplace = str_replace('[Company]', $clientCompany, $templateBodyReplace);

        $result['subject'] = $templateSubjectReplace;
        $result['body'] = $templateBodyReplace;

        return $result;
    }

}