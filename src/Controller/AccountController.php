<?php

namespace App\Controller;

use App\Entity\Reviews;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use App\Form\EditProfileFormType;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/account', name: 'app_account')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Users(); // Crée une nouvelle instance de l'entité Users
        $authentifited = $security->getUser(); // Récupère l'utilisateur authentifié
        $form = $this->createForm(RegistrationFormType::class, $user); // Crée le formulaire d'inscription
        $form->handleRequest($request); // Gère la requête du formulaire
        $reviews = $entityManager->getRepository(Reviews::class)->findBy(['user' => $authentifited]); // Récupère les avis de l'utilisateur qui est connecté
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        if ($form->isSubmitted() && $form->isValid()) { // Si le formulaire est soumis et valide
            $plainPassword = $form->get('plainPassword')->getData(); // Récupère le mot de passe en clair

            $user->setPasswordHash($userPasswordHasher->hashPassword($user, $plainPassword)); // Hash le mot de passe

            $entityManager->persist($user);
            $entityManager->flush(); // Enregistre les modifications

            $security->login($user, UsersAuthenticator::class, 'main'); // Connecte l'utilisateur

            return $this->redirectToRoute('app_account'); // Redirige vers la page de compte
        }

        return $this->render('account/index.html.twig', [ // Le template Twig
            'controller_name' => 'AccountController',
            'registrationForm' => $form->createView(),
            'reviews' => $reviews,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }

    #[Route('/edit', name: 'app_edit')]
    public function edit(Request $request) {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileFormType::class, $user);

        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->entityManager;
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Votre compte a été modifié !');
            return $this->redirectToRoute('app_account');
        }

        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        return $this->render('account/edit.html.twig', [ // Le template Twig
            'form' => $form->createView(),
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
