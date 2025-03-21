<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'token' => $token
        ]);
    }
}
