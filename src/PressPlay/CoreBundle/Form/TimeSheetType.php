<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimeSheetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('timetrackings', 'collection', array(
                'type' => new TimeTrackingType(),
                'allow_add' => true,
                'by_reference' => false,                
                ))              
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PressPlay\CoreBundle\Entity\TimeSheet',
        );
    }    
    
    public function getName()
    {
        return 'pressplay_corebundle_timesheettype';
    }
}
