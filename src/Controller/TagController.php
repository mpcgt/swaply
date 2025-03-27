<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class TagController extends AbstractController
    {
        #[Route('/tag', name: 'app_tag')] // Route pour afficher la liste des tags
        public function index(TagsRepository $tagsRepository, Request $request): Response
        {
            $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
            $tags = $tagsRepository->findAll(); // Récupère tous les tags de la base de données
            $templates = ''; // Initialisation variable templates
            $full_stack = ''; // Initialisation variable full_stack
    
            return $this->render('tag/index.html.twig', [ // Le template Twig
                'tags' => $tags,
                'templates' => $templates, 
                'full_stack' => $full_stack, 
                'token' => $token
            ]);
        }
    
        #[Route('/tags/{id}', name: 'app_tags', methods:['GET', 'POST'])] // Route pour afficher un tag par son ID
        public function tags(int $id, TagsRepository $tagsRepository, EntityManagerInterface $entityManager, Request $request): Response
        {
            $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
            $id = $entityManager->getRepository(Tags::class)->find($id); // Récupère le tag par son ID
            $tags = $tagsRepository->findBy(['id' => $id]); // Récupère les tags
            $templates = ''; // Initialisation variable templates
            $full_stack = ''; // Initialisation variable full_stack
    
            if (!$id) { // Si le tag n'est pas trouvé
                throw $this->createNotFoundException('Page introuvable.'); // Lance une exception 404
            }
    
            return $this->render('tag/index.html.twig', [ // Le template Twig
                'tags' => $tags,
                'templates' => $templates, 
                'full_stack' => $full_stack, 
                'token' => $token
            ]);
        }
}
