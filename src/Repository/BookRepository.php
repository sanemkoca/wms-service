<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findBookById($bookId): Book
    {
        /** @var Book $book */
        $book = $this->getEntityManager()->getRepository(Book::class)->find($bookId);

        return $book;
    }

    public function listBook(): array
    {
        /** @var Book[] $books */
        $books = $this->getEntityManager()->getRepository(Book::class)->findAll();

        return $books;
    }

    public function createBook($book): void
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
    }
}
