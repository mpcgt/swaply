<?php

namespace App\Controller;

use App\Entity\Lists;
use App\Entity\Products;
use App\Repository\ListsRepository;
use App\Repository\ProductsRepository;
use App\Repository\ListsProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class ListProductController extends AbstractController
{
    private ListsRepository $listsRepository;
    private ListsProductsRepository $listsProductsRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        ListsRepository $listsRepository,
        ListsProductsRepository $listsProductsRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->listsRepository = $listsRepository;
        $this->listsProductsRepository = $listsProductsRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/lists/{id}', name: 'lists_id', methods: ['GET', 'POST'])] // Route pour afficher une liste par son ID
    public function id(int $id, ProductsRepository $productsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $list = $this->entityManager->getRepository(Lists::class)->find($id); // Récupère la liste par son ID
        $id = $entityManager->getRepository(Products::class)->find($id); // Récupère le produit par son ID
        $lists = $this->listsRepository->findBy(['id' => $id]); // Récupère les listes associées au produit
        $products = $productsRepository->findBy(['id' => $id]); // Récupère les produits associés au produit
        $listsProducts = $this->listsProductsRepository->findAll(); // Récupère toutes les relations listes-produits
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        if (!$list) { // Si la liste n'est pas trouvée
            throw $this->createNotFoundException('Page introuvable.'); // Lance une exception 404
        }

        return $this->render('list/id.html.twig', [ // Le template Twig
            'listsProducts' => $listsProducts,
            'lists' => $lists,
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
