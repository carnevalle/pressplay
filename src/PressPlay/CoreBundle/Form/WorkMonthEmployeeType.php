<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WorkMonthEmployeeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('workhours')
            ->add('workdays')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PressPlay\CoreBundle\Entity\WorkMonthEmployee',
        );
    } 

    public function getName()
    {
        return 'pressplay_corebundle_workmonthemployeetype';
    }
}
