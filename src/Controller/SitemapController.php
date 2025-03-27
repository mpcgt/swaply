<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", methods={"GET"}) // Route pour le sitemap XML
     */
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token'); // Récupère le token du profiler
        $urls = [ // Tableau des URLs à inclure dans le sitemap
            ['loc' => $this->generateUrl('/', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/lists', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/reviews', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/category', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/about', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/account', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
        ];

        $response = new Response( // Crée une nouvelle réponse HTTP
            $this->renderView('sitemap/index.xml.twig', ['urls' => $urls, 'token' => $token]), // Le template Twig avec les URLs
            200 // Code de statut HTTP 200 (OK)
        );
        $response->headers->set('Content-Type', 'text/xml'); // Définit l'en-tête Content-Type à 'text/xml'

        return $response; // Retourne la réponse HTTP
    }
}
    