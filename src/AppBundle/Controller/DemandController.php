<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\DemandType;
use AppBundle\Entity\Demand;
use Symfony\Component\HttpFoundation\Request;

class DemandController extends Controller
{
    public function indexAction()
    {
        $demands = $this->get('demand_manager')->getAll();

        return $this->render("customers_manager/demands/demands_index.html.twig",array(
            'title'=>'Demands Managment - Index',
            'demands'=>$demands
        ));
    }

    public function registerAction()
    {
        $demand = new Demand();
        $registerForm = $this->createForm(new DemandType(),$demand,array(
            'action' => $this->generateUrl('customer_manager_demand_add'),
            'method' => 'POST',
        ));

        return $this->render('customers_manager/demands/demands_add.html.twig', array(
            'title' => 'Demands Managment - Add',
            'registerForm' => $registerForm->createView()
        ));
    }

    public function addAction(Request $request)
    {
        $demand = new Demand();
        $registerForm = $this->createForm(new DemandType(),$demand,array(
            'action' => $this->generateUrl('customer_manager_customers_add'),
            'method' => 'POST',
        ));
        $registerForm->handleRequest($request);

        if(!$registerForm->isValid()){
            $validator = $this->get('validator');
            $errors = $validator->validate($demand);
            return $this->redirectToRoute("customer_manager_demand_register");
        }

        $this->get('demand_manager')->add($demand);
        $this->addFlash("actionInfo","Demand added successfuly");
        return $this->redirectToRoute("customer_manager_demand_index");
    }
}
