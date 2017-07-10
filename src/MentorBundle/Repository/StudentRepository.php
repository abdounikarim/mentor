<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 18:26
 */

namespace MentorBundle\Repository;


use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    public function findStudentsByTerm($term)
    {
        $query = $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.lastname LIKE :term')
                ->setParameter('term', '%'.$term.'%')
            ->orWhere('s.firstname LIKE :term')
                ->setParameter('term', '%'.$term.'%')
            ->getQuery();

        return $query->getResult();
    }
}
