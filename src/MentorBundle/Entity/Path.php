<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 16:43
 */

namespace MentorBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Path
 * @package MentorBundle\Entity
 * @ORM\Table("path")
 * @ORM\Entity(repositoryClass="MentorBundle\Repository\PathRepository")
 */
class Path implements \JsonSerializable
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="MentorBundle\Entity\Project", mappedBy="path")
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Path
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param Project $project
     * @return Path
     */
    public function addProject(Project $project)
    {
        $this->projects->add($project);
        return $this;
    }

    /**
     * @param Project $project
     * @return Path
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'path' => [
                'id' => $this->id,
                'name' => $this->name,
            ]
        ];
    }
}
