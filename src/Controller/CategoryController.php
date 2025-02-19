<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/browser', name: 'app_category_browser')]
    public function browser(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 2]);
    
        return $this->render('category/browser.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/communication', name: 'app_category_communication')]
    public function communication(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 10]);
    
        return $this->render('category/communication.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/entertainment', name: 'app_category_entertainment')]
    public function entertainment(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 6]);
    
        return $this->render('category/entertainment.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/productivity', name: 'app_category_productivity')]
    public function productivity(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 8]);
    
        return $this->render('category/productivity.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/social-media', name: 'app_category_social_media')]
    public function social_media(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 1]);
    
        return $this->render('category/social-media.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/online-services', name: 'app_category_online_services')]
    public function online_services(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => [3, 4, 7, 11]]);
    
        return $this->render('category/online-services.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/dev', name: 'app_category_dev')]
    public function dev(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => [3, 12]]);
    
        return $this->render('category/dev.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/app', name: 'app_category_app')]
    public function app(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 0]);
    
        return $this->render('category/app.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    #[Route('/category/games', name: 'app_category_games')]
    public function games(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findBy(['category' => 0]);
    
        return $this->render('category/games.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $products,
        ]);
    }
    
}