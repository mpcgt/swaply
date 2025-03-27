<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class UsersAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login'; // Constante pour la route de connexion

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport // Authentifie l'utilisateur
    {
        $email = $request->getPayload()->getString('email'); // Récupère l'email depuis la requête

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email); // Stocke l'email dans la session

        return new Passport( // Crée un objet Passport pour l'authentification
            new UserBadge($email), // Crée un badge d'utilisateur avec l'email
            new PasswordCredentials($request->getPayload()->getString('password')), // Crée un badge de mot de passe
            [
                // new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),
                new RememberMeBadge(), // Badge RememberMe
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response // Gère la réussite de l'authentification
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) { // Si un chemin cible est stocké dans la session
            return new RedirectResponse($targetPath); // Redirige vers le chemin cible
        }

        // For example:
        return new RedirectResponse($this->urlGenerator->generate('app_account')); // Redirige vers la page de compte
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string // Obtient l'URL de connexion
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE); // Génère l'URL de la route de connexion
    }
}
