<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'book')]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'title', type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(name: 'author', type: 'string', length: 255)]
    private ?string $author = null;

    #[ORM\Column(name: 'isbn', type: 'string', length: 255)]
    private ?string $isbn = null;

    #[ORM\Column(name: 'page', type: 'integer')]
    private ?int $page = null;

    #[ORM\Column(name: 'is_borrowed', type: 'boolean', options: ['default' => false])]
    private ?bool $isBorrowed = false;

    /**
     * @var Collection<int, BorrowRecord>
     */
    #[ORM\OneToMany(targetEntity: BorrowRecord::class, mappedBy: 'book_id')]
    private Collection $borrowRecords;

    public function __construct()
    {
        $this->borrowRecords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(int $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function isBorrowed(): ?bool
    {
        return $this->isBorrowed;
    }

    public function setBorrowed(bool $isBorrowed): static
    {
        $this->isBorrowed = $isBorrowed;

        return $this;
    }

    /**
     * @return Collection<int, BorrowRecord>
     */
    public function getBorrowRecords(): Collection
    {
        return $this->borrowRecords;
    }

    public function addBorrowRecord(BorrowRecord $borrowRecord): static
    {
        if (!$this->borrowRecords->contains($borrowRecord)) {
            $this->borrowRecords->add($borrowRecord);
            $borrowRecord->setBookId($this);
        }

        return $this;
    }

    public function removeBorrowRecord(BorrowRecord $borrowRecord): static
    {
        if ($this->borrowRecords->removeElement($borrowRecord)) {
            // set the owning side to null (unless already changed)
            if ($borrowRecord->getBookId() === $this) {
                $borrowRecord->setBookId(null);
            }
        }

        return $this;
    }
}
