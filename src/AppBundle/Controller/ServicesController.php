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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Controller responsible for rendering the Appointment reminder template
     */
    public function appointmentReminderAction()
    {
        $appointmentsOfTheWeek = $this->get('appointment_manager')->getAppointmentsByQuery(7);
        $appointmentsOfTheMonth = $this->get('appointment_manager')->getAppointmentsByQuery(30);
        return $this->render(
            'customers_manager/services/appointment_reminder.html.twig',
            array(
                'appointmentsOfTheWeek' => $appointmentsOfTheWeek,
                'appointmentsOfTheMonth' => $appointmentsOfTheMonth
                )
        )
        ;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Controller responsible for rendering the Birthday reminder template
     */
    public function birthdayMessageAction()
    {
        $customersManager = $this->get('customer_manager');
        $customers = $customersManager->getBirthday();

        return $this->render(
            'customers_manager/services/birthday_email.html.twig',
            array(
                'todayBirthday' => $customers['todayBirthday'],
                'monthBirthday' => $customers['monthBirthday']
            )
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Controller gets customers objects who has birthday and pass them to mailer managers
     * sendBirthdayWishes function to handle the mail delivery
     */
    public function birthdayNotifyAction()
    {
        $customersManager = $this->get('customer_manager');
        $customers = $customersManager->getBirthday();
        $mailerManager = $this->get('mailer_manager');
        $mailerManager->sendBirthdayWishes($customers['todayBirthday']);

        return $this->forward('AppBundle:Services:birthdayMessage');
    }

    /**
     * @param $by
     * @return \Symfony\Component\HttpFoundation\Response
     * Depending on the route slug ($by) , the controller calls the appropriate function
     * on notify manager
     */
    public function appointmentNotifyAction($by)
    {
        $notifyManager = $this->get('notify_manager');
        if ($by == 'week') {
            $notifyManager->notifyBy(0);
        }
        return $this->appointmentReminderAction();
    }
}
