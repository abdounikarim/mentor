<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 22:47
 */

namespace MentorBundle\Manager;


use Doctrine\ORM\EntityManager;

class PathManager extends Manager
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->repository = $this->em->getRepository('MentorBundle:Path');
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOne()
    {
        // TODO: Implement findOne() method.
    }

    public function save($data)
    {
        // TODO: Implement save() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function findBy($search)
    {
        // TODO: Implement findBy() method.
    }
}