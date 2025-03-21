<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'token' => $token
        ]);
    }

    #[Route('/category/browser', name: 'app_category_browser')]
    public function browser(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 2]);
    
        return $this->render('category/browser.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/communication', name: 'app_category_communication')]
    public function communication(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 4]);
    
        return $this->render('category/communication.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/entertainment', name: 'app_category_entertainment')]
    public function entertainment(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 5]);
    
        return $this->render('category/entertainment.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/productivity', name: 'app_category_productivity')]
    public function productivity(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 6]);
    
        return $this->render('category/productivity.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/social-media', name: 'app_category_social_media')]
    public function social_media(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 1]);
    
        return $this->render('category/social-media.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/online-services', name: 'app_category_online_services')]
    public function online_services(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => [3, 7, 8]]);
    
        return $this->render('category/online-services.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/dev', name: 'app_category_dev')]
    public function dev(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => [8, 9, 12]]);
    
        return $this->render('category/dev.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/app', name: 'app_category_app')]
    public function app(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 10]);
    
        return $this->render('category/app.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    #[Route('/category/games', name: 'app_category_games')]
    public function games(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findBy(['category' => 11]);
    
        return $this->render('category/games.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
            'token' => $token
        ]);
    }
    
}