<?php

namespace App\Controller;

use App\Repository\RecipyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipyController extends AbstractController

{
    /**
     * @Route("/recette/{id}", name="recette_show")
     */

    public function show(int $id, RecipyRepository $recetteRepository)
    {
        $recette = $recetteRepository->find($id);
        // renders templates/index/number.html.twig
        return $this->render('recettes/recipy.html.twig', [
            'recette' => $recette,
            'menu' => 'recette'
        ]);
    }
}