<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/06/2017
 * Time: 11:12
 */

namespace MentorBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Level;

class LoadLevelData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $level = new Level();
        $level
            ->setName('de base')
            ->setPrice($this->getReference('price1'));

        $level2 = new Level();
        $level2
            ->setName('intermédiaire')
            ->setPrice($this->getReference('price2'));

        $manager->persist($level);
        $manager->persist($level2);
        $manager->flush();

        $this->addReference('level1', $level);
        $this->addReference('level2', $level2);
    }

    public function getOrder()
    {
        return 3;
    }
}
