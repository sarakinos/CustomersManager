<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/10/2015
 * Time: 12:11 μμ
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

    /**
     * @ORM\Entity
     * @ORM\Table(name="appointment")
     */
class Appointment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $customer_id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $comments;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    protected $date;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isCompleted;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return Appointment
     */
    public function setCustomerId($customerId)
    {
        $this->customer_id = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Appointment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Appointment
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Appointment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set isCompleted
     *
     * @param boolean $isCompleted
     *
     * @return Appointment
     */
    public function setIsCompleted($isCompleted)
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }

    /**
     * Get isCompleted
     *
     * @return boolean
     */
    public function getIsCompleted()
    {
        return $this->isCompleted;
    }
}
