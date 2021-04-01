<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ModuleRattrapage;
use App\Form\ModuleRattrapageType;
use Symfony\Component\HttpFoundation\Request;

class ModuleRattrapageController extends AbstractController
{
    /**
     * @Route("/module/rattrapage", name="module_rattrapage")
     */
    public function index(Request $request): Response
    {
        $modulerattrapage = new ModuleRattrapage();
        $form = $this->createForm(ModuleRattrapageType::class,$modulerattrapage);
        if ($request->isMethod('POST')) { 
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($modulerattrapage);
                $em->flush();
                $this->addFlash('notice', 'Module de rattrapage inséré');
            }
            return $this->redirectToRoute('module_rattrapage');
        } 
        return $this->render('module_rattrapage/index.html.twig', [
        'form'=>$form->createView()
        ]);
    }
}
