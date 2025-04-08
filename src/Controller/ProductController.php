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
    #[Route('/products', name: 'products_list')] // Route pour la liste de tous les produits
    public function index(ProductsRepository $productsRepository, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $products = $productsRepository->findAll(); // Récupère tous les produits
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        return $this->render('products/index.html.twig', [ // Rend le template Twig
            'products' => $products, // Passe les produits à la vue
            'templates' => $templates,
            'full_stack' => $full_stack,
            'token' => $token
        ]);
    }

    #[Route('/products/{id}', name: 'app_products', methods: ['GET', 'POST'])] // Route pour afficher un produit par son ID
    public function products(int $id, ProductsRepository $productsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $product = $entityManager->getRepository(Products::class)->find($id); // Récupère le produit par son ID
        $alternatives = $entityManager->getRepository(Alternatives::class)->findBy(['product' => $product]); // Récupère les alternatives du produit
        $reviews = $entityManager->getRepository(Reviews::class)->findBy(['product' => $product]); // Récupère les reviews du produit
        $products = $productsRepository->findBy(['id' => $product]); // Récupère les produits
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        if (!$product) { // Si le produit n'est pas trouvé  
            throw $this->createNotFoundException('Page introuvable.'); // Lance une exception 404
        }

        return $this->render('products/index.html.twig', [ // Le template Twig
            'products' => $products,
            'reviews' => $reviews,
            'alternatives' => $alternatives,
            'templates' => $templates,
            'full_stack' => $full_stack,
            'token' => $token
        ]);
    }

    #[Route('/add', name: 'add_products')] // Route pour ajouter un nouveau produit
    public function add(EntityManagerInterface $em, SluggerInterface $slugger, Request $request): Response
    {
        $products = new Products(); // Crée une nouvelle instance de l'entité Products
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $productsform = $this->createForm(ProductsFormType::class, $products); // Crée le formulaire pour ajouter un produit
        $productsform->handleRequest($request); // Gère la requête du formulaire
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        if ($productsform->isSubmitted() && $productsform->isValid()) { // Si le formulaire est soumis et valide
            $em->persist($products); // Persiste le nouveau produit
            $em->flush(); // Enregistre les modifications

            $this->addFlash('message', 'Site/application publié avec succès ! 😎'); // Ajoute un message

            return $this->redirectToRoute('products_list'); // Redirige vers la liste des produits
        }
        return $this->render('products/add.html.twig', [
            'token' => $token,
            'products' => $products,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'productsform' => $productsform->createView()
        ]);
    }
}
