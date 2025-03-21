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
    #[Route('/search', name: 'search_products')]
    public function searchAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $query = $request->query->get('q');
        $products = [];

        if ($query) {
            $repository = $entityManager->getRepository(Products::class);
            $products = $repository->createQueryBuilder('p')
                ->where('p.title LIKE :query OR p.description LIKE :query')
                ->setParameter('query', '%' . $query . '%')
                ->getQuery()
                ->getResult();
        }
        $token = $request->attributes->get('_profiler_token');

        return $this->render('home/search.html.twig', [
            'products' => $products,
            'query' => $query,
            'token' => $token
        ]);
    }
}
