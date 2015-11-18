<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function indexAction()
    {
        return $this->render('customers_manager/services/index.html.twig');
    }

    public function customMessageAction()
    {
        return $this->render('customers_manager/services/custom_message.html.twig');
    }
}
