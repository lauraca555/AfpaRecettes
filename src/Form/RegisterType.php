<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 
           
                TextType::class, [
                    "label" => "Non d'utilisateur",
                    "required" => true,
                    "attr" => [
                        "placeholder" => "Choisir un nom d'utilisateur"
                    ]
                ])
            ->add('password', RepeatedType::class, [
                "type" => PasswordType::class,
                'invalid_message' => "Le mot de passe et la comfirmation doivent être identique.",
                'label' => 'Votre mot de passe',
                "required" => true,
                "first_options" => [
                    "label" => "Mot de passe",
                    
                ],
                "second_options" => [
                    "label" => "Comfirmez votre mot de passe",
                    
                ]
                   
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
    
        ]);
    }
}
