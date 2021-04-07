<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Utilisateur;
use App\Entity\User;
use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\ModuleRattrapage;
use App\Entity\Rattrapage;
use App\Entity\EleveRattrapage;


class AppFixtures extends Fixture
{
    private $manager;

    private $faker;

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadClasses();
        $this->loadEleves();
        $this->loadModules();
        $this->loadUtilisateurs();        
        $this->loadRattrapages();
        $this->loadEleveRattrapages();
    }

    public function loadClasses(){
        $classe = new Classe();
        $classe->setLibelle('B1');
        $this->addReference('B1', $classe);
        $this->manager->persist($classe);
        
        $classe = new Classe();
        $classe->setLibelle('B2');
        $this->addReference('B2', $classe);
        $this->manager->persist($classe);

        $classe = new Classe();
        $classe->setLibelle('B3');
        $this->addReference('B3', $classe);
        $this->manager->persist($classe);

        $classe = new Classe();
        $classe->setLibelle('I1');
        $this->addReference('I1', $classe);
        $this->manager->persist($classe);

        $classe = new Classe();
        $classe->setLibelle('I2');
        $this->addReference('I2', $classe);
        $this->manager->persist($classe);

        $this->manager->flush();
    }

    public function loadEleves(){
        $eleve = new Eleve();
        $eleve->setClasse(($this->getReference('B1')))
        ->setNom("Bayon")
        ->setPrenom("Fabien")
        ->setPhoto("a");
        $this->addReference('Fabien', $eleve);
        $this->manager->persist($eleve);

        $eleve = new Eleve();
        $eleve->setClasse(($this->getReference('B2')))
        ->setNom("Lecherf")
        ->setPrenom("Noemie")
        ->setPhoto("a");
        $this->addReference('Noemie', $eleve);
        $this->manager->persist($eleve);

        $eleve = new Eleve();
        $eleve->setClasse(($this->getReference('B3')))
        ->setNom("Bovin")
        ->setPrenom("Bastien")
        ->setPhoto("a");
        $this->addReference('bastien', $eleve);
        $this->manager->persist($eleve);

        $eleve = new Eleve();
        $eleve->setClasse(($this->getReference('I1')))
        ->setNom("Bon")
        ->setPrenom("Jean")
        ->setPhoto("a");
        $this->addReference('Jambon', $eleve);
        $this->manager->persist($eleve);

        $eleve = new Eleve();
        $eleve->setClasse($this->getReference('I2'))
        ->setNom("Covert")
        ->setPrenom("Harry")
        ->setPhoto("a");
        $this->addReference('Haricot', $eleve);
        $this->manager->persist($eleve);

        $this->manager->flush();

    }

    public function loadModules(){
        $module = new ModuleRattrapage();
        $module->setLibelle('maths');
        $this->addReference('maths', $module);
        $this->manager->persist($module);
        
        $module = new ModuleRattrapage();
        $module->setLibelle('anglais');
        $this->addReference('anglais', $module);
        $this->manager->persist($module);

        $module = new ModuleRattrapage();
        $module->setLibelle('python');
        $this->addReference('python', $module);
        $this->manager->persist($module);

        $module = new ModuleRattrapage();
        $module->setLibelle('C#');
        $this->addReference('C#', $module);
        $this->manager->persist($module);

        $module = new ModuleRattrapage();
        $module->setLibelle('PHP');
        $this->addReference('PHP', $module);
        $this->manager->persist($module);

        $this->manager->flush();
    }


    public function loadUtilisateurs(){


        $utilisateur = new Utilisateur();
        $utilisateur->setNom('Maziere')
        ->setPrenom('Maxence');
        $this->addReference('maxence', $utilisateur);
        $this->manager->persist($utilisateur);

        $user = new User();
        $user->setEmail('maxence.maziere@epsi.fr')
        ->setPassword("maxence.maziere")
        ->setUtilisateur($utilisateur);
        $this->addReference('maxenceUser', $user);
        $this->manager->persist($user);

        $utilisateur = new Utilisateur();
        $utilisateur->setNom('Legales')
        ->setPrenom('Julien');
        $this->addReference('Julien', $utilisateur);
        $this->manager->persist($utilisateur);

        $user = new User();
        $user->setEmail('julien.legales@epsi.fr')
        ->setPassword("julien.legales")
        ->setUtilisateur($utilisateur);
        $this->addReference('julienUser', $user);
        $this->manager->persist($user);
        $this->manager->flush();


    }

    public function loadRattrapages(){
        $rattrapage = new Rattrapage();
        $rattrapage->setSurveillant($this->getReference('maxence'))
        ->setIntervenant($this->getReference('Julien'))
        ->setModuleRattrapage($this->getReference('maths'))
        ->setPDF("PDF")
        ->setDateRattrapage(new \DateTime())
        ->setDureeRattrapage(date_create_from_format("h:i","2:00"))
        ->setCorrige("PDFCorrige")
        ->setSupportSonore(true)
        ->setEtatRattrapage(0)
        ->setClasse($this->getReference('B1'));

        
    
        $this->addReference('rattrapageMaths', $rattrapage);
        $this->manager->persist($rattrapage);

        $this->manager->flush();
    }

    public function loadEleveRattrapages(){
        $eleveRattrapage = new EleveRattrapage();
        $eleveRattrapage->setRattrapage($this->getReference('rattrapageMaths'))
        ->setEleve($this->getReference('Fabien'))
        ->setARendu(true)
        ->setNote(18)
        ->setDateHeureFin(new \DateTime());

        $this->manager->persist($eleveRattrapage);

        $this->manager->flush();

    }
    

}
