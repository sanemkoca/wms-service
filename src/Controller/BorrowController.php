<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BorrowController extends AbstractController
{
    #[Route('/borrows', name: 'app_borrows')]
    public function index(): Response
    {
        return $this->render('borrow/index.html.twig', [
            'controller_name' => 'BorrowController',
        ]);
    }
}
