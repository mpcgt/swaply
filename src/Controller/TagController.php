<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TagController extends AbstractController
    {
        #[Route('/tag', name: 'app_tag')]
        public function index(TagsRepository $tagsRepository): Response
        {
            $tags = $tagsRepository->findAll();
    
            return $this->render('tags/index.html.twig', [
                'tags' => $tags,
            ]);
        }
    
        #[Route('/tags/{id}', name: 'app_tags', methods:['GET', 'POST'])]
        public function tags(int $id, TagsRepository $tagsRepository, EntityManagerInterface $entityManager): Response
        {
            $id = $entityManager->getRepository(Tags::class)->find($id);
            $tags = $tagsRepository->findBy(['id' => $id]);
    
            if (!$id) {
                throw $this->createNotFoundException('Page introuvable.');
            }
    
            return $this->render('tags/index.html.twig', [
                'tags' => $tags,
            ]);
        }
}
