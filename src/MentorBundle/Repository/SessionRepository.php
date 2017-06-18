<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 18:25
 */

namespace MentorBundle\Repository;


use Doctrine\ORM\EntityRepository;

class SessionRepository extends EntityRepository
{
    public function findByMonth($month)
    {
        $query = $this->createQueryBuilder('s')
            ->select('s')
            ->where('MONTH(s.date) = :month')
                ->setParameter('month', $month)
            ->getQuery();

        return $query->getResult();
    }
}
