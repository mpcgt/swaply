<?php

namespace App\Controller;

use App\Entity\Lists;
use App\Entity\Products;
use App\Form\ListsFormType;
use App\Repository\ListsRepository;
use App\Repository\ProductsRepository;
use App\Repository\ListsProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ListController extends AbstractController
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

    #[Route('/lists', name: 'app_lists')]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $lists = $this->listsRepository->findAll();

        return $this->render('list/index.html.twig', [
            'lists' => $lists,
            'token' => $token
        ]);
    }

    #[Route('/lists/{id}', name: 'lists_id', methods: ['GET', 'POST'])]
    public function id(int $id, ProductsRepository $productsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $list = $this->listsRepository->find($id);
        $lists = $this->listsRepository->findAll();
        $products = $productsRepository->findAll();
        $listsProducts = $this->listsProductsRepository->findAll();

        if (!$list) {
            throw $this->createNotFoundException('Page introuvable.');
        }

        return $this->render('list/id.html.twig', [
            'listsProducts' => $listsProducts,
            'lists' => $lists,
            'products' => $products,
            'token' => $token
        ]);
    }

    #[Route('/list-add', name: 'add_lists')]
    public function add(EntityManagerInterface $em, SluggerInterface $slugger, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $lists = new Lists();
        $listsform = $this->createForm(ListsFormType::class, $lists);
        
        $listsform->handleRequest($request);

        if($listsform->isSubmitted() && $listsform->isValid()) {
            $em->persist($lists);
            $em->flush();

            $this->addFlash('bg-green-500 text-white text-center py-4', 'La liste a été publié avec succès ! 😎');

            return $this->redirectToRoute('app_lists');
        }

        return $this->render('list/add.html.twig', [
            'lists' => $lists,
            'listsform' => $listsform->createView(),
            'token' => $token
        ]);
    }
}
