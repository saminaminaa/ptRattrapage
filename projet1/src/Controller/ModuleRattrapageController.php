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
     * @Route("/ajout_module_rattrapage", name="module_rattrapage")
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
        return $this->render('module_rattrapage/ajout_module_rattrapage.html.twig', [
        'form'=>$form->createView()
        ]);
    }

        /**
    * @Route("/liste_modules_rattrapages", name="liste_modules_rattrapages")
    */
    public function listeModulesRattrapages(Request $request)
    {
        $em = $this->getDoctrine();
        $repoModulerattrapage = $em->getRepository(ModuleRattrapage::class);

        if ($request->get('supp')!=null){
            $modulerattrapage = $repoModulerattrapage->find($request->get('supp'));
            if($rattrapage!=null){
                $em->getManager()->remove($rattrapage);
                $em->getManager()->flush();
            }
            return $this->redirectToRoute('liste_modules_rattrapages');
        }
           

        $modulesrattrapages = $repoModulerattrapage->findBy(array(),array('libelle'=>'ASC'));
        
        return $this->render('module_rattrapage/liste_modules_rattrapages.html.twig', [
        'modulesrattrapages'=>$modulesrattrapages
        ]);
    }

    /**
    * @Route("/modif_module_rattrapage/{id}", name="modif_module_rattrapage", requirements={"id"="\d+"})
    */
    public function modifModulerattrapage(int $id, Request $request)
    {
        $em = $this->getDoctrine();
        $repoModulerattrapage = $em->getRepository(ModuleRattrapage::class);
        $modulerattrapage = $repoModulerattrapage->find($id);
        if($modulerattrapage==null){
            $this->addFlash('notice', "Ce module de rattrapage n'existe pas");
            return $this->redirectToRoute('liste_modules_rattrapages');
        }
        $form = $this->createForm(ModuleRattrapageType::class,$modulerattrapage);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($modulerattrapage);
                $em->flush();
                $this->addFlash('notice', 'Module de rattrapage modifié');
            }
            return $this->redirectToRoute('liste_modules_rattrapages');
        }
        return $this->render('module_rattrapage/modif_module_rattrapage.html.twig', [
        'form'=>$form->createView()
        ]);
    }
}
