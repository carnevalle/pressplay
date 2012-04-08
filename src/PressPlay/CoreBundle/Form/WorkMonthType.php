<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WorkMonthType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('month', 'choice', array(
                'choices' => array(
                    '1' => 'Januar',
                    '2' => 'Februar',
                    '3' => 'Marts',
                    '4' => 'April',
                    '5' => 'Maj',
                    '6' => 'Juni',
                    '7' => 'Juli',
                    '8' => 'August',
                    '9' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'December'
                )
            ))
            ->add('year')
            ->add('employees', 'collection', array(
                'type' => new WorkMonthEmployeeType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,             
                ))              
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PressPlay\CoreBundle\Entity\WorkMonth',
        );
    }  

    public function getName()
    {
        return 'workmonth';
    }
}
