<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RattrapageType;
use App\Entity\Rattrapage;
use App\Entity\Utilisateur;
use App\Entity\EleveRattrapage;
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
            $rattrapage->setEtatRattrapage(0);
            if ($form->isSubmitted() && $form->isValid()) {

                    $file = $rattrapage->getPDF(); //recup image transmise
                    $fichier = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                    $this->getParameter('upload_sujet'),$fichier);
                    $rattrapage->setPDF($fichier);

                    $file2 = $rattrapage->getCorrige(); //recup image transmise
                    $fichier2 = md5(uniqid()).'.'.$file2->guessExtension();
                    $file2->move(
                    $this->getParameter('upload_corrige'),$fichier2);
                    $rattrapage->setCorrige($fichier2);


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
            'rattrapages'=>$rattrapages // Nous passons la liste des rattrapages à la vue
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
     * @Route("/chrono_rattrapage/{id}/{support}", name="chrono_rattrapage", requirements={"id"="\d+","support"="\d+"})
     */
    public function chronoRattrapage(int $id,int $support, Request $request): Response
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
            'date'=>$date,
            'support'=>$support
        ]);
    }


    /**
     * @Route("/rattrapage_profile/{id}", name="rattrapage_profile", requirements={"id"="\d+"})
     */
    public function rattrapageprofile(int $id, Request $request)
    {
     
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $repoEleve = $em->getRepository(EleveRattrapage::class);
        $rattrapage = $repoRattrapage->find($id);
        $eleves = $repoEleve->getEleveByRattrapage($id);
        

        if (isset($_POST['note'])){
            $note = $_POST['note'];
            $idEleve = $_POST['idEleve'];
            $eleves = $repoEleve->updateNote($idEleve, $note);
            $repoEleve->updateEtatRattrapage();
            return $this->redirectToRoute('accueil');
        }
        
        if ($rattrapage==null){
            $this->addFlash('notice','rattrapage introuvable');
            return $this->redirectToRoute('accueil');
        }
        
        return $this->render('rattrapage/profil.html.twig', [
            'rattrapage' => $rattrapage,
            'eleves' => $eleves
           
        ]);
    }    

    /**
     * @Route("/telecharger/{id}", name="telecharger", requirements={"id"="\d+"})
     */
    public function telecharger(int $id, Request $request)
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $repoEleve = $em->getRepository(EleveRattrapage::class);
        $rattrapage=$repoRattrapage->find($id)->getId();
        $eleve=$repoEleve->find($rattrapage);
        $notes = $repoEleve->getNotes($id);
        $rattrapage = $repoRattrapage->find($id);
        $eleves = $repoEleve->getEleveByRattrapage($id);
        //Nom des colonnes en première lignes
        // le \n à la fin permets de faire un saut de ligne, super important en CSV
        // le point virgule sépare les données en colonnes
        $myVariableCSV = "Nom; Prenom; Note;\n";
        
        foreach($notes as $note){
            $nom = $note['Nom'];
            $prenom = $note['Prenom'];
            $noteP = $note['Note'];
                //Ajout de données (avec le . devant pour ajouter les données à la variable existante)
                $myVariableCSV .= "$nom; $prenom ; $noteP ; \n";
                //Si l'on souhaite ajouter un espace
                //$myVariableCSV .= " ; ; ; \n";
        }
        //Autre donnée
        //$myVariableCSV .= "Bayon; Fabien; $note;\n";
        //On donne la variable en string à la response, nous définissons le code HTTP à 200
        return new Response(
            $myVariableCSV,
            200,
            [
            //Définit le contenu de la requête en tant que fichier Excel
                'Content-Type' => 'application/vnd.ms-excel',
            //On indique que le fichier sera en attachment donc ouverture de boite de téléchargement ainsi que le nom du fichier
                "Content-disposition" => "attachment; filename=Notes_rattrapage.csv"
            ]
        );


        
    }
    
    /**
    * @Route("/modif_rattrapage/{id}", name="modif_rattrapage", requirements={"id"="\d+"})
    */
    public function modifRattrapage(int $id, Request $request)
    {
        $em = $this->getDoctrine();
        $repoRattrapage = $em->getRepository(Rattrapage::class);
        $rattrapage = $repoRattrapage->find($id);
        if($rattrapage==null){
            $this->addFlash('notice', "Ce rattrapage n'existe pas");
            return $this->redirectToRoute('liste_rattrapages');
        }
        $form = $this->createForm(RattrapageType::class,$rattrapage);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request); 
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rattrapage);
                $em->flush();
                $this->addFlash('notice', 'Rattrapage modifié');
            }
            return $this->redirectToRoute('liste_rattrapages');
        }
        return $this->render('rattrapage/modif_rattrapage.html.twig', [
        'form'=>$form->createView()
        ]);
    }
    
    
    
}
