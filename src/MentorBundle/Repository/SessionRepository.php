<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 18:25
 */

namespace MentorBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use MentorBundle\Entity\Session;
use MentorBundle\Entity\User;

class SessionRepository extends EntityRepository
{
    use Crud;

    const SESSIONS_PER_PAGE = 25;
    private $query;

    public function findAll(){
        return $this->findBy([], ['date' => 'DESC']);
    }

    public function findAllByUser(User $user, $currentPage = 1)
    {
        //return $this->findBy(['mentor' => $user], ['date' => 'DESC']);
        $this->query = $this->createQueryBuilder('s');
        $this->getByUser($user);
        $this->query->orderBy('s.date', 'DESC');

        return $this->paginate($currentPage);
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

    public function countByUser(User $user)
    {
        $query = $this->createQueryBuilder('s')
            ->where('s.mentor = :mentor')
                ->setParameter('mentor', $user)
            ->select('COUNT(s)');

        return $query->getQuery()->getSingleScalarResult();
    }

    public function paginate($page = 1, $limit = self::SESSIONS_PER_PAGE)
    {
        $paginator = new Paginator($this->query);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
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
