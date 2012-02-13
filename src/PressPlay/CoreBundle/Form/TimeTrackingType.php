<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimeTrackingType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('startTime', null, array('widget' => 'single_text'))
            ->add('stopTime', null, array('widget' => 'single_text'))
            ->add('adjustment')
            ->add('sickday')
            ->add('holiday')
        ;
    }

    public function getName()
    {
        return 'pressplay_corebundle_timetrackingtype';
    }
}
