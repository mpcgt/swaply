<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search_products')] // Route pour la recherche de produits
    public function searchAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
        $query = $request->query->get('q'); // Récupère le terme de recherche depuis la requête GET (paramètre 'q')
        $products = []; // Initialise le tableau des produits à vide

        if ($query) { // Si un terme de recherche est fourni
            $repository = $entityManager->getRepository(Products::class); // Récupère le repository de l'entité Products
            $products = $repository->createQueryBuilder('p') // Crée un constructeur de requête (QueryBuilder)
                ->where('p.title LIKE :query OR p.description LIKE :query') // Définit la clause WHERE pour rechercher dans les colonnes 'title' et 'description'
                ->setParameter('query', '%' . $query . '%') // Définit le paramètre ':query' pour la recherche (ajoute les '%' pour une recherche LIKE)
                ->getQuery() // Obtient la requête construite
                ->getResult(); // Exécute la requête et récupère les résultats
        }

        return $this->render('home/search.html.twig', [ // Le template Twig
            'products' => $products,
            'query' => $query,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
