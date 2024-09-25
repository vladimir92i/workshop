<?php

namespace App\Controller;

use App\Token;

use App\Entity\Events;
use App\Entity\Users;
use App\Entity\Reservations;

use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/api/events')]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {   
        $events = $entityManager->getRepository(Events::class)->findAll();

        return $this->json($events, 200, [], [
            'groups' => ['event.index']
        ]);
    }
    
    #[Route('/api/event/create')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {   
        $token = $request->query->get('token');
      
        if (!Token::Permission($token, 'Organization', $entityManager)){
            return $this->json(['unauthorized' => 'Bad permissions'], 401);
        }

        $title = $request->query->get('title');
        $creator_id = $request->query->get('creator_id');
        $description = $request->query->get('description');
        $max_capacity = $request->query->get('max_capacity');
        $start_at = $request->query->get('start_at');
        $end_at = $request->query->get('end_at');

        $creator_entity = $entityManager->getRepository(Users::class)->findOneBy(['token' => $token]);

        $start_at = date_create_immutable_from_format('Y-m-d H:i:s', $start_at);
        $end_at = date_create_immutable_from_format('Y-m-d H:i:s', $end_at);
        $created_at =  date_create_immutable("now");

        if ($title != NULL && is_string($title)) {
            $event = new Events();
            $event->setTitle($title);
        } else {
            return $this->json(['error' => 'Bad title resquest'], 400);
        }

        if ($creator_entity != NULL) {
            $event->setCreatorId($creator_entity);
        } else {
            return $this->json(['error' => 'Bad creator_id resquest'], 400);
        }

        if ($description != NULL) {
            $event->setDescription($description);
        } else {
            return $this->json(['error' => 'Bad description resquest'], 400);
        }
        
        if ($max_capacity != NULL && is_int($max_capacity)) {
            $event->setMaxCapacity($max_capacity);
        }

        $event->setStartAt($start_at);
        $event->setEndAt($end_at);
        $event->setCreatedAt($created_at);

        $entityManager->persist($event);
        $entityManager->flush();

        return $this->json(['succes' => 'Event created'], 201);
    }

    #[Route('/api/event/inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $token = $request->query->get('token');
        $user = Token::CheckUser($token, $entityManager);

        if (!$user){
            return $this->json(['unauthorized' => 'Token not found'], 400);
        }

        $id = $request->query->get('event_id');
        $event = $entityManager->getRepository(Events::class)->find($id);

        if(!$entityManager->getRepository(Reservations::class)->findOneBy(['user_id' => $user, 'event_id' => $event])){
            return $this->json(['unauthorized' => 'Already registered'], 400);
        }

        $reservation = new Reservations();
        $reservation->setUserId($user);
        $reservation->setEventId($event);

        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->json(['success' => 'Reservation complete'], 200);
    }
}