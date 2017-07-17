<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 11/07/2017
 * Time: 13:59
 */

namespace MentorBundle\Repository;


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
}
