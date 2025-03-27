<?php

namespace App\Controller;

use App\Entity\Reviews;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Users();
        $authentifited = $security->getUser();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $reviews = $entityManager->getRepository(Reviews::class)->findBy(['user' => $authentifited]);
        $token = $request->attributes->get('_profiler_token');
        $templates = '';
        $full_stack = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setPasswordHash($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            $security->login($user, UsersAuthenticator::class, 'main');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'registrationForm' => $form->createView(),
            'reviews' => $reviews,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
