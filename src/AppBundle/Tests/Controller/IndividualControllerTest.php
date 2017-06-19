<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndividualControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/individual');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/individual/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/individual/edit/{id}');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/individual/list');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/individual/show/{id}');
    }

    public function testImport()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/individual/import');
    }

}
