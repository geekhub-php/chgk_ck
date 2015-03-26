<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommentAdmin extends Admin
{
    protected $baseRouteName = "admin_comments";
    protected $baseRoutePattern = "comments";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
       		->add('event', 'entity', array(
                'class' => 'AppBundle:Event',
                'property' => 'title',
            ))
            ->add('author', 'entity', array(
                'class' => 'AppBundle:User',
                'property' => 'email',
            ))
			->add('text', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        	->add('event', null, array(), 'entity', array('property' => 'title', 'placeholder' => 'any event'))
            ->add('author', null, array(), 'entity', array('property' => 'email', 'placeholder' => 'any author'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
			->add('event', null, array('associated_property' => 'title'))
            ->add('author', null, array('associated_property' => 'email'))
            ->add('text', 'text')
        ;
    }
}
