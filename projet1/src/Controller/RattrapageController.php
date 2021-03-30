<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RattrapageType;

class RattrapageController extends AbstractController
{
    /**
     * @Route("/rattrapage", name="rattrapage")
     */
    public function index(): Response
    {
        $form = $this->createForm(ContactType::class);
        return $this->render('rattrapage/index.html.twig', [
            'form'=>$form->createView()
        ]);
        //return $this->render('rattrapage/index.html.twig', [
           // 'controller_name' => 'RattrapageController',
        //]);
    }
}
