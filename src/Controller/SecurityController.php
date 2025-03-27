<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')] // Route pour la page de connexion
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $error = $authenticationUtils->getLastAuthenticationError(); // Récupère la dernière erreur d'authentification
        $lastUsername = $authenticationUtils->getLastUsername(); // Récupère le dernier nom d'utilisateur saisi
        $templates = ''; // Initialisation variable templates
        $full_stack = ''; // Initialisation variable full_stack

        return $this->render('security/login.html.twig', [ // Le template Twig
            'last_username' => $lastUsername,
            'error' => $error,
            'templates' => $templates, 
            'full_stack' => $full_stack, 
            'token' => $token
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')] // Route pour la déconnexion
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.'); // Lance une exception, car la déconnexion est gérée par le pare-feu de sécurité
    }

    #[Route('/{id}', name: 'user_delete', methods: ['POST'])] // Route pour supprimer un utilisateur par son ID (méthode POST)
    public function delete(Request $request, Users $user, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) { // Vérifie le token CSRF pour la suppression
            $this->container->get('security.token_storage')->setToken(null); // Supprime le token de sécurité (déconnecte l'utilisateur)
            $em->remove($user); // Supprime l'utilisateur de la base de données
            $em->flush(); // Enregistre les modifications
        }
        $this->addFlash('deleted', 'Votre compte a été supprimé.'); // Ajoute un message de confirmation
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER); // Redirige vers la page d'accueil
    }
}
