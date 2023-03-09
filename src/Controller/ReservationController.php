<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(CalendarRepository $calendar): Response
    {
        $events = $calendar->findAll();

        $rdvs = [];

        foreach($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'dateStart' => $event->getDateStart()->format('d-m-Y'),
                'timeStart' => $event->getTimeStart()->format('H:i'),
                'nbOfPeople' => $event->getNbOfPeople(),
                'reservationTable' => $event->getReservationTable(),

            ];
        }

        $data = json_encode($rdvs);
        return $this->render('reservation/index.html.twig',compact ('data'));
    }
}
