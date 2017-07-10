<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 22:40
 */

namespace MentorBundle\Manager;

use Doctrine\ORM\EntityManager;

abstract class Manager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    abstract public function findAll();

    abstract public function findBy($search);

    abstract public function save($formData);

    abstract public function delete();

    protected function persistAndFlush($data)
    {
        $this->em->persist($data);
        $this->em->flush();
    }
}
