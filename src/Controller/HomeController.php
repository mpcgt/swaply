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
    #[Route('/', name: 'app_home')] // Route pour la page d'accueil (racine '/')
    public function index(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['id' => [1, 2, 3, 4, 5, 6, 7, 8, 9]]); // Récupère les produits avec les IDs spécifiés
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
        $query = ''; // Initialisation variable query

        $response = $this->render('home/index.html.twig', [ // Le template Twig
            'controller_name' => 'HomeController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token,
            'query' => $query
        ]);

        $response->headers->set('X-Robots-Tag', 'noindex'); // Définit l'en-tête X-Robots-Tag à 'noindex' pour empêcher l'indexation par les moteurs de recherche

        return $response; // Retourne la réponse HTTP
    }

}