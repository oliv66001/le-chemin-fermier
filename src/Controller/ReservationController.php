<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(CalendarRepository $calendar, UserInterface $user): Response
    {
        $user = $this->getUser();
        
        $events = $calendar->findAll();
        $rdvs = [];
        
            
         foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'dateStart' => $event->getDateStart()->format('Y-m-d H:i:s'),
                'timeStart' => $event->getTimeStart(),
                'timeEnd' => $event->getTimeEnd(),
                'nbOfPeople' => $event->getNbOfPeople(),
                'reservationTableId' => $event->getReservationTableId(),
               
            ];
        }

        $data = json_encode($rdvs);
        return $this->render('reservation/index.html.twig', compact('data'));
    }
}
