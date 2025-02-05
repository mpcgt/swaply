<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AllController extends AbstractController
{
    #[Route('/all', name: 'app_all')]
    public function index(): Response
    {
        return $this->render('all/index.html.twig', [
            'controller_name' => 'AllController',
        ]);
    }
}
