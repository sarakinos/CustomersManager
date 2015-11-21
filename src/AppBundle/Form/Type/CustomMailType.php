<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject','text')
            ->add('from','text')
            ->add('to', 'entity', array(
                'class' => 'AppBundle\Entity\Customer',
            ))
            ->add('body','textarea')
            ->add('send','submit');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\Mail',
        ));
    }

    public function getName()
    {
        return 'custom_mail_type';
    }
}
