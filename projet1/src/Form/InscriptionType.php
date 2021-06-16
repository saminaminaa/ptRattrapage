<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('roles', ChoiceType::class, array(
                'attr'  =>  array('class' => 'form-control',
                'style' => 'margin:5px 0;'),
                'choices' => 
                array
                (
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_INTERVENANT' => 'ROLE_INTERVENANT',
                    'ROLE_SURVEILLANT' => 'ROLE_SURVEILLANT',
                    'ROLE_RESPONSABLE' => 'ROLE_RESPONSABLE'
                ) 
                ,
                'multiple' => true,
                'required' => true,
                )
            )            ->add('inscrire',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
