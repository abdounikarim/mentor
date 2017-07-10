<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 23:30
 */

namespace MentorBundle\Manager;


use Doctrine\ORM\EntityManager;

class StudentManager extends Manager
{
    private $repository;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->repository = $em->getRepository('MentorBundle:Student');
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function findOne()
    {
        // TODO: Implement findOne() method.
    }

    public function findByTerm($term)
    {
        return $this->repository->findStudentsByTerm($term);
    }

    public function save($formData)
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