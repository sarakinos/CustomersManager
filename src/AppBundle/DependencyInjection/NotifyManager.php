<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/11/2015
 * Time: 8:40 μμ
 */

namespace AppBundle\DependencyInjection;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Appointment;
use AppBundle\Entity\Customer;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NotifyManager
{
    private $em;
    private $container;

    public function __construct(EntityManager $em,ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    /**
     * @param $setting
     * @return status
     * Function takes parameters 0 or 1 (Default is 0 , week)
     * By 0 it notifies customers for appointments arranged for the week being
     * By 1 it notifies customers for appointments arranged for the month being
     */
    public function notifyBy($setting = 0)
    {
        //Validate input
        if ($setting > 1 || $setting < 0) {
            return false;
        }
        switch ($setting) {
            case 0:
                $appointmentManager = new AppointmentManager($this->em);
                //Gets appointments for 7 days ahead of now
                $appointments = $appointmentManager->getAppointmentsByQuery(7);
                $mailerManager = new MailerManager($this->container);
                $mailerManager->sendAppointmentNotification($appointments);
                break;
            case 1:
                echo 'Second case, which falls through';
                break;
        }
        return true;
    }
}