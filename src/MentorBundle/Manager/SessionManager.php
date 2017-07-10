<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 22:28
 */

namespace MentorBundle\Manager;


use Doctrine\ORM\EntityManager;

class SessionManager extends Manager
{
    protected $repository;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->repository = $this->em->getRepository('MentorBundle:Session');
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOne()
    {
        // TODO: Implement findOne() method.
    }

    public function save($session)
    {
        $this->persistAndFlush($session);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function countByMonth($month, $year)
    {
        return $this->repository->countByMonth($month, $year);
    }

    public function findBy($search)
    {
        // TODO: Implement findBy() method.
    }
}
