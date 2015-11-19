<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mail;
use AppBundle\Form\Type\CustomMailType;
use AppBundle\Entity\Customer;
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

         $message = \Swift_Message::newInstance()
        ->setSubject($sendForm->get('subject')->getData())
        ->setFrom($sendForm->get('to')->getData()->getEmail())
        ->setTo($sendForm->get('to')->getData()->getEmail())
        ->setBody(
            $this->renderView(
                'customers_manager/emails/custom_email.html.twig',
                array(
                    'customer' => $sendForm->get('to')->getData(),
                    'body' => $sendForm->get('body')->getData()
                )
            ),
            'text/html'
        );
        try{
            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('notice', 'Message sent!');
        } catch (\Swift_RfcComplianceException $exception) {
            // do something like proper error handling or log this error somewhere
        }
         return $this->render('customers_manager/services/index.html.twig');
    }
}
