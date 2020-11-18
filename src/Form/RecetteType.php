<?php

namespace App\Form;

use App\Entity\Recipy;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "label" => "Non de la recette",
                "required" => false,
                "attr" => [
                    "placeholder" => "Nom de la recette"
                ]
                
            ])
            ->add('categorie', EntityType::class,[
                "label" => "Choix de catégorie",
                "class" => Categorie::class,
                "choice_label" => "nom"
                ]
            )
            ->add('resumer', TextType::class, [
                "label" => "Résumé de la recette",
                "required" => false,
                "attr" => [
                "placeholder" => "Saisir un petit resumé de la recette"
                ]
            ])
            ->add('temps', TextType::class, [
                "label" => "Temps de cuisson",
                "required" => false,
                "attr" => [
                    "placeholder" => "Chosir la durée de cuisson"
                ]
            ])
            ->add('preparation', TextareaType::class, [
                "required" => false,    
                "attr" => [
                        "rows" => 8
                ]
            ])
            ->add('convives', TextType::class,[
                "label" => "Numéro de convives",
                "required" => false,
                "attr" => [
                    "placeholder" => "Numéro de convives"
                ]
            ])
            ->add('imageFile',FileType::class,[
                    "label"=> "Image de la recette",
                    "required" => false,
            ])
            
            
            //->add('createdAd')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipy::class,
        ]);
    }
}
