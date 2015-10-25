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
            'customers'=>$customers
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

    public function addAction(Request $request)
    {
        $customer = new Customer();
        $registerForm = $this->createForm(new CustomerType(),$customer,array(
            'action' => $this->generateUrl('customer_manager_customers_add'),
            'method' => 'POST',
        ));
        $registerForm->handleRequest($request);

        if(!$registerForm->isValid()){
            return $this->redirectToRoute("customer_manager_customers_register");
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        return $this->redirectToRoute("customer_manager_customers_index");
    }
}
