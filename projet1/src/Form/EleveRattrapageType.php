<?php

namespace App\Form;

use App\Entity\EleveRattrapage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EleveRattrapageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('Note', TextType::class)*/
            /*->add('DateHeureFin', DateType::class)*/
            ->add('eleve', EntityType::class,
            array( 'class' => 'App\Entity\Eleve',
            'choice_label' => 'Nom'))
            ->add('rattrapage', EntityType::class,
            array( 'class' => 'App\Entity\Rattrapage',
            'choice_label' => 'id'))
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EleveRattrapage::class,
        ]);
    }
}
