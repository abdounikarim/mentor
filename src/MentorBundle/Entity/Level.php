<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/06/2017
 * Time: 10:56
 */

namespace MentorBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Level
 * @package MentorBundle\Entity
 * @ORM\Table("level")
 * @ORM\Entity(repositoryClass="MentorBundle\Repository\LevelRepository")
 */
class Level
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
     * @ORM\OneToOne(targetEntity="MentorBundle\Entity\Price")
     * @ORM\JoinColumn(nullable=false)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="MentorBundle\Entity\Project", mappedBy="level")
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
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Price $price
     * @return Level
     */
    public function setPrice(Price $price)
    {
        $this->price = $price;
        return $this;
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
     * @return Level
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
     * @return Level
     */
    public function addProject(Project $project)
    {
        $this->projects->add($project);
        return $this;
    }

    /**
     * @param Project $project
     * @return Level
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
        return $this;
    }

}
