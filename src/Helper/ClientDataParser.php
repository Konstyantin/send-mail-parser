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
     * @return mixed
     */
    public function parseMail($client, $template)
    {
        $template->subject = $this->parseComponent($client, $template->subject);
        $template->body = $this->parseComponent($client, $template->body);

        return $template;
    }

    /**
     * Parse component
     *
     * @param $client
     * @param string $text
     * @return mixed|string
     */
    protected function parseComponent($client, string $text)
    {
        $clientName = $client->name;
        $clientCompany = $client->company;

        $text = str_replace('[Name]', $clientName, $text);
        $text = str_replace('[Company]', $clientCompany, $text);

        return $text;
    }
}