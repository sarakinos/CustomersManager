<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/10/2015
 * Time: 12:51 μμ
 */
namespace AppBundle\DependencyInjection;

use Doctrine\ORM\EntityManager;

class CustomerManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getCustomers()
    {
        $customers = $this->em->getRepository("AppBundle:Customer")->findAll();
        return $customers;
    }
    public function getCustomerArray()
    {
        $customerArray = array();
        $customers = $this->em->getRepository("AppBundle:Customer")->findAll();
        foreach($customers as $customer){
            $customerArray[$customer->getId()] = $customer->getSurname().",".$customer->getFirstname();
        }
        return $customerArray;
    }
    public function addCustomer($customer)
    {
        $this->em->persist($customer);
        $this->em->flush();
    }

    public function checkId($id)
    {
        if($id<0){
            return false;
        }
        return true;
    }
}