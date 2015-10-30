<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/10/2015
 * Time: 1:21 μμ
 */

namespace AppBundle\DependencyInjection;


use AppBundle\Entity\Demand;
use Doctrine\ORM\EntityManager;

class DemandManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function getAll()
    {
        $demands = $this->em->getRepository("AppBundle:Demand")->findAll();
        return $demands;
    }
    public function add(Demand $demand)
    {
        $this->em->persist($demand);
        $this->em->flush();
    }
}