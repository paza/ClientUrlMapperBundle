<?php

namespace PaZa\ClientUrlMapperBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilder;

class HostForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'        => 'PaZa\ClientUrlMapperBundle\Entity\Host',
        );
    }
}
