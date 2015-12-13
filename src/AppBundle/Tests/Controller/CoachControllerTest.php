<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoachControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/coach/view/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/coach/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/coach/view/Ukraine1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testView()
    {
        $client = static::createClient();

        $client->request('GET', '/coach/view/Ukraine/Shewchenko1');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/coach/view/Ukraine/Shewchenko/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
