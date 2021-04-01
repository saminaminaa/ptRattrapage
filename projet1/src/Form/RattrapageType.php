<?php

namespace App\Form;

use App\Entity\Rattrapage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RattrapageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('PDF', TextType::class)
            ->add('DateRattrapage', DateType::class)
            ->add('DureeRattrapage', TimeType::class)
            ->add('Corrige', TextType::class)
            ->add('SupportSonore')
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
