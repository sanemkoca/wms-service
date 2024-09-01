<?php

namespace App\Entity;

use App\Repository\BorrowRecordRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'borrowRecords')]
#[ORM\Entity(repositoryClass: BorrowRecordRepository::class)]
class BorrowRecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'borrowRecords')]
    #[ORM\JoinColumn(name: "book_id", referencedColumnName: "id", nullable: true)]
    private ?Book $bookId = null;

    #[ORM\ManyToOne(inversedBy: 'borrowRecords')]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: true)]
    private ?User $userId = null;

    #[ORM\Column(name: 'borrowed_at', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $borrowedAt = null;

    #[ORM\Column(name: 'returned_at', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $returnedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getBookId(): ?Book
    {
        return $this->bookId;
    }

    public function setBookId(?Book $bookId): static
    {
        $this->bookId = $bookId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getBorrowedAt(): ?\DateTimeInterface
    {
        return $this->borrowedAt;
    }

    public function setBorrowedAt(\DateTimeInterface $borrowedAt): static
    {
        $this->borrowedAt = $borrowedAt;

        return $this;
    }

    public function getReturnedAt(): ?\DateTimeInterface
    {
        return $this->returnedAt;
    }

    public function setReturnedAt(\DateTimeInterface $returnedAt): static
    {
        $this->returnedAt = $returnedAt;

        return $this;
    }
}
