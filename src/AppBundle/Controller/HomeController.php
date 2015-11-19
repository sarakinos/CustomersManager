<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{

    public function indexAction()
    {
        $appointments = $this->get('appointment_manager')->getAppointmentsByQuery();
        $customers = $this->get('customer_manager')->getAll();
        $demands = $this->get('demand_manager')->getAll();

        return $this->render("customers_manager/index.html.twig", array(
            'today_appointments' => $appointments,
            'registered_customers' => count($customers),
            'registered_demands' => count($demands)
        ));
    }
}
