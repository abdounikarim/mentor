<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/06/2017
 * Time: 16:09
 */

namespace MentorBundle\Form\DataTransformer;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;

class StudentAutocompleteTranformer implements DataTransformerInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function transform($value)
    {
        if (null === $value) {
            return;
        }
        return $value->getFirstname() . ' ' . $value->getName();
    }

    public function reverseTransform($value)
    {
        if (null === $value['id']) {
            return;
        }
        return $this->em->getRepository('MentorBundle:Student')->find($value['id']);
    }
}
