<?php

namespace App\Repository;

use App\Entity\BorrowRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BorrowRecord>
 */
class BorrowRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BorrowRecord::class);
    }

    public function borrowBook($borrowRecord): void
    {
        $borrowRecord->getBookId()->setBorrowed(true);
        $borrowRecord->setBorrowedAt(new \DateTime());

        $this->getEntityManager()->persist($borrowRecord);
        $this->getEntityManager()->flush();
    }

    public function returnBook($book): void
    {
        $borrowRecord = $this->getEntityManager()->getRepository(BorrowRecord::class)->findOneBy(['bookId' => $book->getId(), 'returnedAt' => null]);
        $borrowRecord->getBookId()->setBorrowed(false);
        $borrowRecord->setReturnedAt(new \DateTime());

        $this->getEntityManager()->persist($borrowRecord);
        $this->getEntityManager()->flush();
    }
}
