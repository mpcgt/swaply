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

    #[Route('/lists', name: 'app_lists')] // Route pour la liste de toutes les listes
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $lists = $this->listsRepository->findAll(); // Récupère toutes les listes
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        return $this->render('list/index.html.twig', [ // Le template Twig
            'lists' => $lists,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }

    #[Route('/lists/{id}', name: 'lists_id', methods: ['GET', 'POST'])] // Route pour afficher une liste par son ID
    public function id(int $id, ProductsRepository $productsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $list = $this->listsRepository->find($id); // Récupère la liste par son ID
        $lists = $this->listsRepository->findAll(); // Récupère toutes les listes
        $products = $productsRepository->findAll(); // Récupère tous les produits
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

    #[Route('/list-add', name: 'add_lists')] // Route pour ajouter une nouvelle liste
    public function add(EntityManagerInterface $em, SluggerInterface $slugger, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $lists = new Lists(); // Crée une nouvelle instance de l'entité Lists
        $listsform = $this->createForm(ListsFormType::class, $lists); // Crée le formulaire pour ajouter une liste
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack
        
        $listsform->handleRequest($request); // Gère la requête du formulaire

        if($listsform->isSubmitted() && $listsform->isValid()) { // Si le formulaire est soumis et valide
            $em->persist($lists); // Persiste la nouvelle liste
            $em->flush(); // Enregistre les modifications

            $this->addFlash('message', 'La liste a été publié avec succès ! 😎'); // Ajoute un message

            return $this->redirectToRoute('app_lists'); // Redirige vers la liste des listes
        }

        return $this->render('list/add.html.twig', [ // Le template Twig
            'lists' => $lists,
            'listsform' => $listsform->createView(),
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
