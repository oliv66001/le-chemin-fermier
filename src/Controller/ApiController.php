<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Calendar $calendar, Request $request)
    {
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->dateStart) && !empty($donnees->dateStart) &&
            isset($donnees->dateEnd) && !empty($donnees->dateEnd) &&
            isset($donnees->timeStart) && !empty($donnees->timeStart) &&
            isset($donnees->timeEnd) && !empty($donnees->timeEnd) &&
            isset($donnees->nbOfPeople) && !empty($donnees->nbOfPeople) &&
            isset($donnees->reservationTableId) && !empty($donnees->reservationTableId)
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$calendar){
                // On instancie un rendez-vous
                $calendar = new Calendar;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $calendar->setDateStart(new DateTime($donnees->dateStart));
            $calendar->setDateEnd(new DateTime($donnees->dateEnd));
            $calendar->setTimeStart($donnees->timeStart);
            $calendar->setTimeEnd($donnees->timeEnd);
            $calendar->setNbOfPeople($donnees->nbOfPeople);
            $calendar->setReservationTableId($donnees->reservationTableId);

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
