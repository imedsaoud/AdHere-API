<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 14/02/2020
 * Time: 01:46
 */

namespace App\Controller;


use App\Entity\Events;
use App\Entity\Federation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\HttpClientKernel;


class FederationController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/federations", name="get_federations")
     * @Method("GET")
     */
    public function findFederations(): JsonResponse
    {
        $federations = $this->em->getRepository(Federation::class)->findAll();

        foreach ($federations as $result) {
            $response[] = array(
                'id' => $result->getId(),
            );
        }
        return new JsonResponse($federations, 200);
    }

    /**
     * @Route("/federations/{eventId}", name="get_federation_by_id")
     * @Method("GET")
     */
    public function findFederationByEventId(int $eventId): JsonResponse
    {
        $event = $this->em->getRepository(Event::class)->find($eventId);

        $federation = $this->em->getRepository(Federation::class)->findBy([
            'event' => $event
        ]);

        if ($federation === null) {
            return new JsonResponse(null, 404);
        }

        return new JsonResponse($federation, 200);
    }

    /**
     * @Route("/federations/events", name="get_federations")
     * @Method("GET")
     */
    public function findFederationByEventIds(Request $request): JsonResponse
    {
        $eventId = $request->get('eventIds');

        if ($eventId === null) {
            return new JsonResponse(null, 400);
        }

        $eventIds = implode(',', $eventId);

        foreach ($eventIds as $id) {
            $event = $this->em->getRepository(Event::class)->find($id);

            $result [] = $this->em->getRepository(Federation::class)->findBy([
                'event' => $event
            ]);
        }


        return new JsonResponse($result, 200);
    }
}
