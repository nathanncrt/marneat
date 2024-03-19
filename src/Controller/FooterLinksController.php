<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterLinksController extends AbstractController
{
    #[Route('/liens_utiles', name: 'app_footer_links')]
    public function index(): Response
    {
        return $this->render('footer_links/index.html.twig', [
            'controller_name' => 'FooterLinksController',
        ]);
    }

    #[Route('/liens_utiles/legal_mentions', name: 'app_footer_links_legal_mentions')]
    public function legal_mentions(): Response
    {
        return $this->render('legal_mentions/index.html.twig');
    }

    #[Route('/liens_utiles/terms_of_use', name: 'app_footer_links_terms_of_use')]
    public function terms_of_use(): Response
    {
        return $this->render('terms_of_use/index.html.twig');
    }

    #[Route('/liens_utiles/privacy_policy', name: 'app_footer_links_privacy_policy')]
    public function privacy_policy(): Response
    {
        return $this->render('privacy_policy/index.html.twig');
    }

    #[Route('/liens_utiles/faq', name: 'app_footer_links_faq')]
    public function faq(): Response
    {
        return $this->render('faq/faq.html.twig');
    }

    #[Route('/liens_utiles/contact_us', name: 'app_footer_links_contact_us')]
    public function contact_us(): Response
    {
        return $this->render('contact_us/index.html.twig');
    }
}
