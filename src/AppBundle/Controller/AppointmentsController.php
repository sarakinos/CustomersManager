<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Appointment;
use AppBundle\Form\Type\AppointmentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsController extends Controller
{
    public function indexAction()
    {
        $appointmentManager = $this->get("appointment_manager");
        $appointments = $appointmentManager->getAppointments();

        return $this->render('customers_manager/appointments/appointments_index.html.twig', array(
            'title' => 'Appointments Managment - Index',
            'appointments'=>$appointments
        ));
    }

    public function registerAction()
    {
        $appointment = new Appointment();
        $registerForm = $this->createForm(new AppointmentType($this->get('customer_manager')),
            $appointment,array(
            'action' => $this->generateUrl('customer_manager_appointment_add'),
            'method' => 'POST',
        ));

        return $this->render('customers_manager/appointments/appointments_add.html.twig', array(
            'title' => 'Appointment Managment - Add',
            'registerForm' => $registerForm->createView()
        ));
    }

    public function addAction(Request $request)
    {
        $appointmentManager = $this->get('appointment_manager');
        $appointment = new Appointment();
        $registerForm = $this->createForm(new AppointmentType($this->get('customer_manager')),
            $appointment,array(
                'action' => $this->generateUrl('customer_manager_appointment_add'),
                'method' => 'POST',
            ));
        $registerForm->handleRequest($request);

        if(!$registerForm->isValid()){
            $validator = $this->get('validator');
            $errors = $validator->validate($appointment);
            return $this->redirectToRoute("customer_manager_appointment_register");
        }

        $appointmentManager->addAppointment($appointment);
        return $this->redirectToRoute('customer_manager_appointment_index');

    }

}
