<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    #[Route('/category/browser', name: 'app_category')]
    public function browser(): Response
    {
        return $this->render('category/browser.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
