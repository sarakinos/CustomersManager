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
use AppBundle\Entity\Appointment;
use Proxies\__CG__\AppBundle\Entity\Customer;


class LoadAppointmentData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $customer = $manager->getRepository("AppBundle:Customer")->findOneBy(array(
            'firstname'=>'Bampis'
        ));


        $appointment = new Appointment();

        $appointment->setComments("Appointment Test Fixture");
        $appointment->setDate(new \DateTime());
        $appointment->setIsCompleted(false);
        $appointment->setTitle("Test Appointment");
        $appointment->setCustomer($customer);
        $manager->persist($appointment);
        $manager->flush();
    }
}