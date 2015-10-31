<?php

namespace ToBeDoneBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', 'text', ['label' => 'Create New Task'])
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'task';
    }
}