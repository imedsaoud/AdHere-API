<?php

namespace App\Controller;

use App\Entity\FederationSexeAgeRange;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FederationSexeAgeRangeController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/federationAudienceCount", name="get_federations_audience_count")
     * @Method("GET")
     */
    public function findFederationAudienceCount(Request $request): JsonResponse
    {
        $sexe = $request->get('sexe');
        $ageRanges = $request->get('ageRanges');
        $federationIds = $request->get('federationIds');

        if ($sexe !== null && $ageRanges !== null && $federationIds !== null) {
            $federationIdsTab = explode(",", $federationIds);
            $federationAgeRangesTab = explode(",", $ageRanges);
            $federationSexes = explode(",", $sexe);
            foreach ($federationIdsTab as $federationid) {
                foreach ($federationAgeRangesTab as $federationAgeRange) {
                    foreach ($federationSexes as $federationSexe) {
                        $federationsSar = $this->em->getRepository(FederationSexeAgeRange::class)->findBy(array('idFederation'=>$federationid,'sexe'=>$federationSexe,'ageRange'=>$federationAgeRange));
                        foreach ($federationsSar as $federationSar)
                            $response[] = array(
                                'idFederation' => $federationSar->getIdFederation()->getId(),
                                'ageRange'=>$federationSar->getAgeRange(),
                                'sexe'=>$federationSar->getSexe(),
                                'count' => $federationSar->getCount()
                            );
                    }
                }
            }

            $totalCount = 0;
            foreach ($response as $item) {
                $totalCount += $item['count'];
            }
            $finalResponse[] = array(
                'audience_count' => $totalCount
            );
            

            
            return new JsonResponse($finalResponse,200);
        }
        return new JsonResponse('Missing Parameter', 400);
    }

}
