<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classe;
use App\Form\ClasseType;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends AbstractController
{
    /**
     * @Route("/classe", name="classe")
     */
    public function index(Request $request): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class,$classe);
        if ($request->isMethod('POST')) { 
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($classe);
                $em->flush();
                $this->addFlash('notice', 'Classe inséré');
            }
            return $this->redirectToRoute('classe');
        } 
        return $this->render('classe/index.html.twig', [
        'form'=>$form->createView()
        ]);
    }
}
