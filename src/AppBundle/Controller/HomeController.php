<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{

    public function indexAction(Request $request)
    {
        $appointments = $this->get('appointment_manager')->getTodayAppointments();
        $customers = $this->get('customer_manager')->getAll();
        $demands = $this->get('demand_manager')->getAll();

        return $this->render("customers_manager/index.html.twig", array(
            'today_appointments' => $appointments,
            'registered_customers' => count($customers),
            'registered_demands' => count($demands)
        ));
    }
}
