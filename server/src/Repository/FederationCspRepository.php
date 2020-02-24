<?php

namespace App\Repository;

use App\Entity\FederationCsp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FederationCsp|null find($id, $lockMode = null, $lockVersion = null)
 * @method FederationCsp|null findOneBy(array $criteria, array $orderBy = null)
 * @method FederationCsp[]    findAll()
 * @method FederationCsp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FederationCspRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FederationCsp::class);
    }

    // /**
    //  * @return FederationCsp[] Returns an array of FederationCsp objects
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
    public function findOneBySomeField($value): ?FederationCsp
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
