<?php

namespace App\Controller;

use DateTime;
use App\Entity\Recipy;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\Notification;
use App\Repository\RecipyRepository;


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
    public function contact(Request $request, Notification $notification)
    {   
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
            {
               $notification->notifyContact($contact);  
               $this->addFlash('success', 'Votre email a bien été envoyé');
                return $this->redirectToRoute('index',[], 301);              
            }

        return $this->render('home/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

}