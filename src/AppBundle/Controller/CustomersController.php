<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomersController extends Controller
{
    public function indexAction()
    {
        return $this->render('customers_manager/customers.html.twig', array('title' => 'Customers Managmentn'));
    }
}
