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
    #[Route('/reviews', name: 'reviews_index')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $reviews = $entityManager->getRepository(Reviews::class)->findAll();
        $templates = '';
        $full_stack = '';
    
        return $this->render('reviews/index.html.twig', [
            'reviews' => $reviews,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }

    #[Route('/reviews/new', name: 'reviews_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Reviews();
        $token = $request->attributes->get('_profiler_token');
        $form = $this->createForm(ReviewsType::class, $review);
        $templates = '';
        $full_stack = '';

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('reviews_index');
        }

        return $this->render('reviews/new.html.twig', [
            'form' => $form->createView(),
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
