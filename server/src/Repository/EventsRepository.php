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


class EventsRepository extends EntityRepository
{

    public function getEventsBetweenDates(string $beginDate, string $endDate): Array
    {

        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder();
        $qb->select('e')
            ->from('Events', 'e')
            ->where('e.date_start >= :beginDate')
            ->andWhere('e.date_end >= :endDate')
            ->orderBy('u.name', 'ASC')
            ->setParameter('dateStart', $beginDate)
            ->setParameter('dateEnd', $endDate)
        ;

        return $qb->getQuery()->getResult();
    }

}
