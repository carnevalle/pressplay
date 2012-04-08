<?php

namespace PressPlay\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email', 'email')
            ->add('plainPassword', 'repeated', array('type' => 'password'));        
    }

    public function getName()
    {
        return 'pressplay_user_registration';
    }
}