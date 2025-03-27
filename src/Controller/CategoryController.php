<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')] // Route pour la page principale des catégories
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        return $this->render('category/index.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }

    #[Route('/category/browser', name: 'app_category_browser')] // Route pour la catégorie "browser"
    public function browser(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 2]); // Récupère les produits de la catégorie 2 (browser)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/browser.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/communication', name: 'app_category_communication')] // Route pour la catégorie "communication"
    public function communication(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 4]); // Récupère les produits de la catégorie 4 (communication)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/communication.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/entertainment', name: 'app_category_entertainment')] // Route pour la catégorie "entertainment"
    public function entertainment(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 5]); // Récupère les produits de la catégorie 5 (entertainment)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
     
        return $this->render('category/entertainment.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/productivity', name: 'app_category_productivity')] // Route pour la catégorie "productivity"
    public function productivity(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 6]); // Récupère les produits de la catégorie 6 (productivity)
        $templates = '';
        $full_stack = '';
    
        return $this->render('category/productivity.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/social-media', name: 'app_category_social_media')] // Route pour la catégorie "social-media"
    public function social_media(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 1]); // Récupère les produits de la catégorie 1 (social-media)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/social-media.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/online-services', name: 'app_category_online_services')] // Route pour la catégorie "online-services"
    public function online_services(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => [3, 7, 8]]); // Récupère les produits des catégories 3, 7, 8 (online-services)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/online-services.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/dev', name: 'app_category_dev')] // Route pour la catégorie "dev"
    public function dev(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => [8, 9, 12]]); // Récupère les produits des catégories 8, 9, 12 (dev)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/dev.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/app', name: 'app_category_app')] // Route pour la catégorie "app"
    public function app(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 10]); // Récupère les produits de la catégorie 10 (app)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/app.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    #[Route('/category/games', name: 'app_category_games')] // Route pour la catégorie "games"
    public function games(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findBy(['category' => 11]); // Récupère les produits de la catégorie 11 (games)
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('category/games.html.twig', [ // Le template Twig
            'controller_name' => 'CategoryController',
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
    
}