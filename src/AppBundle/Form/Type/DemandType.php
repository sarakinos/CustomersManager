<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Demand;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Appointment;

class DemandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('body','textarea')
            ->add('isCompleted','checkbox',array(
                'label' => 'Status',
                'required'=>false))
            ->add('expires','datetime')
            ->add('appointment', 'entity', array(
                'class' => 'AppBundle\Entity\Appointment',
            ))
            ->add('customer', 'entity', array(
                'class' => 'AppBundle\Entity\Customer',
            ))
            ->add('submit','submit');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\Demand'
        ));
    }

    public function getName()
    {
        return 'demand';
    }
}
