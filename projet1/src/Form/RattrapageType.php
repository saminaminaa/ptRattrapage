<?php

namespace App\Form;

use App\Entity\Rattrapage;
use App\Entity\ModuleRattrapage;
use App\Entity\Utilisateur;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RattrapageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('Classe',EntityType::class,array("class"=>"App\Entity\Classe","choice_label"=>"libelle"))
            ->add('moduleRattrapage',EntityType::class,array("class"=>"App\Entity\ModuleRattrapage","choice_label"=>"libelle"))
            //->add('PDF', TextType::class)
            ->add('Surveillant',EntityType::class,array("class"=>"App\Entity\Utilisateur","choice_label"=>"nom"))
            ->add('Intervenant',EntityType::class,array("class"=>"App\Entity\Utilisateur","choice_label"=>"nom"))
            ->add('DateRattrapage', DateType::class)
            ->add('DureeRattrapage', TimeType::class)
            ->add('Corrige', TextType::class)
            //->add('SupportSonore')
            //->add('EtatRattrapage')
            //->add('surveillant')
            //->add('intervenant')
            //->add('moduleRattrapage')
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rattrapage::class,
        ]);
    }
}
