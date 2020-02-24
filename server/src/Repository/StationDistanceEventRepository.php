<?php

namespace App\Repository;

use App\Entity\StationDistanceEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StationDistanceEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method StationDistanceEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method StationDistanceEvent[]    findAll()
 * @method StationDistanceEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationDistanceEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StationDistanceEvent::class);
    }

    public function getEventDistanceStation(string $eventId, string $meterRange): Array
    {

        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('e');
        $qb
            ->where('e.distanceM <= :meterRange')
            ->andWhere('e.idEvents = :eventId')
            ->setParameter('meterRange', $meterRange)
            ->setParameter('eventId', $eventId)

        ;

        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return StationDistanceEvent[] Returns an array of StationDistanceEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StationDistanceEvent
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
