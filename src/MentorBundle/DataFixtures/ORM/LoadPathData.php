<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Path;

class LoadPathData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [
            'Chef de projet développement',
            'Chef de projet design',
            'Chef de projet marketing',
            'Développeur web junior',

        ];
        foreach ($datas as $data)
        {
            $path = new Path();
            $path->setName($data);
            $manager->persist($path);
        }
        $manager->flush();
    }
}