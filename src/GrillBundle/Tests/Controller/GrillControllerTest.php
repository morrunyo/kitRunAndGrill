<?php

namespace GrillBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GrillControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testActivate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/activate');
    }

}
