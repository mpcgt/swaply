<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')] // Route pour la page d'inscription
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Users(); // Crée une nouvelle instance de l'entité Users
        $form = $this->createForm(RegistrationFormType::class, $user, [
            'csrf_protection' => true,
        ]);// Crée le formulaire d'inscription
        $form->handleRequest($request); // Gère la requête du formulaire
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        if ($form->isSubmitted() && $form->isValid()) { // Si le formulaire est soumis et valide
            $plainPassword = $form->get('plainPassword')->getData(); // Récupère le mot de passe en clair
        
            $user->setPasswordHash($userPasswordHasher->hashPassword($user, $plainPassword)); // Hash le mot de passe
        
            $entityManager->persist($user); // Persiste l'utilisateur
            $entityManager->flush(); // Enregistre les modifications
        
            return $security->login($user, UsersAuthenticator::class, 'main'); // Connecte l'utilisateur et le redirige vers la page d'accueil
        }

        return $this->render('registration/register.html.twig', [ // Le template Twig
            'registrationForm' => $form,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }
}
