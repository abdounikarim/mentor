<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 23:38
 */

namespace MentorBundle\Manager;


use Doctrine\ORM\EntityManager;

class ProjectManager extends Manager
{
    protected $repository;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->repository = $em->getRepository('MentorBundle:Project');
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function findBy($search)
    {
        return $this->repository->findBy($search);
    }

    public function save($formData)
    {
        // TODO: Implement save() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}