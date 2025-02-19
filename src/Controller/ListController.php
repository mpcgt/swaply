<?php

namespace App\Controller;

use App\Repository\ListsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListController extends AbstractController
{
    private ListsRepository $listsRepository;

    public function __construct(ListsRepository $listsRepository)
    {
        $this->listsRepository = $listsRepository;
    }

    #[Route('/lists', name: 'app_lists')]
    public function index(): Response
    {
        $lists = $this->listsRepository->findAll();

        return $this->render('list/index.html.twig', [
            'lists' => $lists,
        ]);
    }
}
