<?php

namespace App\Controller\Admin;

//use App\Entity\Categorie;
//use App\Form\RecetteType;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminCategoryController extends AbstractController
    { 
        private EntityManagerInterface $em;
        private CategorieRepository $repository;

        public function __construct(EntityManagerInterface $em, CategorieRepository $repository)
        {
            $this->em = $em; 
            $this->repository = $repository;  
        }

        /**
        * @Route ("/admin/categories", name="admin_categories_index") 
        */ 
        public function indexAdminCategorie():Response
        {
            $categories = $this->repository->findAll();
            return $this->render('admin/categories/indexCategories.html.twig', [
                'categories' => $categories
            ]);
        }

        /**
         * @Route ("/admin/categories/create_categorie", name="admin_create_categorie")
         */
        public function create(Request $request){
            $categorie = new Categorie();
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                    $this->em->persist($categorie);
                    $this->em->flush();
                    $this->addFlash(
                        'success',
                        "Votre categorie a été enregistré"
                    );
                    return $this->redirectToRoute('admin_categories_index', [], 301);
            }

            return $this->render('admin/categories/create_categorie.html.twig', [
                'formCategorie' => $form->createView()    
            ]);
        }

        /**
         * 
         * @Route ("/admin/categories/edit_categorie{id}", name="admin_categorie_edit")
         */
        public function edit(Request $request, int $id)
        {
            $categorie = $this->repository->find($id);
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                    $this->em->flush();
                    $this->addFlash(
                        'success',
                        "Votre categorie a bien été mise à jours"
                    );
                    return $this->redirectToRoute('admin_categories_index', [], 301);
            }

            return $this->render('admin/categories/edit_categorie.html.twig', [
                
                'formCategorie' => $form->createView()    
            ]);
        
        }

        /**
         * @Route ("/admin/categories/delete_categorie{id}", name="admin_delate_categorie")
         */
        public function delate(Request $request, int $id)
        {
            $categorie = $this->repository->find($id);
            if (!$categorie) {
                throw $this->createNotFoundException(
                    'La categorie avec id: '.$id. ' n\'existe pas'
                );
            }

            $this->em->remove($categorie);
            $this->em->flush();

            return $this->redirectToRoute('admin_categories_index', [], 301);

        }
        
          

    } 