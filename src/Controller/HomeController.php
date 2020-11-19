<?php

namespace App\Controller;

use DateTime;
use App\Entity\Recipy;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\RecipyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController

{   
    
    /**
     * @Route("/", name="index")
     */
    public function index(RecipyRepository $recyRepository )
    {
        $recettes = $recyRepository->findBy([], ['id' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'recettes' => $recettes
            
        ]);
    }


    /**
     * @Route ("/contact", name="home_contact")
     */
    public function contact(Request $request)
    {   
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        return $this->render('home/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

}