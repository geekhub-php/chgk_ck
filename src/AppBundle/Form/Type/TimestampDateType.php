<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\DataTransformer\DateToStringTransformer;
use AppBundle\Form\DataTransformer\TimestampToDateTransformer;

class TimestampDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new DateToStringTransformer());
        $builder->addModelTransformer(new TimestampToDateTransformer());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array('class' => 'timestamp-date'),
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'timestamp_date';
    }
}
