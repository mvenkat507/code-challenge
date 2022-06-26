<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase {

    public function testGetOrders() : void {
        $client = static::createClient();
        $crawler = $client->getRequest('/');
        $this->assertResponseIsSuccessful();


        $response = $client->getResponse();
        $code = $response->getStatusCode();

        $this->assertResponseStatusCodeSame(200, $code);
    }
}