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
                    'january' => 'January',
                    'february' => 'February'
                )))
            ->add('year')               
        ;
    }

    public function getName()
    {
        return 'workmonth';
    }
}
