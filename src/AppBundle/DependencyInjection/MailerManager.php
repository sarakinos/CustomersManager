<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/11/2015
 * Time: 9:39 μμ
 * This service is responsible for sending email actions. It get the app container so it has access
 * at templating and mailer.
 */

namespace AppBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MailerManager
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $sendForm
     * @return bool
     * @throws \Twig_Error
     * Gets the form with the desired message,subject,to and from as a parameter. Extracts the details and delivers
     * the message. Returns status and sets the flash message
     */
    public function sendCustomMail($sendForm)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($sendForm->get('subject')->getData())
            ->setFrom($sendForm->get('to')->getData()->getEmail())
            ->setTo($sendForm->get('to')->getData()->getEmail())
            ->setBody(
                $this->container->get('templating')->render(
                    'customers_manager/emails/custom_email.html.twig',
                    array(
                        'customer' => $sendForm->get('to')->getData(),
                        'body' => $sendForm->get('body')->getData()
                    )
                ),
                'text/html'
            );
        try {
            $this->container->get('mailer')->send($message);
            $this->container->get('session')->getFlashBag()->add('notice', 'Message sent!');
            return true;
        } catch (\Swift_RfcComplianceException $exception) {
            // do something like proper error handling or log this error somewhere
        }
        $this->container->get('session')->getFlashBag()->add('notice', 'Message doesnt sent!');
        return false;
    }
    public function sendAppointmentNotification($appointments)
    {

    }
}