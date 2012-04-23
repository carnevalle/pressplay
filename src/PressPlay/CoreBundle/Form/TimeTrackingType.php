<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimeTrackingType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('startTime', null, array(
                'widget' => 'text'
            ))
            ->add('stopTime', null, array(
                'widget' => 'text'
            ))
            ->add('adjustment', 'number', array(
                'precision' => 2
            ))
        ;
        
        $builder->get('adjustment')->setRequired(false);
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PressPlay\CoreBundle\Entity\TimeTracking',
        );
    }    

    public function getName()
    {
        return 'timetracking';
    }
    
}
