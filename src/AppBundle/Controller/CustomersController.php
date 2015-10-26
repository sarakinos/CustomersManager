<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Customer;
use AppBundle\Form\Type\CustomerType;
use Symfony\Component\HttpFoundation\Request;

class CustomersController extends Controller
{
    public function indexAction()
    {
        $customers = $this->getDoctrine()->getRepository("AppBundle:Customer")->findAll();

        return $this->render('customers_manager/customers/customers_index.html.twig', array(
            'title' => 'Customers Managment - Index',
            'customers'=>$customers,
        ));
    }
    public function registerAction()
    {
        $customer = new Customer();
        $registerForm = $this->createForm(new CustomerType(),$customer,array(
            'action' => $this->generateUrl('customer_manager_customers_add'),
            'method' => 'POST',
            ));

        return $this->render('customers_manager/customers/customers_add.html.twig', array(
            'title' => 'Customers Managment - Add',
            'registerForm' => $registerForm->createView()
        ));
    }

    public function editAction($id)
    {
        if(!$this->checkCustomerId($id)){
            throw $this->createNotFoundException("Invalid id");
        }

        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository("AppBundle:Customer")->find($id);
        $registerForm = $this->createForm(new CustomerType(),$customer,array(
            'action' => $this->generateUrl('customer_manager_customers_update',array(
                "id"=>$id
            )),
            'method' => 'POST',
        ));
        return $this->render('customers_manager/customers/customers_add.html.twig', array(
            'title' => 'Customers Managment - Add',
            'registerForm' => $registerForm->createView()
        ));
    }

    public function addAction(Request $request)
    {
        $customer = new Customer();
        $registerForm = $this->createForm(new CustomerType(),$customer,array(
            'action' => $this->generateUrl('customer_manager_customers_add'),
            'method' => 'POST',
        ));
        $registerForm->handleRequest($request);

        if(!$registerForm->isValid()){
            $validator = $this->get('validator');
            $errors = $validator->validate($customer);
            return $this->redirectToRoute("customer_manager_customers_register");
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();
        $this->addFlash("actionInfo","Customer added successfuly");
        return $this->redirectToRoute("customer_manager_customers_index");
    }

    public function updateAction(Request $request,$id)
    {
        $customer = $this->getDoctrine()->getRepository("AppBundle:Customer")->find($id);
        $registerForm = $this->createForm(new CustomerType(),$customer);
        $registerForm->handleRequest($request);

        if(!$registerForm->isValid()) {
            $validator = $this->get('validator');
            $errors = $validator->validate($customer);
            return $this->redirectToRoute("customer_manager_customers_register");
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash("actionInfo","Customer updated successfuly");
        return $this->redirectToRoute("customer_manager_customers_index");
    }

    public function deleteAction($id)
    {
        if(!$this->checkCustomerId($id)){
            throw $this->createNotFoundException("Invalid id");
        }

        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository("AppBundle:Customer")->find($id);
        $em->remove($customer);
        $em->flush();
        $this->addFlash("actionInfo","Customer deleted successfuly");
        return $this->redirectToRoute("customer_manager_customers_index");
    }

    private function checkCustomerId($id)
    {
        if($id<0){
            return false;
        }
        return true;
    }

}
