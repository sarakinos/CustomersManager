<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/10/2015
 * Time: 12:51 μμ
 */
namespace AppBundle\DependencyInjection;

use AppBundle\Entity\Appointment;
use Doctrine\ORM\EntityManager;

class AppointmentManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAppointments()
    {
        $appointments=$this->em->getRepository("AppBundle:Appointment")->findAll();
        return $appointments;
    }
    public function addAppointment(Appointment $appointment)
    {
        $this->em->persist($appointment);
        $this->em->flush();
        return true;
    }
}