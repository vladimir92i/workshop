<?php

namespace App\Controller;

use App\Entity\Events;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/api/event/index', name: 'api_event_index')]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {   
        $events = $entityManager->getRepository(Events::class)->findAll();

        return $this->json($events, 200, [], [
            'groups' => ['event.index']
        ]);
    }
    
    #[Route('/api/event/create', name: 'api_event_create')]
    public function create($entityManager): JsonResponse
    {   

        $event = new Events();
        $event->setTitle('Nom de l\'event');
        $event->setDescription('Blablablabla');
        $event->setValidation(NULL);
        $event->setMaxCapacity(90);
        // $event->setStartAt()

        // tell Doctrine you want to (eventually) save the event (no queries yet)
        $entityManager->persist($event);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->json(['succes' => 'event create']);
    }
}
