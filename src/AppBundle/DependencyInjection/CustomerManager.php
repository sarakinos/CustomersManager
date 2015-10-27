<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/10/2015
 * Time: 12:51 μμ
 */
namespace AppBundle\DependencyInjection;

use AppBundle\Entity\Customer;
use Doctrine\ORM\EntityManager;

class CustomerManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        $customers = $this->em->getRepository("AppBundle:Customer")->findAll();
        return $customers;
    }

    public function getById($id)
    {
        $appointment = $this->em->getRepository("AppBundle:Customer")->find($id);
        return $appointment;
    }

    public function add(Customer $appointment)
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


}