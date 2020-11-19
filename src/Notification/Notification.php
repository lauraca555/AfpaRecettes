<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Notification extends AbstractController
{
    private \Swift_Mailer $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route ("/contact", name="home_contact")
     */
    public function notifyContact(Contact $contact) 
    {
        $message = (new \Swift_Message('Test envoie de mail'))
                ->setFrom('exemple@gmail.fr')    
                ->setTo($contact->getEmail())
                ->setBody(
                    $this->render('email/contact.html.twig', [
                    'contact' => $contact
                        ]),
                        'text/html'
                    );
                $this->mailer->send($message);
                
    }
}