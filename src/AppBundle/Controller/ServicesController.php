<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mail;
use AppBundle\Form\Type\CustomMailType;
use AppBundle\DependencyInjection\AppointmentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function indexAction()
    {
        return $this->render('customers_manager/services/index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Creates and displays the mail form used to send individual messages to customers
     */
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

    public function appointmentReminderAction()
    {
        $appointments = $this->get('appointment_manager')->getAppointmentsByQuery(30);
        return $this->render('customers_manager/services/appointment_reminder.html.twig',
            array(
                'appointments' => $appointments
            ));
    }
}
