<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookieConsentController extends AbstractController
{
    /**
     * @Route("/cookie-consent", name="cookie_consent")
     */ 
    public function cookieConsent(): Response
    {
        return $this->render('', [
        ]);
    }
}
