<?php

namespace App\Controller;

use App\DashboardService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        $dashboardService = new DashboardService($em);
        $statistics = $dashboardService->getDashboardStatistics();
        return $this->render('home.html.twig', [
            'statistics' => $statistics
        ]);
    }
}
