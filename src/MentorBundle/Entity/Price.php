<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 26/05/2017
 * Time: 16:55
 */

namespace MentorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Price
 * @package MentorBundle\Entity
 * @ORM\Table("price")
 * @ORM\Entity(repositoryClass="MentorBundle\Repository\PriceRepository")
 */
class Price
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     * @ORM\Column(name="price", type="float", scale=2)
     */
    private $price;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Price
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;
        return $this;
    }
}
