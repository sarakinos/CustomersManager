<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Customer;

class CustomersController extends Controller
{
    public function indexAction()
    {
        $customers = $this->getDoctrine()->getRepository("AppBundle:Customer")->findAll();

        return $this->render('customers_manager/customers.html.twig', array(
            'title' => 'Customers Managment',
            'customers'=>$customers
        ));
    }
}
