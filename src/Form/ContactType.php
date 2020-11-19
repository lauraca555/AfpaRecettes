<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                "label" => "Nom",
                "required" => false,
                "attr" => [
                    "placeholder" => "Nom"
                ]                
            ])
            ->add('prenom', TextType::class, [
                "label" => "Nom",
                "required" => false,
                "attr" => [
                    "placeholder" => "Prenom"
                ]                
            ])
            
            ->add('email', EmailType::class, [
                "label" => "Email",
                "required" => false,
                "attr" => [
                "placeholder" => "Saisir votre mail"
                ]
            ])
            ->add('message', TextareaType::class, [
                "required" => false
            ]) 
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
