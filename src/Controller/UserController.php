<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user/list', name: 'user_list', methods: ['GET'])]
    public function listUser(ManagerRegistry $registry): Response
    {
        $userRepo = new UserRepository($registry);
        $userList = $userRepo->listUser();
        return $this->render('user/list.html.twig', ['users' => $userList]);
    }
}
