<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 10/06/2017
 * Time: 22:54
 */

namespace MentorBundle\Form\EventListener;


use Doctrine\ORM\EntityManager;
use MentorBundle\Entity\Student;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddSessionListener implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        );
    }

    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();

        if (!$data) return;

        $student = $data['student'];

        if ($this->em->getRepository('MentorBundle:Student')->find($student['id'])) return;

        if (strlen($student['fullname']) === 0) {
            $event->getForm()->addError(new FormError('Vous devez indiquer un étudiant.'));
            return;
        }

        $elmts = explode(" ", $student['fullname']);

        $newStudent = new Student();
        $newStudent
            ->setFirstname($elmts[0])
            ->setLastname($elmts[1])
            ->setPath($this->em->getRepository('MentorBundle:Path')->find($student['path']));

        $this->em->persist($newStudent);
        $this->em->flush();

        $data['student'] = [
            'id' => $newStudent->getId()
        ];

        $event->setData($data);
    }
}
