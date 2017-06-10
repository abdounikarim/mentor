<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 16:56
 */

namespace MentorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Student
 * @package MentorBundle\Entity
 * @ORM\Table("student")
 * @ORM\Entity(repositoryClass="MentorBundle\Repository\StudentRepository")
 * @UniqueEntity(fields={"firstname", "name"})
 */
class Student implements \JsonSerializable
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
     * @var string
     * @ORM\Column(name="firstname", type="string")
     */
    private $firstname;

    /**
     * @ORM\ManyToOne(targetEntity="MentorBundle\Entity\Path")
     */
    private $path;

    private $fullname;

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
     * @return Student
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Student
     */
    public function setFirstname($firstname)
    {
        if (is_string($firstname)) {
            $this->firstname = $firstname;
        }
        return $this;
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param Path $path
     * @return Student
     */
    public function setPath(Path $path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'student' => [
                'id' => $this->id,
                'firstname' => $this->firstname,
                'name' => $this->name,
                'path' => [
                    'id' => $this->getPath()->getId(),
                    'name' => $this->getPath()->getName()
                ]
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param $fullname
     * @return $this
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
        return $this;
    }
}
