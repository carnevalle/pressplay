<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimeTrackingType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('startTime')
            ->add('stopTime')
            ->add('adjustment')
            ->add('absent', 'choice', array(
                'choices' => array(
                    'sickday' => 'Sickday',
                    'holiday' => 'Holiday'
                ),
                'required'    => false,
                'empty_value' => 'Choose reason for absence',
                'empty_data'  => null,
                'label'     => 'Absent?'
            )) 
        ;
        
        $builder->get('startTime')->setRequired(false);
        $builder->get('stopTime')->setRequired(false);
        $builder->get('adjustment')->setRequired(false);
        $builder->get('absent')->setRequired(false);
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PressPlay\CoreBundle\Entity\TimeTracking',
        );
    }    

    public function getName()
    {
        return 'pressplay_corebundle_timetrackingtype';
    }
    
}
