<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Appointment;
use AppBundle\Form\Type\CustomerType;
use Symfony\Component\HttpFoundation\Request;

class NavigationController extends Controller
{
    /**
    *@param Request
    * A navigation index function that gets the previous url and
    * redirects to the appropriate index route
    **/
    public function indexAction(Request $request)
    {
        $sectionName = $this->getSection($this->getRequest());
        switch ($sectionName) {
            case 'customers':
                $routeToRedirect = 'customer_manager_customers_index';
                break;
            case 'appointments':
                $routeToRedirect = 'customer_manager_appointment_index';
                break;
            case 'demands':
                $routeToRedirect = 'customer_manager_demand_index';
                break;
            default:
                break;
        }
        return $this->redirectToRoute($routeToRedirect);
    }

    /**
    *@param Request
    * A navigation register function that gets the previous url and
    * redirects to the appropriate register route
    **/
    public function registerAction()
    {
        $sectionName = $this->getSection($this->getRequest());
        switch ($sectionName) {
            case 'customers':
                $routeToRedirect = 'customer_manager_customers_register';
                break;
            case 'appointments':
                $routeToRedirect = 'customer_manager_appointment_register';
                break;
            case 'demands':
                $routeToRedirect = 'customer_manager_demand_register';
                break;
            default:
                break;
        }
        return $this->redirectToRoute($routeToRedirect);
    }

    private function getSection($request)
    {
        $previousUrl = $request->headers->get('referer');
        $sectionName = explode('/', $previousUrl);
        return $sectionName[3];
    }
}
