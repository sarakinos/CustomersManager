<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailerController extends Controller
{
    public function sendAction()
    {
         $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('bampis.s@gmail.com')
        ->setTo('bampis.s@gmail.com')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'customers_manager/emails/hello_email.html.twig'
            ),
            'text/html'
        );
         $this->get('mailer')->send($message);

         return $this->render('customers_manager/services/index.html.twig');
    }
}
