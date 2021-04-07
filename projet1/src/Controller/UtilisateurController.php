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
}
