<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 03/06/2017
 * Time: 14:02
 */

namespace MentorBundle\Form\EventListener;


use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddSessionSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct($test, EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT => 'preSubmit',
            FormEvents::SUBMIT => 'submit',
            FormEvents::POST_SUBMIT => 'postSubmit'
        );
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        dump($data, $event->getForm()->getData());
        $idStudent = $data['student']['identity'];
        $student = $this->em->getRepository('MentorBundle:Student')->find($idStudent);

        $data['student'] = $student->getId();
        $dateSession = new \DateTime();
        //$data['date'] = \DateTime::createFromFormat('d/m/Y', $data['date']);
        dump(\DateTime::createFromFormat('d/m/y', $data['date']));
        $event->setData($data);
        $event->getForm()->setData($data);
        dump($event->getData(), $event->getForm()->getData());
    }

    public function submit(FormEvent $event)
    {
        dump($event->getData(), $event->getForm()->getData());

    }

    public function postSubmit(FormEvent $event)
    {
        dump($event->getData(), $event->getForm()->getData());
    }
}
