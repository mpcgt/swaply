<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $token = $request->attributes->get('_profiler_token');
        $urls = [
            ['loc' => $this->generateUrl('/', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/lists', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/reviews', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/category', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/about', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
            ['loc' => $this->generateUrl('/account', [], true), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '0.0'],
        ];

        $response = new Response(
            $this->renderView('sitemap/index.xml.twig', ['urls' => $urls, 'token' => $token]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
    