<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findUserById($userId): User
    {
        /** @var User $user */
        $user = $this->getEntityManager()->getRepository(User::class)->find($userId);

        return $user;
    }

    public function listUser(): array
    {
        /** @var User[] $users */
        $users = $this->getEntityManager()->getRepository(User::class)->findAll();

        return $users;
    }
}
