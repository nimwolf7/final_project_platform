<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $dbWorking = false;
        try {
            $conn = $this->container->get('doctrine.dbal.default_connection');
            // Run a simple query to check DB connection
            $conn->executeQuery('SELECT 1');
            $dbWorking = true;
        } catch (\Throwable $e) {
            $dbWorking = false;
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'db_working' => $dbWorking,
        ]);
    }
}
