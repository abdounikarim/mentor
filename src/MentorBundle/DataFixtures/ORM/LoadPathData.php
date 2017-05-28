<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Path;

class LoadPathData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $path = new Path();
        $path->setName('Chef de Projet Développement');
        $manager->persist($path);
        $manager->flush();

        $this->addReference('path1', $path);
    }
    public function getOrder()
    {
        return 1;
    }
}