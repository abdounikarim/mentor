<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Price;

class LoadPriceData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $price = new Price();
        $price->setPrice(30);

        $manager->persist($price);
        $manager->flush();

        $this->addReference('price1', $price);
    }

    public function getOrder()
    {
        return 2;
    }
}