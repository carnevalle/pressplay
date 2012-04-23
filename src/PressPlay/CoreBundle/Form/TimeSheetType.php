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
                'allow_delete' => true,
                'by_reference' => false,   
                'label'     => ' '             
                ))  
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
        
        $builder->get('absent')->setRequired(false);
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PressPlay\CoreBundle\Entity\TimeSheet',
        );
    }    
    
    public function getName()
    {
        return 'timesheet';
    }
}
