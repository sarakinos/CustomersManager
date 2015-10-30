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
        if ($entity instanceof Appointment) {
            $this->removeDemands($entityManager,$entity);
        }
        $entityManager->flush();
    }

    private function removeAppointments(EntityManager $entityManager,$entity)
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
    private function removeDemands(EntityManager $entityManager,$entity)
    {
        $entityClassName = $this->normalizeEntityName($entity);
        $demands = $entityManager->getRepository("AppBundle:Demand")->findBy(
            array(
                $entityClassName => $entity
            )
        );
        foreach($demands as $demand){
            $entityManager->remove($demand);
        }
    }
    private function normalizeEntityName($entity)
    {
        $entityType = get_class($entity);
        $exploded = explode('\\',$entityType);
        return strtolower($exploded[2]);
    }
}