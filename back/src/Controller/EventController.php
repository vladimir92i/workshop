<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/api/event/index', name: 'api_event_index')]
    public function index(): Response
    {   
        
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
