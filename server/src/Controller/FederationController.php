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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
    public function findFederations(Request $request): JsonResponse
    {
        $federationIds = $request->get('federationIds');

        if ($federationIds === null) {
            $federations = $this->em->getRepository(Federation::class)->findAll();
            foreach ($federations as $result) {
                $response[] = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'count' => $result->getCount()
                );
            }
            return new JsonResponse($response, 200);
        }
            $federationIdsTab = explode(",", $federationIds);
            foreach ($federationIdsTab as $id) {
                $federation = $this->em->getRepository(Federation::class)->find($id);

                $response[] = array(
                    'id' => $federation->getId(),
                    'count' => $federation->getCount()
                );
            }
            return new JsonResponse($response, 200);
    }

}
