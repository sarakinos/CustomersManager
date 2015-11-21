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

use AppBundle\Entity\Mail;
use AppBundle\Form\Type\CustomMailType;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Entity\Appointment;
use AppBundle\Entity\Customer;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;

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
     * Calls send mail function for custom mail service
     */
    public function sendCustomMail($sendForm)
    {
        $mail = $this->extractMailParameters($sendForm);
        if ($mail === false) {
            return false;
        }
        $this->sendMail($mail);
        return true;
    }

    /**
     * @param $appointments
     * @return bool
     * Calls send mail function for appointment reminder service
     */
    public function sendAppointmentNotification($appointments)
    {
        foreach ($appointments as $appointment) {
            $mail = $this->extractMailParameters($appointment);
            if ($mail === false) {
                return false;
            }
            $this->sendMail($mail, $appointment);
        }
        return true;
    }

    /**
     * @param $mail
     * @param null $appointment
     * @return bool
     * @throws \Twig_Error
     * Main mail send function , creates Swift Message instance and sends the mail.
     * Also configures the flash message for the template
     */
    private function sendMail($mail, $appointment = null)
    {
        $mailParameter = $this->generateTemplateParameters($mail, $appointment);
        $mailTemplate = $mailParameter['mailTemplate'];
        $templateValues = $mailParameter['templateValues'];

        $message = \Swift_Message::newInstance()
            ->setSubject($mail->getSubject())
            ->setFrom($mail->getFrom())
            ->setTo($mail->getTo()->getEmail())
            ->setBody(
                $this->container->get('templating')->render(
                    $mailTemplate,
                    $templateValues
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

    /**
     * @param $container
     * @return Mail|bool
     * Function gets the container with the mail parameters, decides if its a form (custom mail)
     * or an appointment (appointment reminder) and extract the data into a mail object
     */
    private function extractMailParameters($container)
    {
        if ($container instanceof Form) {
            $mail = new Mail();
            $mail->setFrom($this->container->getParameter('mailer_user'));
            $mail->setTo($container->get('to')->getData());
            $mail->setBody($container->get('body')->getData());
            $mail->setSubject($container->get('subject')->getData());
            return $mail;
        }
        if ($container instanceof Appointment) {
            $mail = new Mail();
            $mail->setFrom($this->container->getParameter('mailer_user'));
            $mail->setTo($container->getCustomer());
            $mail->setSubject('Appointment Reminder');
            return $mail;
        }
        return false;
    }

    /**
     * @param $mail
     * @param null $appointment
     * @return array
     * Checks if previous action is from custom mail or appointment reminder service and sets the appropriate
     * template and values. Parameters are returned using an array
     */
    private function generateTemplateParameters($mail, $appointment = null)
    {
        if ($appointment!=null) {
            $mailTemplate = 'customers_manager/emails/appointment_reminder.html.twig';
            $templateValues = array(
                'appointment' => $appointment,
                'customer' => $appointment->getCustomer()
            );
            return array(
                'mailTemplate' => $mailTemplate,
                'templateValues' => $templateValues
            );
        }
            $mailTemplate = 'customers_manager/emails/custom_email.html.twig';
            $templateValues = array(
                'customer' => $mail->getTo(),
                'body' => $mail->getBody()
            );
            return array(
            'mailTemplate' => $mailTemplate,
            'templateValues' => $templateValues
            );
    }
}