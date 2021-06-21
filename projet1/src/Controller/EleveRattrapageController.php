<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EleveRattrapage;
use App\Form\EleveRattrapageType;
use Symfony\Component\HttpFoundation\Request;
use App\Controller;

class EleveRattrapageController extends AbstractController
{
    /**
     * @Route("/eleve_rattrapage", name="eleve_rattrapage")
     */
    public function index(Request $request): Response
    {
        $eleverattrapage = new EleveRattrapage();
        $form = $this->createForm(EleveRattrapageType::class,$eleverattrapage);
        $eleverattrapage->setARendu(0);
        if ($request->isMethod('POST')) { 
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($eleverattrapage);
                $em->flush();
                $this->addFlash('notice', 'bien inséré');
            }
            return $this->redirectToRoute('eleve_rattrapage');
        } 
        return $this->render('eleve_rattrapage/index.html.twig', [
        'form'=>$form->createView()
        ]);
    }
}
