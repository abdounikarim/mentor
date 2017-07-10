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
    public function findAll(){
        return $this->findBy([], array('date' => 'DESC'));
    }

    public function getByMonth($month, $year, $user)
    {
        $query = $this->createQueryBuilder('s')
            ->addSelect('s.noshow')
            ->innerJoin('s.project', 'p')
                ->addSelect('p')
            ->innerJoin('p.level', 'l')
                ->addSelect('l.name')
            ->innerJoin('l.price', 'pri')
                ->addSelect('pri.price')
            ->addSelect('COUNT(s)')
            ->where('MONTH(s.date) = :month')
                ->setParameter('month', $month)
            ->andWhere('YEAR(s.date) = :year')
                ->setParameter('year', $year)
            ->andWhere('s.mentor = :mentor')
                ->setParameter('mentor', $user)
            ->groupBy('p.level, s.noshow')
            ->orderBy('p.level')
            ->getQuery();

        return $query->getResult();
    }
}
