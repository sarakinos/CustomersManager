<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/10/2015
 * Time: 10:00 μμ
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname','text')
            ->add('surname','text')
            ->add('city','text')
            ->add('country','text')
            ->add('address','text')
            ->add('phone','integer')
            ->add('birthday','date')
            ->add('email','text')
            ->add('save', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Customer'
        ));
    }

    public function getName()
    {
        return 'customer';
    }
}