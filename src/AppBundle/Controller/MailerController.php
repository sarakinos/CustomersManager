<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mail;
use AppBundle\Form\Type\CustomMailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailerController extends Controller
{
    public function sendAction(Request $request)
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
        $sendForm->handleRequest($request);
        $mailerManager = $this->get('mailer_manager');
        $mailerManager->sendCustomMail($sendForm);
         return $this->render('customers_manager/services/index.html.twig');
    }


}
