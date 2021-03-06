<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 16:56
 */

namespace MentorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Session
 * @package MentorBundle\Entity
 * @ORM\Table("session")
 * @ORM\Entity(repositoryClass="MentorBundle\Repository\SessionRepository")
 */
class Session
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
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var boolean
     * @ORM\Column(name="noshow", type="boolean")
     */
    private $noshow;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="MentorBundle\Entity\Student")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity="MentorBundle\Entity\Project")
     */
    private $project;

    /**
     * @var float
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="MentorBundle\Entity\User", inversedBy="sessions")
     */
    private $mentor;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Session
     */
    public function setType($type)
    {
        if (is_string($type)) {
            $this->type = $type;
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isNoshow()
    {
        return $this->noshow;
    }

    /**
     * @param bool $noshow
     * @return Session
     */
    public function setNoshow($noshow)
    {
        $this->noshow = (boolean) $noshow;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Session
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student
     * @return Session
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param Project $project
     * @return $this
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Session
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;
        return $this;
    }

    /**
     * @return User
     */
    public function getMentor()
    {
        return $this->mentor;
    }

    public function setMentor(User $user)
    {
        $this->mentor = $user;
        return $this;
    }
}
