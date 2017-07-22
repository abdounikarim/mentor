<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 18:25
 */

namespace MentorBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MentorBundle\Entity\Session;
use MentorBundle\Entity\User;

class SessionRepository extends EntityRepository
{
    use Crud;

    private $query;

    public function findAll(){
        return $this->findBy([], ['date' => 'DESC']);
    }

    public function findAllByUser(User $user)
    {
        return $this->findBy(['mentor' => $user], ['date' => 'DESC']);
    }

    public function getBillDataByUserAndPeriod($month, $year, User $mentor)
    {
        $this->query = $this->createQueryBuilder('s')
            ->addSelect('s.noshow')
            ->innerJoin('s.project', 'p')
                ->addSelect('p')
            ->innerJoin('p.level', 'l')
                ->addSelect('l.name')
            ->innerJoin('l.price', 'pri')
                ->addSelect('pri.price')
            ->addSelect('COUNT(s)');

        $this->getByPeriod($month, $year);
        $this->getByUser($mentor);

        $this->query
            ->groupBy('p.level, s.noshow')
            ->orderBy('s.noshow');

        return $this->query->getQuery()->getResult();
    }

    public function findAllByUserAndPeriod($month, $year, User $mentor)
    {
        $this->query = $this->createQueryBuilder('s')
            ->select('s');

        $this->getByUser($mentor);
        $this->getByPeriod($month, $year);

        $this->query->orderBy('s.date', 'DESC');

        return $this->query->getQuery()->getResult();
    }

    public function create(Session $session, User $user)
    {
        $session->setMentor($user);
        $this->save($session);
    }

    public function update()
    {
    }

    private function getByPeriod($month, $year)
    {
        return $this->query
            ->andwhere('MONTH(s.date) = :month')
                ->setParameter('month', $month)
            ->andWhere('YEAR(s.date) = :year')
                ->setParameter('year', $year);
    }

    private function getByUser(User $mentor)
    {
        return $this->query
            ->andWhere('s.mentor = :mentor')
                ->setParameter('mentor', $mentor);
    }
}
