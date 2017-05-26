<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 16:52
 */

namespace MentorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project
 * @package MentorBundle\Entity
 * @ORM\Table("project")
 */
class Project
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
     * @ORM\ManyToOne(targetEntity="MentorBundle\Entity\Price")
     * @ORM\JoinColumn(nullable=false)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="MentorBundle\Entity\Path", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $path;

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
     * @return Project
     */
    public function setName($name)
    {
        if(is_string($name)) {
            $this->name = $name;
        }
        return $this;
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
     * @return Project
     */
    public function setPrice(Price $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param Path
     * @return Project
     */
    public function setPath(Path $path)
    {
        $this->path = $path;
        return $this;
    }
}
