<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/books', name: 'book_list', methods: ['GET'])]
    public function listBooks(ManagerRegistry $registry): Response
    {
        $bookRepository = new BookRepository($registry);
        $list = $bookRepository->listBook();
        return $this->render('book/list.html.twig', ['books' => $list]);
    }
}
