<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/10/2015
 * Time: 10:00 μμ
 */

namespace AppBundle\Form\Type;

use AppBundle\DependencyInjection\AppointmentManager;
use AppBundle\DependencyInjection\CustomerManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    private $customerManager;

    public function __construct(CustomerManager $customerManager)
    {
        $this->customerManager = $customerManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $customers = $this->customerManager->getCustomerArray();

        $builder
            ->add('title','text')
            ->add('comments','textarea')
            ->add('customer_id','choice',array(
                'choices'=>$customers
            ))
            ->add('isCompleted','checkbox',array(
                'required'=>false
            ))
            ->add('date','datetime')
            ->add('submit','submit');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Appointment'
        ));
    }

    public function getName()
    {
        return 'appointment';
    }
}