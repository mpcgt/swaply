<?php

namespace App\Controller;

use App\Repository\ListsProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

final class ListProductController extends AbstractController
{
    private ListsProductsRepository $listsProductsRepository;

    public function __construct(ListsProductsRepository $listsProductsRepository)
    {
        $this->listsProductsRepository = $listsProductsRepository;
    }

    #[Route('/lists/{id}', name: 'lists_id', methods:['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $listsProducts = $this->listsProductsRepository->findAll();


        return $this->render('list/id.html.twig', [
            'listsProducts' => $listsProducts,
            'token' => $token
        ]);
    }
}
