<?php

namespace App\Controller;

use App\Entity\Events;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpClientKernel;
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
     * @Route("/events", name="get_eventsByDate")
     * @Method("GET")
     */
    public function findEventsByDate(Request $request): JsonResponse
    {
        $beginDate = $request->get('begin');
        $endDate = $request->get('end');

        if ($beginDate !== null && $endDate !== null) {
            return new JsonResponse($this->em->getRepository(Events::class)->getEventsBetweenDates($beginDate,$endDate));
        }
        return new JsonResponse($this->em->getRepository(Events::class)->findAll(), 200);
    }

    /**
     * @Route("/events/{id}", name="get_event_by_id")
     * @Method("GET")
     */
    public function findEventsById(int $id): JsonResponse
    {
        $event = $this->em->getRepository(Events::class)->find($id);

        if ($event === null) {
            return new JsonResponse(null, 404);
        }

        $response[] = array(
            'id' => $event->getId(),
            'Name' => $event->getGeoName(),
            'Lat' => $event->getGeoLat(),
        );



        return new JsonResponse($response, 200);
    }
}
