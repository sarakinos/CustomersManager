<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/10/2015
 * Time: 11:48 πμ
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testRenderingIndexPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $heading = $crawler->filter('h2')->eq(0)->text();
        $this->assertEquals('Customer Manager', $heading);
    }

    public function testNavigationCustomersButton()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Customers')->link();
        $crawler = $client->click($link);
        $this->assertContains('Customers Managment - Index', $client->getResponse()->getContent());
    }
}
