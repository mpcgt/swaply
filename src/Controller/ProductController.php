<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'products_list')]
    public function index(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = $productsRepository->findAll();

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'token' => $token
        ]);
    }

    #[Route('/products/{id}', name: 'app_products', methods:['GET', 'POST'])]
    public function products(int $id, ProductsRepository $productsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $id = $entityManager->getRepository(Products::class)->find($id);
        $products = $productsRepository->findBy(['id' => $id]);

        if (!$id) {
            throw $this->createNotFoundException('Page introuvable.');
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'token' => $token
        ]);
    }
}
