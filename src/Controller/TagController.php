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
        #[Route('/tag', name: 'app_tag')]
        public function index(TagsRepository $tagsRepository, Request $request): Response
        {
            $token = $request->attributes->get('_profiler_token');
            $tags = $tagsRepository->findAll();
            $templates = '';
            $full_stack = '';
    
            return $this->render('tag/index.html.twig', [
                'tags' => $tags,
                'templates' => $templates, 
                'full_stack' => $full_stack, 
                'token' => $token
            ]);
        }
    
        #[Route('/tags/{id}', name: 'app_tags', methods:['GET', 'POST'])]
        public function tags(int $id, TagsRepository $tagsRepository, EntityManagerInterface $entityManager, Request $request): Response
        {
            $token = $request->attributes->get('_profiler_token');
            $id = $entityManager->getRepository(Tags::class)->find($id);
            $tags = $tagsRepository->findBy(['id' => $id]);
            $templates = '';
            $full_stack = '';
    
            if (!$id) {
                throw $this->createNotFoundException('Page introuvable.');
            }
    
            return $this->render('tag/index.html.twig', [
                'tags' => $tags,
                'templates' => $templates, 
                'full_stack' => $full_stack, 
                'token' => $token
            ]);
        }
}
