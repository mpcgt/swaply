<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');

        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'token' => $token
        ]);
    }
}
