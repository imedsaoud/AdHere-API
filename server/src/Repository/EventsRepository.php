<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 14/02/2020
 * Time: 01:27
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EventRepository extends EntityRepository
{
    public function getEventsBetweenDates(string $beginDate, string $endDate): Array
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder();
        $qb->select('e')
            ->from('Event', 'e')
            ->where('e.evtDateStart >= :beginDate')
            ->andWhere('e.evtDateEnd >= :endDate')
            ->orderBy('u.name', 'ASC')
            ->setParameter('evtDateStart', $beginDate)
            ->setParameter('evtDateEnd', $endDate)
        ;

        return $qb->getQuery()->getResult();
    }

}
