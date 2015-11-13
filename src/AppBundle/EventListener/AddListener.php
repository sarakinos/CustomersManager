<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/10/2015
 * Time: 4:07 μμ
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Demand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AddListener
{
    public function postPersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Demand) {
            $entity->setPosted(new \DateTime());
        }
        $entityManager->flush();
    }
}
