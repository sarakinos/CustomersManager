<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mail;
use AppBundle\Form\Type\CustomMailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function indexAction()
    {
        return $this->render('customers_manager/services/index.html.twig');
    }

    public function customMessageAction()
    {
        $mailEntity = new Mail();
        $sendForm = $this->createForm(
            new CustomMailType(),
            $mailEntity,
            array(
                'action' => $this->generateUrl('customer_manager_send_message'),
                'method' => 'POST',
            )
        );

        return $this->render('customers_manager/services/custom_message.html.twig', array(
            'sendForm' => $sendForm->createView()
        ));
    }
}
