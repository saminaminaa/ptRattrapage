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
     * @Route("/chrono_rattrapage/{id}", name="chrono_rattrapage", requirements={"id"="\d+"})
     */
    public function chronoRattrapage(int $id, Request $request): Response
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $rattrapage = $repoRattrapage->find($id);

        if($rattrapage==null){
            $this->addFlash('notice', "Ce Rattrapage n'existe pas");
            return $this->redirectToRoute('liste_rattrapages');
        }
        
        $date = $repoRattrapage->getdate($id);
        foreach($date as $dateR){
            $dateNow = date_create(date('Y-m-d H:i:s'));
            $dateRattrapage = date_create(date_format($dateR['dateR'], 'Y-m-d H:i:s'));
            $interval = date_diff($dateNow, $dateRattrapage);
            if(strtotime($interval->format('%Y-%m-%d %H:%i:%s')) > strtotime('0000-00-00 00:15:00')){
                $this->addFlash('notice', "Le rattrapage ne peut pas être lancé maintenant");
                return $this->redirectToRoute('liste_rattrapages');
            }
        }

        return $this->render('rattrapage/chrono_rattrapage.html.twig', [
            'rattrapage'=>$rattrapage,
            'date'=>$date
        ]);
    }
}
