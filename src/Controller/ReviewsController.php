<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewsController extends AbstractController
{
    #[Route('/reviews', name: 'reviews_index')] // Route pour afficher la liste des avis
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $reviews = $entityManager->getRepository(Reviews::class)->findAll(); // Récupère toutes les avis
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
    
        return $this->render('reviews/index.html.twig', [ // Le template Twig
            'reviews' => $reviews,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }

    #[Route('/reviews/new', name: 'reviews_new', methods: ['GET', 'POST'])] // Route pour créer un nouvel avis
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Reviews(); // Crée une nouvelle instance de l'entité Reviews
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $form = $this->createForm(ReviewsType::class, $review); // Crée le formulaire pour créer une review
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        $form->handleRequest($request); // Gère la requête du formulaire

        if ($form->isSubmitted() && $form->isValid()) { // Si le formulaire est soumis et valide
            $entityManager->persist($review); // Persiste le nouvel avis
            $entityManager->flush(); // Enregistre les modifications

            return $this->redirectToRoute('reviews_index'); // Redirige vers la liste des avis
        }

        return $this->render('reviews/new.html.twig', [// Le template Twig
            'form' => $form->createView(),
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
