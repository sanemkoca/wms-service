<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
