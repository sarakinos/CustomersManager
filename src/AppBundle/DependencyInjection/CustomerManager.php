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
        $customer = $this->em->getRepository("AppBundle:Customer")->find($id);
        return $customer;
    }

    public function add(Customer $customer)
    {
        $this->em->persist($customer);
        $this->em->flush();
    }

    public function remove($id)
    {
        $customer = $this->getById($id);
        $this->em->remove($customer);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }
}
