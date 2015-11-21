<?php

namespace AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\Appointment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\DemandType;
use AppBundle\Entity\Demand;
use Symfony\Component\HttpFoundation\Request;

class DemandController extends Controller
{
    public function indexAction()
    {
        $demands = $this->get('demand_manager')->getAll();

        return $this->render("customers_manager/demands/demands_index.html.twig", array(
            'title'=>'Demands Managment - Index',
            'demands'=>$demands
        ));
    }

    public function registerAction()
    {
        $demand = new Demand();
        $registerForm = $this->createForm(new DemandType(), $demand, array(
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
        $registerForm = $this->createForm(new DemandType(), $demand, array(
            'action' => $this->generateUrl('customer_manager_customers_add'),
            'method' => 'POST',
        ));
        $registerForm->handleRequest($request);
        //We need to add form validation here!
        $this->get('demand_manager')->add($demand);
        $this->addFlash("actionInfo", "Demand added successfuly");
        return $this->redirectToRoute("customer_manager_demand_index");
    }
    public function deleteAction($id)
    {
        if (!$this->get('helper_validator')->checkId($id)) {
            throw $this->createNotFoundException("Invalid id");
        }
        $this->get('demand_manager')->remove($id);
        $this->addFlash("actionInfo", "Demand deleted successfuly");
        return $this->redirectToRoute("customer_manager_demand_index");
    }
    public function editAction($id)
    {
        if (!$this->get('helper_validator')->checkId($id)) {
            throw $this->createNotFoundException("Invalid id");
        }

        $demand = $this->get('demand_manager')->getById($id);
        $registerForm = $this->createForm(new DemandType(), $demand, array(
            'action' => $this->generateUrl(
                'customer_manager_demand_update',
                array(
                "id"=>$id
                )
            ),
            'method' => 'POST',
        ));
        return $this->render('customers_manager/demands/demands_add.html.twig', array(
            'title' => 'Demands Managment - Add',
            'registerForm' => $registerForm->createView()
        ));
    }
    public function updateAction(Request $request, $id)
    {
        $demand = $this->get('demand_manager')->getById($id);
        $registerForm = $this->createForm(new DemandType(), $demand);
        $registerForm->handleRequest($request);


        $this->get('demand_manager')->update();
        $this->addFlash("actionInfo", "Demand updated successfuly");
        return $this->redirectToRoute("customer_manager_demand_index");
    }
}
