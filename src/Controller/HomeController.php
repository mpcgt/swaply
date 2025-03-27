<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\SearchController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['id' => [1, 2, 3, 4, 5, 6, 7, 8, 9]]);
        $templates = '';
        $full_stack = '';
        $query = '';

        $response = $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token,
            'query' => $query
        ]);

        $response->headers->set('X-Robots-Tag', 'noindex');

        return $response;
    }

}