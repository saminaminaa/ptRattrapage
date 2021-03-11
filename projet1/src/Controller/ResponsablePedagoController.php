<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResponsablePedagoController extends AbstractController
{
    /**
     * @Route("/responsable/pedago", name="responsable_pedago")
     */
    public function index(): Response
    {
        return $this->render('responsable_pedago/index.html.twig', [
            'controller_name' => 'ResponsablePedagoController',
        ]);
    }

    /**
     * @Route("/liste_rattrapage", name="liste_rattrapage")
     */
    public function listeRattrapage(): Response
    {
        return $this->render('responsable_pedago/liste_rattrapage.html.twig', [
            'controller_name' => 'ResponsablePedagoController',
        ]);
    }
}
