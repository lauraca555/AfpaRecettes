<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Recipy;
use App\Entity\Categorie;
use App\Form\RecetteType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $entree= (new Categorie())->setNom('Entréé');
        $plat= (new Categorie())->setNom('Plat');
        $dessert= (new Categorie())->setNom('Dessert');
        $categories = [$entree,$plat,$dessert];

        $manager->persist($entree);
        $manager->persist($plat);
        $manager->persist($dessert);
        $manager->flush();
        
        for ($i=0; $i <=50; $i++){
            $recette = new Recipy();
            $recette
            ->setTitle($faker->name())
            ->setResumer($faker->sentence())
            ->setPreparation($faker->text(500))
            ->setConvives($faker->randomDigit())
            ->setTemps($faker->randomDigit() . " min")
            ->setCategorie($faker->randomElement($categories));
            
            $manager->persist($recette);
        }
        
        $manager->flush();
    }
}
