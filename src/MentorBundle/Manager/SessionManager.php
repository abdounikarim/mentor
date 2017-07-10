<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 22:28
 */

namespace MentorBundle\Manager;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SessionManager extends Manager
{
    protected $repository;
    private $mentor;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        parent::__construct($em);
        $this->repository = $this->em->getRepository('MentorBundle:Session');
        $this->mentor = $tokenStorage->getToken()->getUser();
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findAllByUser()
    {
        return $this->repository->findBy(['mentor' => $this->mentor]);
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

    public function getByMonth($request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        return $this->repository->getByMonth($month, $year, $this->mentor);
    }

    public function findBy($search)
    {
        // TODO: Implement findBy() method.
    }
}
