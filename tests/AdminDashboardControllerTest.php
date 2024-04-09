<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminDashboardControllerTest extends WebTestCase
{


    public function testDashboardResponse(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(302);
    }
}
