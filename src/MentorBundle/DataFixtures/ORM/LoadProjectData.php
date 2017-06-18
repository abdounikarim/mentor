<?php

namespace MentorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentorBundle\Entity\Project;

class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setName('Créez et déployez un site en ligne');
        $project->setPath($this->getReference('path1'));
        $project->setLevel($this->getReference('level1'));

        $project2 = new Project();
        $project2->setName("Intégrez la maquette du site d'une agence web");
        $project2->setPath($this->getReference('path2'));
        $project2->setLevel($this->getReference('level1'));

        $project3 = new Project();
        $project3->setName("Créez un thème WordPress");
        $project3->setPath($this->getReference('path2'));
        $project3->setLevel($this->getReference('level2'));

        $manager->persist($project);
        $manager->persist($project2);
        $manager->persist($project3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}