<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/book/add', name: 'book_add', methods: ['GET', 'POST'])]
    public function add(Request $request, ManagerRegistry $registry): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository = new BookRepository($registry);
            $bookRepository->createBook($book);
            return $this->redirectToRoute('book_list');
        }

        return $this->render('book/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
