<?php

namespace AppBundle\Entity;

/**
 * Created by PhpStorm.
 * Author: Bampis Sykovatidis
 * Date: 24/10/2015
 * Time: 9:25 μμ
 */
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="customer")
     */
    protected $appointment;
    /**
     * @ORM\OneToMany(targetEntity="Demand", mappedBy="customer")
     */
    protected $demand;
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     */
    protected $surname;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    protected $birthday;
    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank()
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank()
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank()
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @ORM\Column(type="integer", length=20)
     * @Assert\NotBlank()
     */
    protected $phone;

    /**
     * Constructor of the class, there we initialize the appointments array
     */
    public function __construct()
    {
        $this->appointment = new ArrayCollection();
    }

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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Customer
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Customer
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Customer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Customer
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     *
     * @return Customer
     */
    public function addAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment[] = $appointment;

        return $this;
    }

    /**
     * Remove appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     */
    public function removeAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment->removeElement($appointment);
    }

    /**
     * Get appointment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppointment()
    {
        return $this->appointment;
    }
    public function __toString()
    {
        return $this->surname." ".$this->firstname;
    }

    /**
     * Add demand
     *
     * @param \AppBundle\Entity\Demand $demand
     *
     * @return Customer
     */
    public function addDemand(\AppBundle\Entity\Demand $demand)
    {
        $this->demand[] = $demand;

        return $this;
    }

    /**
     * Remove demand
     *
     * @param \AppBundle\Entity\Demand $demand
     */
    public function removeDemand(\AppBundle\Entity\Demand $demand)
    {
        $this->demand->removeElement($demand);
    }

    /**
     * Get demand
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemand()
    {
        return $this->demand;
    }
}
