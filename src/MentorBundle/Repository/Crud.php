<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 11/07/2017
 * Time: 13:59
 */

namespace MentorBundle\Repository;


use Doctrine\ORM\Tools\Pagination\Paginator;

trait Crud
{
    abstract public function create();
    abstract public function update();

    public function delete($item)
    {
        $this->_em->remove($item);
        $this->_em->flush();
    }

    public function save($item)
    {
        $this->_em->persist($item);
        $this->_em->flush();
    }

    protected function paginate($page = 1, $limit)
    {
        $paginator = new Paginator($this->query);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
    }

}
