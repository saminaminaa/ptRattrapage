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
            $rattrapage->setEtatRattrapage(1);
          //  $rattrapage->setmoduleRattrapage(18);
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

    /**
     * @Route("/liste_rattrapages", name="liste_rattrapages")
     */
    public function listeRattrapages(Request $request)
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $rattrapages = $repoRattrapage->findBy(array(),array('EtatRattrapage'=>'ASC'));
        return $this->render('rattrapage/liste_rattrapages.html.twig', [
            'rattrapages'=>$rattrapages // Nous passons la liste des thèmes à la vue
        ]);
    }

      /**
     * @Route("/liste_rattrapagesByIntervenant", name="liste_rattrapagesByIntervenant")
     */
    public function listeRattrapagesByIntervenant(Request $request)
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $idUser =  $this->getUser()->getUtilisateur()->getId();
        $rattrapages = $repoRattrapage->getRattrapageByIntervenant($idUser);
        return $this->render('rattrapage/liste_rattrapages.html.twig', [
            'rattrapages'=>$rattrapages // Nous passons la liste des thèmes à la vue
        ]);
    }

    /**
     * @Route("/liste_rattrapagesBySurveillant", name="liste_rattrapagesBySurveillant")
     */
    public function listeRattrapagesBySurveillant(Request $request)
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $idUser =  $this->getUser()->getUtilisateur()->getId();
        $rattrapages = $repoRattrapage->getRattrapageBySurveillant($idUser);
        return $this->render('rattrapage/liste_rattrapages.html.twig', [
            'rattrapages'=>$rattrapages 
        ]);
    }

    
    /**
     * @Route("/chrono_rattrapage/{id}", name="chrono_rattrapage", requirements={"id"="\d+"})
     */
    public function chronoRattrapage(int $id, Request $request): Response
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $rattrapage = $repoRattrapage->find($id);

        if($rattrapage==null){
            $this->addFlash('notice', "Ce Rattrapage n'existe pas");
            return $this->redirectToRoute('liste_Rattrapages');
        }
        
        $this->addFlash('notice', $rattrapage);


        return $this->render('rattrapage/chrono_rattrapage.html.twig', [
            'rattrapage'=>$rattrapage
        ]);
    }
}
