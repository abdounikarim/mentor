<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/06/2017
 * Time: 11:31
 */

namespace MentorBundle\Entity;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package MentorBundle\Entity
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="MentorBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Email déjà utilisé")
 * @UniqueEntity(fields={"username"}, message="Pseudo déjà utilisé")
 * @UniqueEntity(fields={"firstname", "lastname"}, message="Compte déjà existant")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string")
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string")
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="username", type="string", unique=true)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @var array
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }
}
