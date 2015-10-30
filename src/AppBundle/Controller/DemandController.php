<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;

class DemandController extends Controller
{
    public function indexAction()
    {
        $demands = $this->get('demand_manager')->getAll();

        return $this->render("customers_manager/demands/demands_index.html.twig",array(
            'title'=>'Requests Managment - Index',
            'demands'=>$demands
        ));
    }

    public function registerAction()
    {
        return new Response("ok");
    }
}
