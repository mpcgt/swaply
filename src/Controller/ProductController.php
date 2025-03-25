<?php

namespace App\Controller;

use App\Entity\Alternatives;
use App\Entity\Products;
use App\Entity\Reviews;
use App\Form\ProductsFormType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

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
        $alternatives = $entityManager->getRepository(Alternatives::class)->findBy(['product' => $id]);
        $reviews = $entityManager->getRepository(Reviews::class)->findBy(['product' => $id]);
        $products = $productsRepository->findBy(['id' => $id]);

        if (!$id) {
            throw $this->createNotFoundException('Page introuvable.');
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'reviews' => $reviews,
            'alternatives' => $alternatives,
            'token' => $token
        ]);
    }

    #[Route('/add', name: 'add_products')]
    public function add(EntityManagerInterface $em, SluggerInterface $slugger, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $products = new Products();
        $productsform = $this->createForm(ProductsFormType::class, $products);
        $productsform->handleRequest($request);

        if($productsform->isSubmitted() && $productsform->isValid()) {
            $em->persist($products);
            $em->flush();

            $this->addFlash('bg-green-500 text-white text-center py-4', 'Site/application publié avec succès ! 😎');

            return $this->redirectToRoute('products_list');
        }

        return $this->render('products/add.html.twig', [
            'token' => $token,
            'products' => $products,
            'productsform' => $productsform->createView()
        ]);
    }
}
