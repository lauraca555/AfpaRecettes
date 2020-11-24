<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/compte", name="account")
     */
    public function index(): Response
    {
        
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);

    }

    /**
     * @Route("/compte_admin", name="admin_account")
     */
    public function index_Admin(): Response
    {
        
        return $this->render('admin/account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
