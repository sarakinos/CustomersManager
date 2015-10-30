<?php

namespace AppBundle\DataFixtures\ORM;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/10/2015
 * Time: 12:48 μμ
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Customer;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadCustomerData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $customer = new Customer();

        $customer->setFirstname("Bampis");
        $customer->setSurname("Sykovaridis");
        $customer->setBirthday(new \DateTime());
        $customer->setCity("Serres");
        $customer->setAddress("Ritsou");
        $customer->setEmail("bampis.s@gmail.com");
        $customer->setPhone("2323232");
        $customer->setCountry("Greece");

        $manager->persist($customer);
        $manager->flush();
    }
}