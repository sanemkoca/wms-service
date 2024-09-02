<?php

namespace App\Controller;

use App\Entity\BorrowRecord;
use App\Form\BorrowRecordType;
use App\Repository\BookRepository;
use App\Repository\BorrowRecordRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BorrowController extends AbstractController
{
    #[Route('/borrow/add', name: 'borrow_book', methods: ['GET', 'POST'])]
    public function add(Request $request, ManagerRegistry $registry): Response
    {
        $bookRepository = new BookRepository($registry);
        $book = $bookRepository->findBookById($request->query->get('recordId'));

        $borrowRecord = new BorrowRecord();
        if ($book) {
            $borrowRecord->setBookId($book);
        }

        $form = $this->createForm(BorrowRecordType::class, $borrowRecord);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $borrowRecordRepository = new BorrowRecordRepository($registry);
            $borrowRecordRepository->borrowBook($borrowRecord);
            return $this->redirectToRoute('book_list');
        }

        return $this->render('borrow/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/book/return/{recordId}', name: 'return_book', methods: ['GET'])]
    public function return($recordId, ManagerRegistry $registry): Response
    {
        $bookRepository = new BookRepository($registry);
        $book = $bookRepository->findBookById($recordId);
        $borrowRecordRepository = new BorrowRecordRepository($registry);
        $borrowRecordRepository->returnBook($book);

        return $this->redirectToRoute('book_list');
    }
}
