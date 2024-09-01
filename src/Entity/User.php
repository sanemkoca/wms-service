<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'users')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: 'surname', type: 'string', length: 255)]
    private ?string $surname = null;

    #[ORM\Column(name: 'phone', type: 'string', length: 255)]
    private ?string $phone = null;

    #[ORM\Column(name: 'email', type: 'string', length: 255)]
    private ?string $email = null;

    #[ORM\Column(name: 'gender', type: 'string', length: 255)]
    private ?string $gender = null;

    /**
     * @var Collection<int, BorrowRecord>
     */
    #[ORM\OneToMany(targetEntity: BorrowRecord::class, mappedBy: 'user_id')]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

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
            $borrowRecord->setUserId($this);
        }

        return $this;
    }

    public function removeBorrowRecord(BorrowRecord $borrowRecord): static
    {
        if ($this->borrowRecords->removeElement($borrowRecord)) {
            // set the owning side to null (unless already changed)
            if ($borrowRecord->getUserId() === $this) {
                $borrowRecord->setUserId(null);
            }
        }

        return $this;
    }
}
