<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class AllController extends AbstractController
{
    #[Route('/all', name: 'app_all')]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        return $this->render('all/index.html.twig', [
            'controller_name' => 'AllController',
            'token' => $token
        ]);
    }
}
