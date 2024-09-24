<?php

namespace App\Controller;

use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class RoomController extends AbstractController
{
    #[Route('api/room/index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rooms = $entityManager->getRepository(Room::class)->findAll();

        return $this->json($rooms, 200, [], [
            'groups' => ['room.index']
        ]);
    }
    
    #[Route('api/room/{id}')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $room = $entityManager->getRepository(Room::class)->find($id);

        return $this->json($room, 200, [], [
            'groups' => ['room.show']
        ]);
    }
}
