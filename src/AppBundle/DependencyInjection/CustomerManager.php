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
        if (!$customer) {
            return false;
        }
        $this->em->remove($customer);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

    /**
     * @return array
     * Function gets all customers and filters throw their birthday date, capturing the ones with birthday date
     * matching today or is in the month beeing.
     * Returns an array with two keys , one containing the customers having birthday today and one
     * containing the ones having birthday this month.
     */
    public function getBirthday()
    {
        $customers = $this->getAll();
        $todayBirthday = [];
        $monthBirthday = [];

        $now = new \DateTime();
        $today = $now->format("m/d");
        $month = $now->format(('m'));

        foreach ($customers as $customer) {
            if ($customer->getBirthday()->format('m/d') == $today) {
                $todayBirthday[] = $customer;
            }
            if ($customer->getBirthday()->format('m') == $month) {
                $monthBirthday[] = $customer;
            }
        }
        return $results = array(
            'todayBirthday' => $todayBirthday,
            'monthBirthday' => $monthBirthday
        );
    }
}
