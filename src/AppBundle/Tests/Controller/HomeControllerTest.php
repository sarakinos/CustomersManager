<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomePageShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Customer Manager")')->count()
        );
    }

    public function testRegisteredUsersAndAppointments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Registered")')->count()
        );
    }
}
