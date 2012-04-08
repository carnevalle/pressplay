<?php

namespace PressPlay\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WorkMonthEmployeeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('workhours')
            ->add('workdays')
            ->add('user')
        ;
    }

    public function getName()
    {
        return 'pressplay_corebundle_workmonthemployeetype';
    }
}
