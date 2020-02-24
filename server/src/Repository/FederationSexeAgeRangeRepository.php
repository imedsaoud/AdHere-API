<?php

namespace App\Repository;

use App\Entity\FederationSexeAgeRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FederationSexeAgeRange|null find($id, $lockMode = null, $lockVersion = null)
 * @method FederationSexeAgeRange|null findOneBy(array $criteria, array $orderBy = null)
 * @method FederationSexeAgeRange[]    findAll()
 * @method FederationSexeAgeRange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FederationSexeAgeRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FederationSexeAgeRange::class);
    }

    // /**
    //  * @return FederationSexeAgeRange[] Returns an array of FederationSexeAgeRange objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FederationSexeAgeRange
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
