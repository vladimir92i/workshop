<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('api/user/index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(Users::class)->findAll();

        return $this->json($users, 200, [], [
            'groups' => ['user.index']
        ]);
    }
    
    #[Route('api/user/{id}')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $users = $entityManager->getRepository(Users::class)->find($id);

        return $this->json($users, 200, [], [
            'groups' => ['user.show']
        ]);
    }
}
