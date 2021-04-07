<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Eleve;
use App\Form\EleveType;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends AbstractController
{
    /**
     * @Route("/eleve", name="eleve")
     */
    public function index(Request $request): Response
    {
        $eleve = new Eleve();
        $form = $this->createForm(EleveType::class,$eleve);
        if ($request->isMethod('POST')) { 
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($eleve);
                $em->flush();
                $this->addFlash('notice', 'Eleve inséré');
            }
            return $this->redirectToRoute('eleve');
        } 
        return $this->render('eleve/ajout_eleve.html.twig', [
        'form'=>$form->createView()
        ]);
    }

    /**
    * @Route("/liste_eleves", name="liste_eleves")
    */
    public function listeEleves(Request $request)
    {
        $em = $this->getDoctrine();
        $repoEleve = $em->getRepository(Eleve::class);

        if ($request->get('supp')!=null){
            $eleve = $repoEleve->find($request->get('supp'));
            if($eleve!=null){
                $em->getManager()->remove($eleve);
                $em->getManager()->flush();
            }
            return $this->redirectToRoute('liste_eleves');
        }
           

        $eleves = $repoEleve->findBy(array(),array('Nom'=>'ASC'));
        
        return $this->render('eleve/liste_eleve.html.twig', [
        'eleves'=>$eleves 
        ]);
    }

    /**
    * @Route("/modif_eleve/{id}", name="modif_eleve", requirements={"id"="\d+"})
    */
    public function modifEleve(int $id, Request $request)
    {
        $em = $this->getDoctrine();
        $repoEleve = $em->getRepository(Eleve::class);
        $eleve = $repoEleve->find($id);
        if($eleve==null){
            $this->addFlash('notice', "Cet élève n'existe pas");
            return $this->redirectToRoute('liste_eleves');
        }
        $form = $this->createForm(EleveType::class,$eleve);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($eleve);
                $em->flush();
                $this->addFlash('notice', 'Eleve modifié');
            }
            return $this->redirectToRoute('liste_eleves');
        }
        return $this->render('eleve/modif_eleve.html.twig', [
        'form'=>$form->createView()
        ]);
    }
}
