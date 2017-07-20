<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LibraryControllerTest extends WebTestCase
{
    public function testMaritialstatus()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/maritial-status');
    }

    public function testMaritialstatusadd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/maritial-status-add');
    }

    public function testMaritialstatusedit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/maritial-status-edit/{id}');
    }

    public function testFiletype()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/file-type');
    }

    public function testFiletypeadd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/file-type-add');
    }

    public function testFiletypeedit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/file-type-edit/{id}');
    }

    public function testStatus()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/status');
    }

    public function testStatusadd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/status-add');
    }

    public function testStatusedit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/status-edit/{id}');
    }

    public function testDisengegementreason()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/disengegement-reason');
    }

    public function testDisengegementreasonadd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/disengegement-reason-add');
    }

    public function testDisengegementreasonedit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/library/disengegement-reason-edit/{id}');
    }

}
