<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Recipy;
use App\Form\RecetteType;
use App\Repository\RecipyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRecetteController extends AbstractController
    { 
        private EntityManagerInterface $em;
        private RecipyRepository $repository;

        public function __construct(EntityManagerInterface $em, RecipyRepository $repository)
        {
            $this->em = $em; 
            $this->repository = $repository;  
        }
        

        /**
        * @Route ("/admin", name="admin_index") 
        */ 
        public function indexAdmin():Response
        {
            $recettes = $this->repository->findAll();
            return $this->render('admin/index.html.twig', [
                'recettes' => $recettes
            ]);
        }
        
        /**
         * @Route ("/create", name="admin_create")
         */

        public function create(Request $request){
            $recette = new Recipy();            
             
            

            $form = $this->createForm(RecetteType::class, $recette);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                    
                    $recette->setCreatedBy($this->getUser() );
                    $this->em->persist($recette);
                    
                    
                    $this->em->flush();

                    $this->addFlash(
                        'success',
                        "Votre recette a été enregistré"
                    );
                    
                    // Redirecting to account after valid recipy creation according to roles
                    if($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
                    {
                      return $this->redirectToRoute('admin_index', [], 301);  
                    } 
                    else
                    {
                        return $this->redirectToRoute('index', [], 301);  
                      }

                    
            }

            return $this->render('admin/create.html.twig', [
                'formRecette' => $form->createView()    
            ]);
        }

        /**
         * 
         * @Route ("/admin/edit{id}", name="admin_edit")
         */
        public function edit(Request $request, int $id)
        {
            $recette = $this->repository->find($id);
            $form = $this->createForm(RecetteType::class, $recette);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                    $this->em->flush();
                    $this->addFlash(
                        'success',
                        "Votre recette a bien été mise à jours"
                    );
                    
                    return $this->redirectToRoute('index', [], 301);
            }

            return $this->render('admin/edit.html.twig', [
                
                'formRecette' => $form->createView()    
            ]);
        
        }
        
        /**
         * @Route ("/admin/delete{id}", name="admin_delate_recipy")
         */
        public function delate(Request $request, int $id)
        {
            $recette = $this->repository->find($id);
            if (!$recette) {
                throw $this->createNotFoundException(
                    'Le produit avec id: '.$id. ' n\'existe pas'
                );
            }

            $this->em->remove($recette);
            $this->em->flush();

            return $this->redirectToRoute('index', [], 301);

        }
                

    } 