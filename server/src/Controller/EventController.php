<?php

namespace App\Controller;

use App\Entity\Events;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/events", name="get_events_by_date_range")
     * @Method("GET")
     */
    public function findEventsByDate(Request $request): JsonResponse
    {
        $beginDate = $request->get('begin');
        $endDate = $request->get('end');

        if ($beginDate !== null && $endDate !== null) {
            $events = $this->em->getRepository(Events::class)->getEventsBetweenDates($beginDate,$endDate);
        } else {
            $events = $this->em->getRepository(Events::class)->findAll();
        }

        if ($events) {
            foreach ($events as $event) {
                $response[] = array(
                    'id' => $event->getId(),
                    'Geo_name' => $event->getGeoName(),
                    'Lat' => $event->getGeoLat(),
                    'Lng' => $event->getGeoLng(),
                    'Spectators' => $event->getSpectator(),
                    'Date_start' => $event->getDateStart(),
                    'Date_end' => $event->getDateEnd(),
                    'id_federation' => $event->getIdFederation()->getId()
                );
            }
            return new JsonResponse($response, 200);
        } else {
            return new JsonResponse('Sorry no Events for this date range',404);
        }
    }
}
