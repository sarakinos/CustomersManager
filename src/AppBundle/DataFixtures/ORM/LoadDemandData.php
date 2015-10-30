<?php

namespace AppBundle\DataFixtures\ORM;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/10/2015
 * Time: 12:48 μμ
 */

use AppBundle\Entity\Demand;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;



class LoadRequestData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $customer = $manager->getRepository("AppBundle:Customer")->findOneBy(array(
            'firstname'=>'Bampis'
        ));
        $appointment = $manager->getRepository("AppBundle:Appointment")->findOneBy(array(
            'customer'=>$customer
        ));

        $demand = new Demand();
        $demand->setTitle("Test Demand");
        $demand->setIsCompleted(false);
        $demand->setBody("Lorem lorem");
        $demand->setPosted(new \DateTime());
        $demand->setExpires(new \DateTime());
        $demand->setCustomer($customer);
        $demand->setAppointment($appointment);

        $manager->persist($demand);
        $manager->flush();
    }
}