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
        //CDP Design
        $tabDes = $this->cdpDes();
        for($i = 0; $i < count($tabDes); $i++)
        {
            $manager->persist($tabDes[$i]);
        }
        //CDP Développement
        $tabDev = $this->cdpDev();
        for($i = 0; $i < count($tabDev); $i++)
        {
            $manager->persist($tabDev[$i]);
        }
        //CDP Marketing
        $tabMark = $this->cdpMark();
        for($i = 0; $i < count($tabMark); $i++)
        {
            $manager->persist($tabMark[$i]);
        }
        //DWJ
        $dwj = $this->dwj();
        for($i = 0; $i < count($dwj); $i++)
        {
            $manager->persist($dwj[$i]);
        }
        //DA FrontEnd
        $daf = $this->daFrontend();
        for($i = 0; $i < count($daf); $i++)
        {
            $manager->persist($daf[$i]);
        }
        //DA PHP/Sf
        $dasf = $this->daPhp();
        for($i = 0; $i < count($dasf); $i++)
        {
            $manager->persist($dasf[$i]);
        }
        //DA Java
        $daj = $this->daj();
        for($i = 0; $i < count($daj); $i++)
        {
            $manager->persist($daj[$i]);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 4;
    }
    public function cdpDes()
    {
        $tab = [
            [
                'name' => 'Créez et déployez un site en ligne',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Initiez et lancez un projet multimédia',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Concevez un support de présentation pour la soutenance de sélection devant un client',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Concevez la maquette d\'un site responsive pour un client',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Stage ou gestion de projet multimédia en équipe',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Contribuez à votre écosystème',
                'level' => $this->getReference('level2')
            ]
        ];
        $tabDes = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('cdpDes'));
            $project->setLevel($item['level']);
            array_push($tabDes, $project);
        }
        return $tabDes;
    }
    public function cdpDev()
    {
        $tab = [
            [
                'name' => 'Créez et déployez un site en ligne',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Initiez et lancez un projet multimédia',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Créez un blog pour un écrivain',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Développez un back-end pour un client',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Stage ou gestion de projet multimédia en équipe',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Contribuez à votre écosystème',
                'level' => $this->getReference('level2')
            ]
        ];
        $tabDev = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('cdpDev'));
            $project->setLevel($item['level']);
            array_push($tabDev, $project);
        }
        return $tabDev;
    }
    public function cdpMark()
    {
        $tab = [
            [
                'name' => 'Créez et déployez un site en ligne',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Initiez et lancez un projet multimédia',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Développez votre présence en ligne',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Menez une campagne d\'acquisition',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Stage ou gestion de projet multimédia en équipe',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Contribuez à votre écosystème',
                'level' => $this->getReference('level2')
            ]
        ];
        $tabMark = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('cdpMark'));
            $project->setLevel($item['level']);
            array_push($tabMark, $project);
        }
        return $tabMark;
    }
    public function dwj()
    {
        $tab = [
            [
                'name' => 'Intégrez la maquette du site d\'une agence web',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Créez un thème Wordpress',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Concevez une carte interactive de location de vélos',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Créez un blog pour un écrivain',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Stage ou présentez librement un projet personnel',
                'level' => $this->getReference('level2')
            ]
        ];
        $tabDwj = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('dwj'));
            $project->setLevel($item['level']);
            array_push($tabDwj, $project);
        }
        return $tabDwj;
    }
    public function daFrontend()
    {
        $tab = [
            [
                'name' => 'Apprendre à apprendre',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Intégrez un thème WordPress pour un client',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Analysez les besoins de votre client pour son festival de films',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Concevez la solution technique d\'une application de restauration en ligne, Express Food',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Imaginez un générateur de citations',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Créez un jeu de plateau tour par tour en JS',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Lancez votre propre site d\'avis de restaurants',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Reprenez et améliorez un projet existant',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Stage ou construisez une veille technologique',
                'level' => $this->getReference('level1')
            ]
        ];
        $tabDa = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('daf'));
            $project->setLevel($item['level']);
            array_push($tabDa, $project);
        }
        return $tabDa;
    }
    public function daPhp()
    {
        $tab = [
            [
                'name' => 'Apprendre à apprendre',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Intégrez un thème WordPress pour un client',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Analysez les besoins de votre client pour son festival de films',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Concevez la solution technique d\'une application de restauration en ligne, Express Food',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Créez votre premier blog en PHP',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Développez de A à Z le site communautaire de Snowtricks',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Créez un site e-commerce exposant une API',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Améliorez une application existante de todo & co',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Stage ou construisez une veille technologique',
                'level' => $this->getReference('level1')
            ]
        ];
        $tabDa = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('dasf'));
            $project->setLevel($item['level']);
            array_push($tabDa, $project);
        }
        return $tabDa;
    }
    public function daj()
    {
        $tab = [
            [
                'name' => 'Apprendre à apprendre',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Intégrez la communauté OpenClassrooms',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Mettez votre logique à l\'épreuve',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Analysez les besoins de votre client pour son groupe de pizzerias',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Concevez la solution technique d\'un système de gestion de pizzeria',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Créez un site communautaire autour de l\'escalade',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Développez le nouveau système d\'information de la bibliothèque d\'une grande ville',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Documentez votre système de gestion de pizzeria',
                'level' => $this->getReference('level2')
            ],
            [
                'name' => 'Testez vos développements Java',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Améliorez le système d\'information de la bibliothèque',
                'level' => $this->getReference('level3')
            ],
            [
                'name' => 'Stage ou construisez une veille technologique',
                'level' => $this->getReference('level1')
            ],
            [
                'name' => 'Aidez la communauté en tant que développeur d\'application Java',
                'level' => $this->getReference('level3')
            ],
        ];
        $tabDa = [];
        foreach ($tab as $item)
        {
            $project = new Project();
            $project->setName($item['name']);
            $project->setPath($this->getReference('daj'));
            $project->setLevel($item['level']);
            array_push($tabDa, $project);
        }
        return $tabDa;
    }
}