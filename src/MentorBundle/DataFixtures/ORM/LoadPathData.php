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
        $path2 = new Path();
        $path2->setName('Développeur web junior');
        $manager->persist($path);
        $manager->persist($path2);
        $manager->flush();


        $this->addReference('path1', $path);
        $this->addReference('path2', $path2);
    }
    public function getOrder()
    {
        return 1;
    }
}