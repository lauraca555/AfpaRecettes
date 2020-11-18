<?php

namespace App\Controller;


use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController

{
    /**
     * @Route("/categorie/{id}", name="categorie_show")
     */

    public function show(int $id, CategorieRepository $categorieRepository)
    {
        $categorie = $categorieRepository->find($id);
        // renders templates/index/number.html.twig
        return $this->render('categories/categorie.html.twig', [
            'categorie' => $categorie,
            
        ]);
    }
}