<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Path;

class LoadPathData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $cdpDes = new Path();
        $cdpDes->setName('CDP Design');
        $cdpDev = new Path();
        $cdpDev->setName('CDP Développement');
        $cdpMark = new Path();
        $cdpMark->setName('CDP Marketing');
        $dwj = new Path();
        $dwj->setName('Développeur web junior');
        $daf = new Path();
        $daf->setName('DA FrontEnd');
        $dasf = new Path();
        $dasf->setName('DA PHP/Symfony');
        $daj = new Path();
        $daj->setName('DA Java');
        $eii = new Path();
        $eii->setName('Expert en ingénierie informatique');
        $manager->persist($cdpDes);
        $manager->persist($cdpDev);
        $manager->persist($cdpMark);
        $manager->persist($dwj);
        $manager->persist($daf);
        $manager->persist($dasf);
        $manager->persist($daj);
        $manager->persist($eii);
        $manager->flush();
        $this->addReference('cdpDes', $cdpDes);
        $this->addReference('cdpDev', $cdpDev);
        $this->addReference('cdpMark', $cdpMark);
        $this->addReference('dwj', $dwj);
        $this->addReference('daf', $daf);
        $this->addReference('dasf', $dasf);
        $this->addReference('daj', $daj);
        $this->addReference('eii', $eii);
    }
    public function getOrder()
    {
        return 1;
    }
}