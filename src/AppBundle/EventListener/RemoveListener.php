<?php

namespace AppBundle\EventListener;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 27/10/2015
 * Time: 9:40 μμ
 */

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Appointment;
use AppBundle\Entity\Customer;

class RemoveListener
{
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Customer) {
            $this->removeDemands($entityManager,$entity);
            $this->removeAppointments($entityManager,$entity);
        }
        $entityManager->flush();
    }

    private function removeAppointments(EntityManager $entityManager,Customer $entity)
    {
        $appointments = $entityManager->getRepository("AppBundle:Appointment")->findBy(
            array(
                "customer" => $entity
            )
        );
        foreach($appointments as $appointment){
            $entityManager->remove($appointment);
        }
    }
    private function removeDemands(EntityManager $entityManager,Customer $entity)
    {
        $demands = $entityManager->getRepository("AppBundle:Demand")->findBy(
            array(
                "customer" => $entity
            )
        );
        foreach($demands as $demand){
            $entityManager->remove($demand);
        }
    }
}