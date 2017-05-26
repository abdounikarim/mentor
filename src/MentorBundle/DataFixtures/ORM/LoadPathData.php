<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Path;

class LoadPathData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $path = new Path();
        $path->setName('Chef de projet développement');

        $path2 = new Path();
        $path2->setName('Chef de projet design');

        $path3 = new Path();
        $path3->setName('Chef de projet marketing');
    }
}