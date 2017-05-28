<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Project;

class LoadProjectData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setName('Créez et déployez un site en ligne');
        $project->setPath($this->getReference('path1'));
        $project->setPrice($this->getReference('price1'));

        $manager->persist($project);
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}