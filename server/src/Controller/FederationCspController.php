<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 14/02/2020
 * Time: 01:46
 */

namespace App\Controller;



use App\Entity\FederationCsp;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class FederationCspController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/federationCsp", name="get_federationsCsp")
     * @Method("GET")
     */
    public function findFederationCsp(Request $request): JsonResponse
    {
        $federationIds = $request->get('federationIds');

        if ($federationIds === null) {
            $federationsCsp = $this->em->getRepository(FederationCsp::class)->findAll();
            foreach ($federationsCsp as $result) {
                $response[] = array(
                    'id' => $result->getId(),
                    'ouvrier' => $result->getOuvrier(),
                    'inactif' => $result->getInactif(),
                    'employe' => $result->getEmploye(),
                    'profinter' => $result->getProfinter(),
                    'retraite' => $result->getRetraite(),
                    'cadre' => $result->getCadre()
                );
            }
            return new JsonResponse($response, 200);
        } else {
            $federationIdsTab = explode(",", $federationIds);
            foreach ($federationIdsTab as $id) {
                $federationCsp = $this->em->getRepository(FederationCsp::class)->find($id);
                $response[] = array(
                    'id' => $federationCsp->getId(),
                    'ouvrier' => $federationCsp->getOuvrier(),
                    'inactif' => $federationCsp->getInactif(),
                    'employe' => $federationCsp->getEmploye(),
                    'profinter' => $federationCsp->getProfinter(),
                    'retraite' => $federationCsp->getRetraite(),
                    'cadre' => $federationCsp->getCadre()
                );
            }
            return new JsonResponse($response, 200);
        }
    }

}
