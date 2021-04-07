<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UtilisateurType;
use App\Entity\Utilisateur;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/ajoutUtilisateur/{id}", name="ajoutUtilisateur" , requirements={"id"="\d+"})
     */
    public function ajoutUtilisateur(int $id,Request $request): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class,$utilisateur);
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $user = $repoUser->find($id);
        $utilisateur->setUser($user);

        if ($request->isMethod('POST')) { 
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $user=$utilisateur->getUser();
                $user->setUtilisateur($utilisateur);
                $em->persist($user);
                $em->flush();
                $this->addFlash('notice', 'Utilisateur inséré');
            }
            return $this->redirectToRoute('accueil');
        } 
        return $this->render('utilisateur/ajout_utilisateur.html.twig', [
        'form'=>$form->createView()
        ]);
    }

      /**
    * @Route("/liste_utilisateur", name="liste_utilisateur")
    */
    public function liste_utilisateur(Request $request)
    {
        $em = $this->getDoctrine();
        $repoUser = $em->getRepository(User::class);
        $user = $repoUser->findBy(array(),array('email'=>'ASC'));
        
        return $this->render('utilisateur/liste_utilisateur.html.twig', [
            'users'=>$user // Nous passons la liste des thèmes à la vue
        ]);
    }

        /**
     * @Route("/modifUtilisateur/{id}", name="modifUtilisateur", requirements={"id"="\d+"})
     */
    public function modifUtilisateur(int $id, Request $request): Response
    {
       
        $em = $this->getDoctrine();
        $repoUtilisateur = $em->getRepository(Utilisateur::class);
        $utilisateur = $repoUtilisateur->find($id);
        if($utilisateur==null){
            $this->addFlash('notice', "Cet utilisateur n'existe pas");
            return $this->redirectToRoute('liste_utilisateur');
        }
        $form = $this->createForm(UtilisateurType::class,$utilisateur);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
                $this->addFlash('notice', 'Utilisateur modifié');
            }   
            return $this->redirectToRoute('liste_utilisateur');
        }

        return $this->render('utilisateur/modif_utilisateur.html.twig', [
            'form'=>$form->createView() 
        ]);
    }


     /**
     * @Route("/suppUtiliateur/{id}", name="suppUtilisateur" ,requirements={"id"="\d+"})
     */
  
    public function suppUtiliateur(int $id, Request $request): Response
    {

       
        $em = $this->getDoctrine();
        $repoUtilisateur = $em->getRepository(Utilisateur::class);
        $utilisateur = $repoUtilisateur->find($id);
           
        $em = $this->getDoctrine()->getManager(); // On récupère le gestionnaire des entités
        $em->remove($utilisateur); // Nous enregistrons notre nouveau thème
        $em->flush(); // Nous validons notre ajout
        $this->addFlash('notice', 'Utilisateur supprimé avec succés'); // Nous préparons le message à afficher à l’utilisateur sur la page où il se rendra

        return $this->redirectToRoute('liste_utilisateur');
          
    }

}
