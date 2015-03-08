<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\DataTransformer\TagsTransformer;

class TagsType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new TagsTransformer());
    }

	public function getParent()
    {
        return 'text';
    }

	public function getName()
    {
        return 'tags';
    }
}
