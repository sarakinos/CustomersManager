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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('comments','textarea')
            ->add('customer', 'entity', array(
                'class' => 'AppBundle\Entity\Customer',
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