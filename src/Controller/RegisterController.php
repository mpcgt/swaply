<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

// ⚠️ ANCIENNE VERSION, CE FICHER N'EST PLUS A JOUR
final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')] // Route pour la page d'inscription
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        return $this->render('register/index.html.twig', [ // Le template Twig
            'controller_name' => 'RegisterController',
            'templates' => $templates,
            'full_stack' => $full_stack,
            'token' => $token
        ]);
    }
}
// ⚠️ ANCIENNE VERSION, CE FICHER N'EST PLUS A JOUR