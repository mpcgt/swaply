<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class PasswordController extends AbstractController
{
    #[Route('/password', name: 'app_password')]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $templates = '';
        $full_stack = '';
        
        return $this->render('password/index.html.twig', [
            'controller_name' => 'PasswordController',
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
