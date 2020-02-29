<?php

namespace App\Controller;

use App\Entity\StationDistanceEvent;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventStationsDistanceController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/eventDistanceStations", name="get_eventDistanceStations")
     * @Method("GET")
     */
    public function findEventsByDate(Request $request): JsonResponse
    {
        $eventIds = $request->get('eventIds');
        $meterRange = $request->get('meterRange');

        if ($eventIds !== null && $meterRange !==null ) {
            $eventIdsTab = explode(",", $eventIds);
            foreach ($eventIdsTab as $eventId){
                $eventDistanceStations = $this->em->getRepository(StationDistanceEvent::class)->getEventDistanceStation($eventId,$meterRange);
                if ($eventDistanceStations === null) {
                    return new JsonResponse('Sorry no station around',404);    
                }
                foreach ($eventDistanceStations as $eventDistanceStation) {
                    $response[] = array(
                        'id_event' => $eventDistanceStation->getIdEvents()->getId(),
                        'id_station' => $eventDistanceStation->getIdStation()->getId(),
                    );
                }
                return new JsonResponse($response,200);
            }
        }
        return new JsonResponse('Missing Parameter', 400);
    }
}
