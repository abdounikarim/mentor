<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 18:25
 */

namespace MentorBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function findByPath($path)
    {
        $projects = $this->findBy($path);

        $data = [];
        foreach ($projects as $project) {
            $data[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'price' => $project->getLevel()->getPrice()->getPrice()
            ];
        }

        return $data;
    }
}
