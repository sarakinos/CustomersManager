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

    public function getByCustomer($customer)
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
        if ($appointment === null) {
            return false;
        }
        $this->em->remove($appointment);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

    /**
     * @param integer
     * @return array
     * Parameter for the function is an integer.Function calculates the appointments from
     * today to the date emerses by the integer given as parameter.
     * If we want to grab todays appointment we can leave $days to its default value
     */
    public function getAppointmentsByQuery($days = 1)
    {
        $query = $this->em->createQuery("
            SELECT a FROM AppBundle:Appointment a
             WHERE a.date BETWEEN
             CURRENT_DATE()
             AND
             DATE_ADD(CURRENT_DATE(), :days, 'DAY')
             ORDER BY a.date ASC

        ")->setParameter('days',$days);
        $appointments = $query->getResult();
        return $appointments;
    }
}
