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
use Proxies\__CG__\AppBundle\Entity\Customer;

class AppointmentManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        $appointments = $this->em->getRepository("AppBundle:Appointment")->findAll();
        return $appointments;
    }

    public function getById($id)
    {
        $appointment = $this->em->getRepository("AppBundle:Appointment")->find($id);
        return $appointment;
    }

    public function getBy(array $criteria)
    {
        $appointments = $this->em->getRepository("AppBundle:Appointment")->findBy($criteria);
        return $appointments;
    }

    public function getByCustomer( $customer)
    {
        $appointments = $this->em->getRepository("AppBundle:Appointment")->findBy(array(
            'customer' => $customer
        ));
        return $appointments;
    }

    public function add(Appointment $appointment)
    {
        $this->em->persist($appointment);
        $this->em->flush();
    }

    public function remove($id)
    {
        $appointment = $this->getById($id);
        $this->em->remove($appointment);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

    public function getTodayAppointments()
    {

        $query = $this->em->createQuery('
            SELECT a FROM AppBundle:Appointment a
             WHERE a.date > :today
             ORDER BY a.date ASC

        ')
            ->setParameter('today', new \DateTime());
        $appointments = $query->getResult();
        return $appointments;
    }
}