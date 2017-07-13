<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Price;

class LoadPriceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $price = new Price();
        $price->setPrice(30);
        $price2 = new Price();
        $price2->setPrice(35);
        $price3 = new Price();
        $price3->setPrice(40);
        $manager->persist($price);
        $manager->persist($price2);
        $manager->persist($price3);
        $manager->flush();
        $this->addReference('price1', $price);
        $this->addReference('price2', $price2);
        $this->addReference('price3', $price3);
    }
    public function getOrder()
    {
        return 2;
    }
}