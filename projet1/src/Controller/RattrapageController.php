<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RattrapageType;
use App\Entity\Rattrapage;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;

class RattrapageController extends AbstractController
{
    /**
     * @Route("/rattrapage", name="rattrapage")
     */
    public function index(Request $request): Response
    {
        $rattrapage = new Rattrapage();
        $form = $this->createForm(RattrapageType::class,$rattrapage);
        if ($request->isMethod('POST')) { 
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rattrapage);
                $em->flush();
                $this->addFlash('notice', 'Rattrapage inséré');
            }
            return $this->redirectToRoute('rattrapage');
        } 
        return $this->render('rattrapage/index.html.twig', [
        'form'=>$form->createView()
        ]);
    }
}
