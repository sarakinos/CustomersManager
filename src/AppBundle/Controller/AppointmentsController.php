<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Appointment;
use AppBundle\Form\Type\AppointmentType;
use Symfony\Component\HttpFoundation\Request;


class AppointmentsController extends Controller
{
    public function indexAction()
    {
        $appointmentManager = $this->get("appointment_manager");
        $appointments = $appointmentManager->getAll();

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

    public function editAction($id)
    {
        if(!$this->get('helper_validator')->checkId($id)){
            throw $this->createNotFoundException("Invalid id");
        }

        $appointment = $this->get('appointment_manager')->getById($id);
        $registerForm = $this->createForm(new AppointmentType(),$appointment,array(
            'action' => $this->generateUrl('customer_manager_appointment_update',array(
                "id"=>$id
            )),
            'method' => 'POST',
        ));
        return $this->render('customers_manager/appointments/appointments_add.html.twig', array(
            'title' => 'Appointment Managment - Add',
            'registerForm' => $registerForm->createView()
        ));
    }

    //The add,delete,update actions

    public function addAction(Request $request)
    {
        $appointmentManager = $this->get('appointment_manager');
        $appointment = new Appointment();
        $registerForm = $this->createForm(new AppointmentType(),
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

        $appointmentManager->add($appointment);
        return $this->redirectToRoute('customer_manager_appointment_index');

    }

    public function updateAction(Request $request,$id)
    {
        $appointment = $this->get('appointment_manager')->getById($id);
        $registerForm = $this->createForm(new AppointmentType(),$appointment);
        $registerForm->handleRequest($request);

        if(!$registerForm->isValid()) {
            $validator = $this->get('validator');
            $errors = $validator->validate($appointment);
            return $this->redirectToRoute("customer_manager_appointment_register");
        }

        $this->get('appointment_manager')->update();
        $this->addFlash("actionInfo","Appointment updated successfuly");
        return $this->redirectToRoute("customer_manager_appointment_index");
    }

    public function deleteAction($id)
    {
        if(!$this->get('helper_validator')->checkId($id)){
            throw $this->createNotFoundException("Invalid id");
        }
        $this->get('appointment_manager')->remove($id);
        $this->addFlash("actionInfo","Appointment deleted successfuly");
        return $this->redirectToRoute("customer_manager_appointment_index");
    }
}
