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

    #[Route('/user/add', name: 'user_add', methods: ['GET', 'POST'])]
    public function add(Request $request, ManagerRegistry $registry): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository = new UserRepository($registry);
            $userRepository->registerUser($user);
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
