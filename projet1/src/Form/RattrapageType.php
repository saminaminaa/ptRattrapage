<?php

namespace App\Form;

use App\Entity\Rattrapage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RattrapageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PDF')
            ->add('DateRattrapage')
            ->add('DureeRattrapage')
            ->add('Corrige')
            ->add('SupportSonore')
            ->add('EtatRattrapage')
            ->add('surveillant')
            ->add('intervenant')
            ->add('moduleRattrapage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rattrapage::class,
        ]);
    }
}
