<?php

namespace App\Tests;

use App\DashboardService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DashboardServiceTest extends KernelTestCase
{
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGetDashboardStatistics(): void
    {
        $dashboardService = new DashboardService($this->entityManager);
        $statistics = $dashboardService->getDashboardStatistics();

        $this->assertIsArray($statistics, 'Statistics should be an array');
    }
}
